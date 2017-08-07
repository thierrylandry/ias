<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 21/07/2017
 * Time: 15:55
 */

namespace App\Metier\Finance;


class NombreToLettre
{
    public static function getLetter($number)
    {
        return rtrim(
            self::millier($number)
        );
    }

    private static function millier($valeur)
    {
        $resultat = "";
        $nbreFois = 0;
        $reste = 0;

        //Milliard ou nombre entre dix (10) et douze (12) chiffres
        $nbreFois = floor($valeur / 1000000000);
        $reste = $valeur % 1000000000;

        if($nbreFois == 1)
        {
            $resultat .= "un milliard ";

        } else if ($nbreFois > 1)  {

            $resultat .= self::centaine($nbreFois) . "milliard ";
        }
        $valeur = $reste;

        //Millions ou nombre entre sept (07) et neuf (09) chiffres
        $nbreFois = floor($valeur / 1000000);
        $reste = $valeur % 1000000;

        if($nbreFois == 1)
        {
            $resultat .= "un million ";

        }else if ($nbreFois > 1) {

            $resultat .= self::centaine($nbreFois) . "millions ";
        }

        $valeur = $reste;

        //Millier ou nombre entre quatre (04) et six (06) chiffres
        $nbreFois = floor($valeur/1000);
        $reste = $valeur % 1000;

        if( $nbreFois == 1)
        {
            $resultat .= "mille ";

        }else if($nbreFois > 1 ) {

            $resultat .= self::centaine($nbreFois) . "mille " . self::centaine($reste);

        }else{

            $resultat .= self::centaine($reste);
        }

        return $resultat;
    }

    private static function centaine($valeur)
    {
        $resultat = "";
        $reste = 0;
        $nbFois = null;

        //centaine ou nombre à trois (03) chiffres
        $nbFois = floor($valeur / 100);
        $reste = $valeur % 100;

        if ($nbFois == 1)
        {
            $resultat .= "cent ";

        }elseif(1 < $nbFois) {

            $resultat .= self::dizaine($nbFois) . "cent ";
        }

        $resultat .= self::compose($reste);

        return $resultat;
    }

    private static function compose($valeur)
    {
        $resultat = null;

        //dizaine ou nombre à deux (02) chiffres
        $nbFois = floor($valeur / 10);
        $reste = $valeur % 10;

        if (($nbFois <= 2) && ($reste == 0))
        {
            $resultat .= self::dizaine($valeur);
        }
        else
        {
            if ((($nbFois + 18) == 27) || (($nbFois + 18) == 25))
            {
                $resultat .= self::dizaine($nbFois + 18) . " " . self::dizaine($reste + 10);
            }
            else
            {
                if($nbFois == 0)
                {
                    $resultat .= self::dizaine($reste);

                }else if ($nbFois == 1){

                    $resultat .= self::dizaine($reste+10);

                }else{

                    if((20 <= ($nbFois + 18)) && $reste == 1)
                    {
                        $resultat .= self::dizaine($nbFois + 18) . " et " . self::dizaine($reste);

                    }else{

                        $resultat .= self::dizaine($nbFois + 18) . self::dizaine($reste);
                    }
                }
            }
        }

        return $resultat;
    }

    private static function dizaine($valeur)
        {
            $resultat = null;

            switch (intval($valeur))
            {
                case 1:
                    $resultat = "un ";
                    break;
                case 2:
                    $resultat = "deux ";
                    break;
                case 3:
                    $resultat = "trois ";
                    break;
                case 4:
                    $resultat = "quatre ";
                    break;
                case 5:
                    $resultat = "cinq ";
                    break;
                case 6:
                    $resultat = "six ";
                    break;
                case 7:
                    $resultat = "sept ";
                    break;
                case 8:
                    $resultat = "huit ";
                    break;
                case 9:
                    $resultat = "neuf ";
                    break;
                case 10:
                    $resultat = "dix ";
                    break;
                case 11:
                    $resultat = "onze ";
                    break;
                case 12:
                    $resultat = "douze ";
                    break;
                case 13:
                    $resultat = "treize ";
                    break;
                case 14:
                    $resultat = "quatorze ";
                    break;
                case 15:
                    $resultat = "quinze ";
                    break;
                case 16:
                    $resultat = "seize ";
                    break;
                case 17:
                    $resultat = "dix-sept ";
                    break;
                case 18:
                    $resultat = "dix-huit ";
                    break;
                case 19:
                    $resultat = "dix-neuf ";
                    break;
                case 20:
                    $resultat = "vingt ";
                    break;
                case 21:
                    $resultat = "trente ";
                    break;
                case 22:
                    $resultat = "quarante ";
                    break;
                case 23:
                    $resultat = "cinquante ";
                    break;
                case 24:
                    $resultat = "soixante ";
                    break;
                case 25:
                    $resultat = "soixante ";
                    break;
                case 26:
                    $resultat = "quatre-vingt ";
                    break;
                case 27:
                    $resultat = "quatre-vingt ";
                    break;
                default:
                    $resultat = "";
                    break;
            }

            return $resultat;
        }
}