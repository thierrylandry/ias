<?php

namespace App\Http\Controllers\Admin;

use App\Employe;
use App\Metier\Behavior\Notifications;
use App\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class EmployeController extends Controller
{
    public function liste()
    {
        $employes = Employe::orderBy('nom')->orderBy('prenoms')
            ->with('service')
            ->paginate(15);

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
        try{
            $employe = Employe::with("chauffeur","service")->where("matricule",$matricule)->firstOrFail();
            return view("admin.employe.fiche",compact("employe"));
        }catch (ModelNotFoundException $e){
            return back()->withErrors("Employé non trouvé");
        }
    }

    public function modifier($matricule)
    {
        try{
            $services = Service::orderBy('libelle')->get();
            $employe = Employe::with("chauffeur","service")->where("matricule",$matricule)->firstOrFail();
            return view("admin.employe.modifier", compact("employe", "services"));
        }catch (ModelNotFoundException $e){
            return back()->withErrors("Employé non trouvé");
        }
    }

    public function update(Request $request, $matricule)
    {
        try {
            $employe = Employe::with("chauffeur","service")->where("matricule",$matricule)->firstOrFail();
            $update = $request->except("_token");

            $update["datenaissance"] = Carbon::createFromFormat("d/m/Y", $request->input("datenaissance"))->toDateString();
            $update["dateembauche"] = Carbon::createFromFormat("d/m/Y", $request->input("dateembauche"))->toDateString();

            if($request->input("datesortie") != null){
                $update["datesortie"] = Carbon::createFromFormat("d/m/Y", $request->input("datesortie"))->toDateString();
            }

        }catch (ModelNotFoundException $e){
            return back()->withErrors("Employé non trouvé");
        }

        $employe->update($update);

        $notif = new Notifications();
        $notif->add(Notifications::SUCCESS,Lang::get("message.admin.employe.modifier", ['nom' => sprintf("%s %s",$employe->nom, $employe->prenoms)]));
        return redirect()->route("admin.employe.liste")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notif);
    }
}
