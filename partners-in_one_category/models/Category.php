<?php namespace Site\Partners\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;

class Category extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'site_partners_categories';

    public $rules = [
        'name' => 'required|max:300',
        'slug' => 'required|max:255|unique:site_partners_categories',
        'enabled' => 'boolean',
        'description' => 'max:5000',
    ];

    public $fillable = ['name', 'slug', 'description', 'enabled'];

    public $translatable = ['name', 'description'];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $attributeNames = [
        'name' => 'Name',
        'slug' => 'Slug',
        'description' => 'Description',
        'enabled' => 'Enabled',
    ];

    public $hasMany = [
        'partners' => Partner::class,
    ];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
