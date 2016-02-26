<?php

class ModuloHelper {

    public static function renderModulos($model) {
        $oModulos = Modulo::model()->naoExcluido()->orderByOrdem()->findAllByAttributes(array(
            'produto_id' => $model->id
        ));
        $return = '<div id="div_nenhum_modulo_cadastrado"><b>Nenhum Módulo Cadastrado</b></div>';
        if (!empty($oModulos)) {
            $return = '<ul id="sortable" class="modulos_cadastrados">';
            foreach ($oModulos as $modulo) {
                $return .= '<li style="width:98%;" class="ui-state-default" modulo_id=' . $modulo->id . ' >';
                $return .= '<span class="titulo_modulo_' . $modulo->id . '">' . $modulo->titulo . '</span>';
                $return .= '<button modulo_id="' . $modulo->id . '" style="margin-left:10px;float:right;" class="btn excluir_modulo"><i class="fa fa-trash-o"></i></button>';
                $return .= '<button modulo_id="' . $modulo->id . '" style="float:right;" class="btn editar_modulo" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>';
                
                $return .= '</li>';
            }
            $return .= '</ul>';
        }
        return $return;
    }

}
