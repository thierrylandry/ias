<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function envoyerProforma(Request $request)
    {
        dd($request->input());
    }
}
