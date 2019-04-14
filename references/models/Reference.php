<?php namespace Site\References\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;
use Site\Services\Models\Service;
use System\Models\File;

/**
 * Reference Model
 */
class Reference extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'site_references_references';

    public $rules = [
        'name' => 'required|max:300',
        'client' => 'max:300',
        'location' => 'max:300',
        'description' => 'max:5000',
        'enabled' => 'boolean',
    ];

    public $fillable = ['name', 'description', 'text', 'enabled'];

    public $translatable = ['name', 'description', 'text', 'location'];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $attributeNames = [
        'name' => 'Name',
        'description' => 'Description',
        'client' => 'Client',
        'location' => 'Location',
        'text' => 'Text',
        'enabled' => 'Enabled',
    ];

    public $attachOne = [
        'cover' => [File::class],
    ];

    public $attachMany = [
        'images' => [File::class],
    ];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function scopeIsTop($query)
    {
        return $query->where('top', true);
    }
}
