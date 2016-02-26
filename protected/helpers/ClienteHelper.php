<?php

class ClienteHelper {
    
    public static function renderDataNascimento($dataNascimento) {
        $aDataNascimento = explode('-', $dataNascimento);
        return $aDataNascimento[2] . '/' . $aDataNascimento[1] . '/' . $aDataNascimento[0];
    }
    
}