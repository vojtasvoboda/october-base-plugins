<?php namespace Site\Partners\Updates;

use File;
use Schema;
use Site\Partners\Models\Category;
use Site\Partners\Models\Partner;
use Site\Partners\Updates\Classes\DatabaseSeeder;
use Yaml;

class SeedPartnersTable extends DatabaseSeeder
{
    /** @var string $seedFileName Seed file name. */
    protected $seedFileName = 'partners.yaml';

    /** @var string $seedDirPath Seed directory. */
    protected $seedDirPath = '/sources';

    /** @var string $mediaFolderPath Media directory. */
    protected $mediaFolderPath = '/partners';

    public function run()
    {
        // seed table
        $defaultSeed = __DIR__ . '/sources/' . $this->seedFileName;
        $seedFile = $this->getSeedFile($defaultSeed);
        $seedMediaFolder = pathinfo($seedFile)['dirname'] . $this->mediaFolderPath;
        $items = Yaml::parse(File::get($seedFile));

        // create each item
        foreach ($items as $key => $data) {
            $data['enabled'] = true;
            $data['category'] = $this->getCached(app(Category::class), 'slug', $data['category']);
            $item = Partner::create($data);
            $this->saveImage($item, $seedMediaFolder, "partner.jpg");
        }
    }

    /**
     * Save image.
     *
     * @param object $item
     * @param string $path
     * @param string $imagename
     */
    private function saveImage($item, $path, $imagename)
    {
        $filePath = $path . '/' . $imagename;
        if (file_exists($filePath) && is_file($filePath)) {
            $fileObject = $this->getSavedFile($filePath, $isPublic = true);
            $item->image()->add($fileObject);
        }
    }
}
