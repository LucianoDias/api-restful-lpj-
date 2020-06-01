<?php 
namespace App\Help;
/**
 * Undocumented class
 * Help de Errors  
 */
class ApiError
{
    public static function erroMessage($message ,$code){
        return [
            'data' =>[
                'msg' =>$message,
                'code' => $code
            ] 
        ];
    }


}