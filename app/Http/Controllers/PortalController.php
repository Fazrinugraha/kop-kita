<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        // Basic placeholder method for portal index
        return view('pages/front/portal');
    }
}
