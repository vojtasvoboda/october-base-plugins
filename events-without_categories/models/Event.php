<?php namespace Site\Events\Models;

use Model;
use October\Rain\Argon\Argon;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;

class Event extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'site_events_events';

    public $rules = [
        'name' => 'required|max:255',
        'slug' => 'required|unique:site_events_events',
        'date_from' => 'required|date',
        'date_to' => 'date',
        'enabled' => 'boolean',
    ];

    public $translatable = ['name', 'description', 'slug'];

    public $dates = ['date_from', 'date_to', 'created_at', 'updated_at', 'deleted_at'];

    public $attributeNames = [
        'name' => 'Name',
        'date_from' => 'Date from',
        'date_to' => 'Date to',
        'description' => 'Description',
    ];

    public function scopeFuture($query)
    {
        return $query
            ->where(function ($query) {
                $now = Argon::now();
                $query
                    ->where('date_from', '>=', $now->toDateString())
                    ->orWhere(function ($query) use ($now) {
                        $query
                            ->whereNull('date_to')
                            ->orWhere('date_to', '>=', $now->toDateString());
                    });
            });
    }

    public function scopeArchived($query)
    {
        return $query
            ->where(function ($query) {
                $now = Argon::now();
                $query
                    ->where('date_from', '<', $now->toDateString())
                    ->orWhere(function ($query) use ($now) {
                        $query
                            ->whereNull('date_to')
                            ->orWhere('date_to', '<', $now->toDateString());
                    });
            });
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function ongoing()
    {
        $now = Argon::now();

        if ($this->date_to === null) {
            return $this->date_from->format('Y-m-d') === $now->format('Y-m-d');
        }

        return $this->date_from <= $now && $this->date_to >= $now;
    }

    public function past()
    {
        $now = Argon::now();

        if ($this->date_to === null) {
            return $this->date_from->format('Y-m-d') < $now->format('Y-m-d');
        }

        return $this->date_to <= $now;
    }
}
