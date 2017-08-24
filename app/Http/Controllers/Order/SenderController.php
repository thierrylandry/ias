<?php

namespace App\Http\Controllers\Order;

use App\PieceComptable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SenderController extends Controller
{
    public function choice(Request $request, $reference)
    {
        dd(PieceComptable::with('lignes')->where("referenceproforma",$reference)->first());
    }
}
