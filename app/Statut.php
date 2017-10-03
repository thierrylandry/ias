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
    const MISSION_ANNULEE = 103;
    const MISSION_TERMINEE_SOLDEE = 104;

    const PIECE_COMPTABLE_PRO_FORMA = 200;
    const PIECE_COMPTABLE_FACTURE_SANS_BL = 201;
    const PIECE_COMPTABLE_FACTURE_AVEC_BL = 202;

    /**
     * @param int $statut
     * @return null|string
     */
    public static function getStatut($statut)
    {
        $string = null;

        switch ($statut){
            case self::PIECE_COMPTABLE_PRO_FORMA : $string = "Facture pro forma"; break;
            case self::PIECE_COMPTABLE_FACTURE_AVEC_BL : $string = "Facture"; break;
            case self::PIECE_COMPTABLE_FACTURE_SANS_BL : $string = "Facture (non livrée)"; break;

            case self::MISSION_COMMANDEE : $string = "Mission commandée"; break;
            case self::MISSION_EN_COURS : $string = "Mission en cours"; break;
            case self::MISSION_TERMINEE : $string = "Mission terminée"; break;
            case self::MISSION_ANNULEE : $string = "Mission annulée"; break;
        }
        return $string;
    }
}