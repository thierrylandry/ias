<?php

namespace App\Http\Controllers\Admin;

use App\Employe;
use App\Metier\Behavior\Notifications;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

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

    public function register(Request $request)
    {
        $this->validate($request, [
            "service_id" => "required|exists:service,id",
            "datesortie" => "present",
            "dateembauche" => "required|date_format:d/m/Y",
            "datenaissance" => "required|date_format:d/m/Y",
            "contact" => "required",
            "prenoms" => "required",
            "nom" => "required",
            "matricule" => "required",
        ]);

        $this->addEmploye($request);

        $notif = new Notifications();
        $notif->add(Notifications::SUCCESS,Lang::get("message.admin.employe.ajout"));
        return redirect()->route("admin.employe.liste")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notif);
    }

    private function addEmploye(Request $request)
    {
        $employe = new Employe($request->except("_token"));
        $employe->datenaissance = Carbon::createFromFormat("d/m/Y", $request->input("datenaissance"))->toDateString();
        $employe->dateembauche = Carbon::createFromFormat("d/m/Y", $request->input("dateembauche"))->toDateString();

        if($request->input("datesortie") != null){
            $employe->datesortie = Carbon::createFromFormat("d/m/Y", $request->input("datesortie"))->toDateString();
        }

        $employe->saveOrFail();
    }

    public function fiche($matricule)
    {
        return view("admin.employe.fiche");
    }
}
