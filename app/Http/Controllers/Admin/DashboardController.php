<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(Paper $paper)
    {
        return view('admin.dashboard',[
            'papers' => $paper->get()
        ]);
    }
}
