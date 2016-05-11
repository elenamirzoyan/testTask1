<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Images;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = '';
        if(auth()->check())
            $images = Images::where('user_id', auth()->user()->id)->lists('slug', 'name');

        return view('home', compact('images'));
    }
}
