<?php namespace Site\Galleries\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;
use Site\Regions\Models\Region;

class Gallery extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

    public $table = 'site_galleries_galleries';

    public $rules = [
        'name' => 'required|max:255',
        'url' => 'required|unique:site_galleries_galleries',
        'enabled' => 'boolean',
    ];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $attachMany = [
        'images' => ['System\Models\File', 'order' => 'sort_order'],
    ];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
