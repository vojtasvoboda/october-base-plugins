<?php namespace Site\Events\Updates;

use File;
use Site\Events\Models\Event;
use Site\Events\Updates\Classes\DatabaseSeeder;
use Schema;
use Str;
use Yaml;

class SeedEventsTable extends DatabaseSeeder
{
	/** @var string $seedFileName Seed file name. */
	protected $seedFileName = 'events.yaml';

    /** @var string $seedDirPath Seed directory. */
    protected $seedDirPath = '/sources';

	public function run()
	{
		// seed table
		$defaultSeed = __DIR__ . '/sources/' . $this->seedFileName;
		$seedFile = $this->getSeedFile($defaultSeed);
		$items = Yaml::parse(File::get($seedFile));

        // create each item
		foreach ($items as $key => $i) {
		    $i['enabled'] = true;
		    $i['slug'] = Str::slug($i['name']);
		    $i['top'] = isset($i['top']) ? $i['top'] : false;
			Event::create($i);
		}
	}
}
