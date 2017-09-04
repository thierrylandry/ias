<?php

namespace App;

use App\Metier\Json\Contact;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    const CLIENT = 'client';
    const FOURNISSEUR = 'fournisseur';

    public $timestamps = false;
    protected $table = 'partenaire';
    protected $guarded = [];

    protected $casts = [
        'contact' => 'array',
    ];

    public function contactString()
    {
        $contactString = "";

        foreach ($this->contact as $contact)
        {
            if($contactString != "")
                $contactString .= " | ";

            $contactString .= sprintf("%s - %s: %s ", $contact["titre_c"],
                Contact::getContactString($contact["type_c"]),
                $contact["valeur_c"]
            );
        }

        return $contactString;
    }
}