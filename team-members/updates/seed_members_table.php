<?php namespace Site\Team\Updates;

use File;
use Schema;
use Site\Team\Updates\Classes\DatabaseSeeder;
use Site\Team\Models\Member;
use Yaml;

class SeedMembersTable extends DatabaseSeeder
{
    /** @var string $seedFileName Seed file name. */
    protected $seedFileName = 'members.yaml';

    /** @var string $seedDirPath Seed directory. */
    protected $seedDirPath = '/sources';

    /** @var string $mediaFolderPath Media directory. */
    protected $mediaFolderPath = '/member';

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
            $item = Member::create($data);
            $this->saveImage($item, $seedMediaFolder, "member.jpg");
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
