<?php namespace Site\Partners\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;
use System\Models\File;

class Partner extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'site_partners_partners';

    public $rules = [
        'name' => 'required|max:300',
        'url' => 'url|max:300',
        'enabled' => 'boolean',
        'description' => 'max:5000',
    ];

    public $fillable = ['category', 'name', 'url', 'description', 'enabled'];

    public $translatable = ['name', 'description'];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $attributeNames = [
        'name' => 'Name',
        'url' => 'URL',
        'description' => 'Description',
        'enabled' => 'Enabled',
    ];

    public $belongsTo = [
        'category' => Category::class,
    ];

    public $attachOne = [
        'image' => [File::class],
    ];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
