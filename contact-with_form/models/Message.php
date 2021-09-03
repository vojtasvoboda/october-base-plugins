<?php namespace Site\Contact\Models;

use App;
use Carbon\Carbon;
use Config;
use Model;
use October\Rain\Database\Traits\SoftDelete as SoftDeletingTrait;
use October\Rain\Database\Traits\Validation as ValidationTrait;
use Request;

/**
 * Class Message.
 *
 * @package Site\Contact\Models
 */
class Message extends Model
{
    use SoftDeletingTrait;

    use ValidationTrait;

    /**
     * @var string The database table used by the model.
     */
    protected $table = 'site_contact_messages';

    public $rules = [
        'name' => 'required|between:3,100',
        'email' => 'required|email',
        'message' => 'required|min:5|max:3000',
    ];

    public $customMessages = [
        'name.required' => 'site.contact::lang.name.required',
        'email.required' => 'site.contact::lang.email.required',
        'phone.required' => 'site.contact::lang.phone.required',
        'message.required' => 'site.contact::lang.message.required',
        'message.min' => 'site.contact::lang.message.min',
    ];

    public $attributeNames = [
        'name' => 'site.contact::lang.name.label',
        'email' => 'site.contact::lang.email.label',
        'phone' => 'site.contact::lang.phone.label',
        'company' => 'site.contact::lang.company.label',
        'message' => 'site.contact::lang.message.label',
    ];

    /** @var array Values are fields accessible to mass assignment. */
    protected $fillable = [
        'name', 'email', 'address', 'phone', 'time', 'message', 'locale', 'company',
    ];

    /**
     * Before create filter - add IP address and user_agent attributes.
     */
    public function beforeCreate()
    {
        $this->locale = App::getLocale();
        $this->referrer = Request::path();
        $this->ip_addr = Request::server('REMOTE_ADDR');
        $this->ip_forwarded = Request::server('HTTP_X_FORWARDED_FOR');
        $this->user_agent = Request::server('HTTP_USER_AGENT');
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

        return $query->whereIpAddr($ip_addr)->whereIpForwarded($ip_forwarded)->whereUserAgent($user_agent);
    }

    /**
     * If some message exists in last one minute.
     *
     * @return bool
     */
    public function isExistInLastTime()
    {
        // protection time
        $time = Config::get('site.contact::config.protection_time', '-30 seconds');
        $timeLimit = Carbon::parse($time)->toDateTimeString();

        // try to find some message
        $item = self::machine()->where('created_at', '>', $timeLimit)->first();

        return $item !== null;
    }
}
