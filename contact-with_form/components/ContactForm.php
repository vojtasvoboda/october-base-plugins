<?php namespace Site\Contact\Components;

use App;
use Site\Contact\Facades\ContactFacade;
use Cms\Classes\ComponentBase;
use Config;
use Exception;
use Flash;
use Input;
use Lang;
use October\Rain\Exception\AjaxException;
use October\Rain\Exception\ApplicationException;
use Redirect;
use Response;
use Session;

class ContactForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Contact form',
            'description' => 'Contact form',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * AJAX form submit by October JS Framework.
     *
     * @return mixed
     */
    public function onSubmit()
    {
        try {
            $this->validateToken();
            $this->saveForm();

        } catch (ApplicationException $e) {
            return Response::json($e->getMessage(), 406);

        } catch (Exception $e) {
            return Response::json($e->getMessage(), 406);
        }
    }

    /**
     * Fallback for classic non-ajax POST request.
     *
     * @return mixed
     */
    public function onRun()
    {
        $error = false;

        if (post('submit')) {
            try {
                $this->validateToken();
                $this->saveForm();
                Flash::success(Lang::get('site.contact::lang.sent'));

                return Redirect::to($this->page->url . '#contactForm', 303);

            } catch (ApplicationException $e) {
                $error = $e->getMessage();

            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $this->page['sent'] = Flash::check();
        $this->page['post'] = post();
        $this->page['error'] = $error;
    }

    /**
     * Validate CSRF token.
     */
    private function validateToken()
    {
        if (Session::token() !== Input::get('_token')) {
            throw new ApplicationException(Lang::get('site.contact::lang.token'));
        }
        if (strtolower(Input::get('confirm')) !== 'kraus') {
            throw new ApplicationException(Lang::get('site.contact::lang.confirm'));
        }
    }

    /**
     * Save contact form.
     */
    private function saveForm()
    {
        /** @var ContactFacade $repository */
        $repository = App::make(ContactFacade::class);
        $data = Input::all();
        $repository->storeMessage($data);
    }
}
