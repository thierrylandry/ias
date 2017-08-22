<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 07/05/2017
 * Time: 15:52
 */

namespace App;


class Statut
{
    const TYPE_UTILISATEUR = 1;

    const ETAT_ACTIF = 1;
    const ETAT_INACTIF = 0;
    const AUTRE_NON_DEFINI = 0;

    const MISSION_COMMANDEE = 100;
    const MISSION_EN_COURS = 101;
    const MISSION_TERMINEE = 102;

    const PIECE_COMPTABLE_BON_DE_COMMANDE = 200;
    const PIECE_COMPTABLE_FACTURE = 201;
}