<?php namespace Site\Contact\Tests\Facades;

use App;
use Config;
use Site\Contact\Facades\ContactFacade;
use Site\Contact\Models\Message;
use PluginTestCase;

class ContactFacadeTest extends PluginTestCase
{
    /**
     * Returns tested class.
     *
     * @return ContactFacade
     */
    public function getModel()
    {
        return App::make(ContactFacade::class);
    }

    public function testStoreMessage()
    {
        // get testing facade
        $facade = $this->getModel();

        // save message
        $data = [
            'name' => 'Test User',
            'email' => 'testing@domain.com',
            'message' => 'Hello from unit test.',
        ];
        $facade->storeMessage($data);

        // get message
        $message = Message::first();
        $this->assertEquals('Test User', $message->name);
    }
}
