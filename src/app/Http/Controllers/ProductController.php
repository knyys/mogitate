<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function product()
    {
        return view('product');
    }

    public function register()
    {
        return view('register');
    }

}