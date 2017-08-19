<?php

namespace App;

use App\Metier\Json\Contact;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    const CLIENT = 'client';
    const FOURNISSEUR = 'fournisseur';

    protected $table = 'partenaire';
    protected $guarded = [];
    public $timestamps = false;


    public function contactString()
    {
        $raw = json_decode($this->contact);
        $contactString = "";

        foreach ($raw as $contact)
        {
            if($contactString != "")
                $contactString .= " | ";

            $contactString .= sprintf("%s - %s: %s ", $contact->titre_c,
                Contact::getContactString($contact->type_c),
                $contact->valeur_c
            );
        }

        return $contactString;
    }
}
