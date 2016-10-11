<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;

use App\Http\Requests;

class GatewayController extends Controller
{

    public function show(Paper $paper, $slug)
    {

        // 1 = nd3p13

        return $paper->findByPublicId($slug);

    }


}
