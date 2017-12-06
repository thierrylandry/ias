<?php

namespace App\Http\Controllers\Admin;

use App\Employe;
use App\Metier\Behavior\Notifications;
use App\Statut;
use App\Utilisateur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::with("employe.service")->get();
        return view("admin.utilisateur.liste", compact("utilisateurs"));
    }

    public function ajouter()
    {
        $employes = Employe::orderBy('nom','asc')
            ->whereNotIn('id',Utilisateur::select(['employe_id'])->get()->toArray())
            ->orderBy('prenoms', 'asc')
            ->get();

        return view("admin.utilisateur.ajouter", compact("employes"));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            "employe_id" => "required|exists:employe,id",
            "login" => "required",
            "password" => "required|confirmed",
        ]);

        $this->addUser($request);

        $notif = new Notifications();
        $notif->add(Notifications::SUCCESS, Lang::get("message.admin.utilisateur.ajout"));
        return redirect()->route("admin.utilisateur.liste")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notif);
    }

    private function addUser(Request $request)
    {
        try{
            $user = new Utilisateur($request->except("_token", "password_confirmation"));
            $user->password = bcrypt($request->input("password"));
            $user->login.= "@ivoireautoservices.net";
            $user->satut = Statut::TYPE_UTILISATEUR.Statut::ETAT_ACTIF.Statut::AUTRE_NON_DEFINI;
            $user->employe_id = $request->input("employe_id");

            $user->saveOrFail();
        }catch (QueryException $e){
            logger($e->getMessage());
        }catch (\Exception $e){
            logger($e->getMessage());
        }
    }
}
