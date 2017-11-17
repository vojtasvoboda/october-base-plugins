<?php namespace Site\Partners\Components;

use Cms\Classes\ComponentBase;
use October\Rain\Support\Collection;
use Site\Partners\Models\Category;
use Site\Partners\Models\Partner;

class Partners extends ComponentBase
{
    /** @var Collection $partners */
    public $partners;

    public function componentDetails()
    {
        return [
            'name'        => 'Partners Component',
            'description' => 'Show partners as logos.',
        ];
    }

    public function defineProperties()
    {
        return [
            'category' => [
                'title' => 'Category slug',
                'description' => 'Category slug',
                'type' => 'string',
                'default' => '',
            ],
        ];
    }

    public function onRun()
    {
        // load category
        $categorySlug = $this->property('category');
        $category = Category::where('slug', $categorySlug)->first();

        // load partners
        $partnersQuery = Partner::isEnabled();
        if ($category !== null) {
            $partnersQuery->where('category_id', $category->id);
        }
        $this->partners = $partnersQuery->orderBy('sort_order')->get();
    }
}
