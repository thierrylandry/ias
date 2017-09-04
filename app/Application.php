<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    public $timestamps = false;

    protected $table = "application";
    protected $primaryKey = "version";
    protected $hidden = [];

    //$length = 8;

    private static $instance = null;

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
        $numeroBL = sprintf("%08d", self::getApplicationInstance()->numerobl);

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
        $numeroProforma =  sprintf("%08d", self::getApplicationInstance()->numeroproforma);

        if($increment){
            self::getApplicationInstance()->numeroproforma++;
            self::getApplicationInstance()->save();
        }
        return $numeroProforma;
    }

    /**
     * @param bool $increment
     * @return integer
     */
    public static function getNumeroMission($increment = false)
    {
        $numeroMission =  sprintf("%08d", self::getApplicationInstance()->numeromission);

        if($increment){
            self::getApplicationInstance()->numeromission++;
            self::getApplicationInstance()->save();
        }
        return $numeroMission;
    }

    public static function getInitial()
    {
        return strtoupper(substr(Auth::user()->employe->nom,0,1).substr(Auth::user()->employe->prenoms,0,1));
    }
}
