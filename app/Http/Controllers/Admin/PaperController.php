<?php namespace App\Http\Controllers\Admin;

use App\Models\Paper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class PaperController
 *
 * @package App\Http\Controllers\Admin
 */
class PaperController extends Controller
{

    /**
     * @param Paper $paper
     * @param $paperId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Paper $paper, $paperId)
    {
        $paper = $paper->find($paperId);
        
        if (!$paper) {

            return redirect()->route('admin::dashboard');
        }

        return view('admin.paper',['paper' => $paper->load('resource')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() // GET
    {
        return view('admin.paper-create-form');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) // POST
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $paper = new Paper;

        $paper->title = $request->title;
        $paper->subtitle = $request->subtitle;
        $paper->save();

        return redirect()->route('admin::paper::show',$paper->id);
    }

    /**
     * @param $paper_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($paper_id)
    {
        if (Paper::where('id','=',$paper_id)->delete()) {

            return redirect()->route('admin::dashboard')->with('success', 'Deleted');
        }

        return redirect()->route('admin::dashboard')->with('error', 'An error occurred');
    }


}
