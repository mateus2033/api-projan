<?php

namespace App\Utils;

class ResponseMessage {

    

    public static $sucessGeneric = "Operação realizada com sucesso.";
    public static $errorGeneric  = "Erro ao realizar operação.";
    public static $mustBeString = "mustBeString";
    public static $required = "required";
    public static $mustBeInteger = "mustBeInteger";
    public static $mustNumeric = "mustBeNumeric";


    /**
     * Retorna mensagem generica de sucesso.
     */
    public static function sucessMessage($data, string $message)
    {
        return ['data'=>$data, 'message'=>$message];
    }

    /**
     * Retorna mensagem generica de erro.
     */
    public static function errorMessage($data, string $message)
    {
        return ['data'=>$data, 'message'=>$message, 'code'=>true];
    }
}


