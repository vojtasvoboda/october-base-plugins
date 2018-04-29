<?php namespace Site\Team\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Sortable as SortableTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;
use System\Models\File;

/**
 * Member Model
 */
class Member extends Model
{
    use SoftDeleteTrait;

    use SortableTrait;

    use ValidationTrait;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $table = 'site_team_members';

    public $rules = [
        'name' => 'required|max:300',
        'position' => 'max:5000',
        'linkedin' => 'max:300',
        'mail' => 'max:300',
        'enabled' => 'boolean',
    ];

    public $fillable = ['name', 'position', 'enabled', 'linkedin', 'mail'];

    public $translatable = ['position'];

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $attributeNames = [
        'name' => 'Name',
        'position' => 'Position',
        'linkedin' => 'LinkedIn',
        'mail' => 'Email',
        'enabled' => 'Enabled',
    ];

    public $attachOne = [
        'image' => [File::class],
    ];

    public function scopeIsEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
