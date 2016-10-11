<?php namespace App\Http\Controllers\Admin;

use App\Models\Paper;
use App\Models\PaperResource;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class PaperResourceController
 *
 * @package App\Http\Controllers\Admin
 */
class PaperResourceController extends Controller
{

    /**
     * @param Request $request
     * @param $paper_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $paper_id)
    {
        $this->validate($request, [
            'url' => 'required'
        ]);

        $resource = new PaperResource;
        $resource->url = $request->url;
        $resource->type = $request->type;
        $resource->active = $request->active;
        $resource->online = $request->online;

        if (Paper::find($paper_id)->resource()->save($resource)) {

            return redirect()->route('admin::paper::show', $paper_id)->with('success', 'Saved');
        }

        return redirect()->route('admin::paper::show', $paper_id)->with('error', 'An error occurred');
    }

    /**
     * @param $paper_id
     * @param $resource_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($paper_id, $resource_id)
    {
        if (PaperResource::where('id','=',$resource_id)->delete()) {

            return redirect()->route('admin::paper::show', $paper_id)->with('success', 'Deleted');
        }

        return redirect()->route('admin::paper::show', $paper_id)->with('error', 'An error occurred');
    }
    
}
