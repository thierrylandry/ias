<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChauffeurController extends Controller
{
    public function liste()
    {
        return view('admin.chauffeur.liste');
    }

    public function ajouter()
    {

    }
}