<?php namespace Site\Events\Models;

use App;
use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeleteTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;
use October\Rain\Exception\ValidationException;
use Request;
use Site\Events\Mailers\RegistrationMailer;

/**
 * Registration Model
 */
class Registration extends Model
{
    use SoftDeleteTrait;

    use ValidationTrait;

    public $table = 'site_events_registrations';

    public $rules = [
        'name' => 'required|between:3,300',
        'surname' => 'required|between:3,300',
        'company' => 'max:300',
        'email' => 'required|email',
        'phone' => 'max:300',
    ];

    public $customMessages = [
        'name.required' => 'Name is required.',
        'surname.required' => 'Surname is required.',
        'email.required' => 'Email is required',
    ];

    public $attributeNames = [
        'name' => 'Name',
        'surname' => 'Surname',
        'company' => 'Company',
        'email' => 'Email',
        'phone' => 'Phone',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /** @var array Values are fields accessible to mass assignment. */
    protected $fillable = [
        'name', 'surname', 'company', 'email', 'phone', 'event', 'event_id',
    ];

    public $belongsTo = [
        'event' => Event::class,
    ];

    /**
     * Before create filter - add IP address and user_agent attributes.
     */
    public function beforeCreate()
    {
        $this->locale = App::getLocale();
        $this->referrer = Request::path();
        $this->ip = Request::server('REMOTE_ADDR');
        $this->ip_forwarded = Request::server('HTTP_X_FORWARDED_FOR');
        $this->user_agent = Request::server('HTTP_USER_AGENT');
    }

    /**
     * Extra validations.
     *
     * @throws ValidationException
     */
    public function beforeValidate()
    {
        // check event date
        if ($this->event !== null) {
            if ($this->event->ongoing() === true || $this->event->past() === true) {
                throw new ValidationException(['event' => 'Event ongoing or already gone.']);
            }
        }

        // check same email for same event
        if (!empty($this->email) && $this->event !== null) {
            if ($this->isExistForTheSameEvent($this->event, $this->email)) {
                throw new ValidationException(['event' => 'Registration already exists for this email.']);
            }
        }
    }

    /**
     * Send confirmation email after registration.
     */
    public function afterCreate()
    {
        RegistrationMailer::send($this);
    }

    /**
     * Set machine scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeMachine($query)
    {
        $ip_addr = Request::server('REMOTE_ADDR');
        $ip_forwarded = Request::server('HTTP_X_FORWARDED_FOR');
        $user_agent = Request::server('HTTP_USER_AGENT');

        return $query->whereIp($ip_addr)->whereIpForwarded($ip_forwarded)->whereUserAgent($user_agent);
    }

    /**
     * @param Event $event
     * @param string $email
     *
     * @return bool
     */
    public function isExistForTheSameEvent($event, $email)
    {
        $registration = self::where('event_id', $event->id)->where('email', $email)->first();

        return $registration !== null;
    }
}
