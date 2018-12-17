<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Advert;

class APIHomeController extends Controller
{
    public function index()
    {
    	$adverts = Advert::all();

    	return $adverts->toJson();
    }
}
