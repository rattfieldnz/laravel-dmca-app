<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PrepareNoticeRequest;
use App\Provider;
use Illuminate\Contracts\Auth\Guard;


/**
 * Class NoticesController
 * @package App\Http\Controllers
 */
class NoticesController extends Controller {

    /**
     * Create a new notices controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all notices.
     * @return string
     */
    public function index()
    {
        return 'all notices';
    }

    /**
     * Show a page to create a new notice.
     * @return \Response
     */
    public function create()
    {
        $providers = Provider::lists('name', 'id');

        //load view to create notice
        return view('notices.create', compact('providers'));
    }

    /**
     * Ask user to confirm the DMCA notice to be delivered.
     * @param PrepareNoticeRequest $request
     * @param Guard $auth
     * @return array
     */
    public function confirm(PrepareNoticeRequest $request, Guard $auth)
    {
        $template = $this->compileDmcaTemplate($data = $request->all(), $auth);
        session()->flash('dmca', $data);
        return view('notices.confirm', compact('template'));
    }

    /**
     *
     */
    public function store()
    {
        $data = session()->get('dmca');

        return $data;
    }

    /**
     * Compile the DMCA template from form data.
     * @param $data
     * @param Guard $auth
     * @return \Illuminate\View\View
     */
    private function compileDmcaTemplate($data, Guard $auth)
    {
        $data = $data + [
            'name' => $auth->user()->name,
            'email' => $auth->user()->email,
        ];
        $template = view()->file(app_path('Http/Templates/dmca.blade.php'), $data);

        return view('notices.confirm', compact('template'));
    }

}
