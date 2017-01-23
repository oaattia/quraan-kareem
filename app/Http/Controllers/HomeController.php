<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function search()
    {
        // todo: we should do the search here to the key sent
        return request()->get('key');
    }

}
