<?php

namespace App\Http\Controllers\Mail;

use App\Application;
use App\Http\Controllers\Order\Process;
use App\Mail\FactureProforma;
use App\PieceComptable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    use Process;

    public function envoyerProforma($reference, Request $request)
    {
        $piece = $this->getPieceComptableForReference($reference);

        $collection = new Collection();

        foreach ($request->input("email") as  $email)
        {
            $collection->push(["email" => $email]);
        }
        //return view("mail.proforma", compact("piece"));

        Mail::to($collection)
            ->cc(Application::getMailCopie())
            ->send(new FactureProforma($piece, PieceComptable::PRO_FORMA ));
    }
}
