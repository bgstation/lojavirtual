<?php

class FormatHelper {
    
    public static function tratarNomeImagem($string) {
        $string = preg_replace('/[áàãâä]/ui', 'a', $string);
        $string = preg_replace('/[éèêë]/ui', 'e', $string);
        $string = preg_replace('/[íìîï]/ui', 'i', $string);
        $string = preg_replace('/[óòõôö]/ui', 'o', $string);
        $string = preg_replace('/[úùûü]/ui', 'u', $string);
        $string = preg_replace('/[ç]/ui', 'c', $string);
        $string = preg_replace('/[ ]/ui', '_', $string);
        $string = preg_replace('/_+/', '_', $string);
        $string = strtolower($string);
        return $string;
    }
    
    public static function valorMonetario($valor) {
        if (empty($valor)) {
            return $valor;
        }
        return number_format($valor, 2, ',', '.');
    }
    
    public static function data($valor) {
        if (empty($valor)) {
            return $valor;
        }
        return date('d/m/Y', strtotime($valor));
    }
    
    public static function dataHora($valor) {
        if (empty($valor)) {
            return $valor;
        }
        return date('d/m/Y H:i:s', strtotime($valor));
    }
    
}