<?php namespace Site\Events\Tests\Model;

use App;
use Config;
use PluginTestCase;
use Site\Events\Models\Event;

class EventTest extends PluginTestCase
{
    /**
     * @return Event
     */
    public function getModel()
    {
        return app(Event::class);
    }

    public function testFutureEvents()
    {
        $records = $this->getModel()->future()->get();
        $this->assertCount(4, $records);
    }

    public function testArchivedEvents()
    {
        $records = $this->getModel()->archived()->get();
        $this->assertCount(2, $records);
    }

    public function testNotOngoing()
    {
        $record = $this->getModel()->find(1);
        $this->assertFalse($record->ongoing());
    }

    public function testOngoing()
    {
        $record = $this->getModel()->find(3);
        $this->assertTrue($record->ongoing());
    }

    public function testOneDayOngoing()
    {
        $record = $this->getModel()->find(4);
        $this->assertTrue($record->ongoing());
    }

    public function testPast()
    {
        $record = $this->getModel()->find(1);
        $this->assertTrue($record->past());
    }

    public function testOngoingPast()
    {
        $record = $this->getModel()->find(3);
        $this->assertFalse($record->past());
    }

    public function testOngoingOneDayPast()
    {
        $record = $this->getModel()->find(4);
        $this->assertFalse($record->past());
    }
}
