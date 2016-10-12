<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Support\Curl;
use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSlug(Request $request)
    {
        $this->validate($request, [
            'slug'  => 'required'
        ]);
        
        return redirect()->route('paper',[$request->slug]);
    }
    
}
