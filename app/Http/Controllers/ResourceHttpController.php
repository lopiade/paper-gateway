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


    protected $acceptedStatus = [200,304,302,301];

    /**
     * @param PaperResource $paperResource
     * @param $resource_id
     * @return \Illuminate\Support\Collection
     */
    public function checkHttp(PaperResource $paperResource, $resource_id)
    {
        $resource = $paperResource->find($resource_id);

        $online = true;

        if ( ! $status = in_array(Curl::request($resource->url)->status, $this->acceptedStatus) ) {

            \Log::alert('status',[$status]);

            $online = false;
            event( new ServerWasNotFound($resource) );
        }

        return collect(['is_online' => $online]);
    }
    
    
    
}
