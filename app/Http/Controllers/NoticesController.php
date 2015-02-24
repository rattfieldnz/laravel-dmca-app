<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PrepareNoticeRequest;
use App\Provider;


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
     * @param PrepareNoticeRequest $request
     * @return array
     */
    public function confirm(PrepareNoticeRequest $request)
    {
        return $request->all();
    }

}
