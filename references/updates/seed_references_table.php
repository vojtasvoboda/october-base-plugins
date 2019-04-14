<?php namespace Site\References\Updates;

use File;
use Schema;
use Site\References\Models\Reference;
use Site\Services\Models\Service;
use Site\Services\Updates\Classes\DatabaseSeeder;
use Str;
use Yaml;

class SeedReferencesTable extends DatabaseSeeder
{
    /** @var string $seedFileName Seed file name. */
    protected $seedFileName = 'references.yaml';

    /** @var string $seedDirPath Seed directory. */
    protected $seedDirPath = '/sources';

    /** @var string $mediaFolderPath Media directory. */
    protected $mediaFolderPath = '/reference';

    public function run()
    {
        // seed table
        $defaultSeed = __DIR__ . '/sources/' . $this->seedFileName;
        $seedFile = $this->getSeedFile($defaultSeed);
        $seedMediaFolder = pathinfo($seedFile)['dirname'] . $this->mediaFolderPath;
        $items = Yaml::parse(File::get($seedFile));

        // create each item
        foreach ($items as $key => $data) {
            // create reference
            $data['enabled'] = true;
            $data['slug'] = Str::slug($data['name']);
            $item = Reference::create($data);

            // attach cover image
            $this->saveCover($item, $seedMediaFolder, "reference.jpg");

            // attach gallery images
            for ($i = 0; $i < 3; $i++) {
                $this->saveImages($item, $seedMediaFolder, "reference.jpg");
            }
        }
    }

    /**
     * Save image.
     *
     * @param object $item
     * @param string $path
     * @param string $imagename
     */
    private function saveCover($item, $path, $imagename)
    {
        $filePath = $path . '/' . $imagename;
        if (file_exists($filePath) && is_file($filePath)) {
            $fileObject = $this->getSavedFile($filePath, $isPublic = true);
            $item->cover()->add($fileObject);
        }
    }

    /**
     * Save image.
     *
     * @param object $item
     * @param string $path
     * @param string $imagename
     */
    private function saveImages($item, $path, $imagename)
    {
        $filePath = $path . '/' . $imagename;
        if (file_exists($filePath) && is_file($filePath)) {
            $fileObject = $this->getSavedFile($filePath, $isPublic = true);
            $item->images()->add($fileObject);
        }
    }
}
