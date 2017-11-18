<?php namespace Site\Contact\Facades;

use App;
use Lang;
use October\Rain\Exception\ApplicationException;
use Site\Contact\Mailers\MessageMailer;
use Site\Contact\Models\Message;

/**
 * Facade ContactFacades.
 *
 * @package Site\Contact\Facades
 */
class ContactFacade
{
    /** @var Message $message */
    private $message;

    /**
     * ContactFacade constructor.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Save message and send confirmation email.
     *
     * @param array $data
     *
     * @return Message|null
     *
     * @throws ApplicationException
     */
    public function storeMessage($data)
    {
        // check reservation sent limit
        if ($this->message->isExistInLastTime()) {
            throw new ApplicationException('You can send one message only in 30 seconds.');
        }

        // save message
        $message = $this->message->create($data);

        // send confirmation
        MessageMailer::send($message);

        return $message;
    }
}
