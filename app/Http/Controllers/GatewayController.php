<?php namespace App\Http\Controllers;

use App\Models\Paper;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GatewayController
 *
 * @package App\Http\Controllers
 */
class GatewayController extends Controller
{

    /**
     * @param Paper $paper
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Paper $paper, $slug)
    {
        $paper = $paper->scopePrintResources($slug);

        if (! $paper) {
            return redirect()->route('home')->with('error', 'Slug not found!');
        }

        return view('paper',[
            'paper' => $this->responseTransformer($paper)
        ]);
    }

    /**
     * Transform paper
     *
     * @param Paper $paper
     * @return Paper
     */
    protected function responseTransformer(Paper $paper)
    {
        if ( ! is_a($paper->resource, Collection::class) ) return $paper;

        $paper->resource->transform(function ($item, $key) {

            if ( ! $item->active) {
                $item->url = $this->shortenUrl($item->url);
            }

            return $item;
        });

        return $paper;
    }

    /**
     * Shorten url
     *
     * @param $url
     * @return string
     */
    protected function shortenUrl($url)
    {
        return substr($url, 0,15) . '...';
    }

}
