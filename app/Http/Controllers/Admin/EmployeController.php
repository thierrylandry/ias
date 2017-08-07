<?php

namespace App\Http\Controllers\Admin;

use App\Employe;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeController extends Controller
{
    public function liste()
    {
        $employes = Employe::orderBy('nom')->orderBy('prenoms')
            ->with('service')
            ->get();

        return view('admin.employe.liste',compact('employes'));
    }

    public function ajouter()
    {
        $services = Service::orderBy('libelle')->get();
        return view('admin.employe.ajouter',compact('services'));
    }
}
