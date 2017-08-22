<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    public $timestamps = false;
    protected $table = "application";
    protected  $hidden = ['*'];

    private static $instance = null;

    private $sendmail;
    private $numeroproforma;
    private $numerobl;
    private $numerofacture;
    private $prefix;
    private $mailcopy;

    /**
     * @return $this
     */
    protected static function getApplicationInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = Application::first();
        }
        return self::$instance;
    }

    public static function getMailCopie()
    {
        return self::getApplicationInstance()->mailcopy;
    }

    /**
     * @return bool
     */
    public static function getPermitToSendMail()
    {
        return self::getApplicationInstance()->sendmail == "Y" ? true : false;
    }

    /**
     * @param bool $increment
     * @return integer
     */
    public static function getNumeroBL($increment = false)
    {
        $numeroBL = self::getApplicationInstance()->numerobl;

        if($increment){
            self::getApplicationInstance()->numerobl++;
            self::getApplicationInstance()->save();
        }
        return $numeroBL;
    }

    /**
     * @param bool $increment
     * @return integer
     */
    public static function getNumeroProforma($increment = false)
    {
        $numeroProforma = self::getApplicationInstance()->numeroproforma;

        if($increment){
            self::getApplicationInstance()->numeroproforma++;
            self::getApplicationInstance()->save();
        }
        return $numeroProforma;
    }

    public static function getInitial()
    {
        return strtoupper(substr(Auth::user()->employe->nom,0,1).substr(Auth::user()->employe->prenoms,0,1));
    }

}
