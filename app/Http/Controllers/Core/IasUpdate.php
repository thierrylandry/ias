<?php
/**
 * Created by PhpStorm.
 * User: SUPPORT.IT
 * Date: 20/05/2019
 * Time: 11:42
 */

namespace App\Http\Controllers\Core;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IasUpdate extends Controller {

	public static function checkDataBaseMAJ(){
		$instructions = self::getFileDBupdate();
		$sqls = explode(';', $instructions);
		unset($sqls[count($sqls)-1]); //On supprime la dernière valeeur qui est null

		foreach ($sqls as $sql){
			try{
				DB::select(trim($sql));
			}catch (\Exception $e){
				$e->getMessage();
			}
		}
	}

	/**
	 * @return string
	 */
	private static function getFileDBupdate(): string {
		return file_get_contents(base_path().'/DB.updt');
	}
}