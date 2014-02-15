<?php

namespace Core;

/**
 * Validation.
 *
 * @author Yosuke Ohshima
 */
class Validation
{
    // 数値のチェック
    public static function isNatural($number)
    {
        if(is_numeric($number) && 0 < (int)$number){
            return true;
        }
        return false;
    }

}
