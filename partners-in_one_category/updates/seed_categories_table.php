<?php namespace Site\Partners\Updates;

use File;
use Schema;
use Site\Partners\Models\Category;
use Site\Partners\Updates\Classes\DatabaseSeeder;
use Str;
use Yaml;

class SeedCategoriesTable extends DatabaseSeeder
{
    /** @var string $seedFileName Seed file name. */
    protected $seedFileName = 'categories.yaml';

    /** @var string $seedDirPath Seed directory. */
    protected $seedDirPath = '/sources';

    public function run()
    {
        // seed table
        $defaultSeed = __DIR__ . '/sources/' . $this->seedFileName;
        $seedFile = $this->getSeedFile($defaultSeed);
        $items = Yaml::parse(File::get($seedFile));

        // create each item
        foreach ($items as $key => $data) {
            $data['enabled'] = true;
            $data['slug'] = Str::slug($data['name']);
            Category::create($data);
        }
    }
}
