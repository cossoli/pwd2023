<?php

namespace Raiz\Auxi\Utiles;

class Utileria
{

    public static function PasarAJson(String $AJson): array
    {

        return Json_Decode($AJson, true);
    }
}
