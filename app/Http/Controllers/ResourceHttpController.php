<?php namespace App\Http\Controllers;


use App\Events\ServerWasNotFound;
use App\Models\PaperResource;
use App\Support\Curl;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class ResourceHttpController
 *
 * @package App\Http\Controllers
 */
class ResourceHttpController extends Controller
{

    /**
     * @param PaperResource $paperResource
     * @param $resource_id
     * @return \Illuminate\Support\Collection
     */
    public function checkHttp(PaperResource $paperResource, $resource_id)
    {
        $resource = $paperResource->find($resource_id);

        $online = true;

        if (Curl::request($resource->url)->status != 200) {

            $online = false;
            event( new ServerWasNotFound($resource) );
        }

        return collect(['is_online' => $online]);
    }
    
    
    
}
