<?php

namespace App\Http\Controllers;

use App\Pdf\PdfMaker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use PdfMaker;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }
}
