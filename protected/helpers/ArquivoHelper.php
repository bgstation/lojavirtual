<?php

class ArquivoHelper {

    public static function renderArquivos($model) {
        $oModulos = Modulo::model()->naoExcluido()->orderByOrdem()->findAllByAttributes(array(
            'produto_id' => $model->id
        ));
        $totalArquivos = 0;
        $return = '<div id="arquivos_cadastrados">';
        foreach ($oModulos as $modulo) {
            $oArquivo = Arquivo::model()->naoExcluido()->orderByOrdem()->findAllByAttributes(array(
                'modulo_id' => $modulo->id
            ));
            if (!empty($oArquivo)) {
                $return .= '<div style="margin-bottom:30px;">';
                $return .= '<h3 class="h3_modulo_' . $modulo->id . '">' . $modulo->titulo . '</h3>';
                $return .= '<ul id="sortable_' . $modulo->id . '" modulo="' . $modulo->id . '" class="sortable arquivos_modulo_' . $modulo->id . '">';
                foreach ($oArquivo as $arquivo) {
                    $totalArquivos++;
                    $return .= '<li style="width:98%;" class="con ui-state-default div_arquivo_' . $arquivo->id . '" arquivo_id="' . $arquivo->id . '"><span class="titulo_arquivo_' . $arquivo->id . '">' . $arquivo->titulo . '</span> - <span class="titulo_tipo_arquivo_' . $arquivo->id . '">' . $arquivo->aTipoArquivo[$arquivo->tipo_arquivo_id] . '</span>';
                    if (!empty($arquivo->carga_horaria) && $arquivo->tipo_arquivo_id == 2) {
                        $return .= ' - <span class="carga_horaria_arquivo_' . $arquivo->id . '">' . $arquivo->carga_horaria . '</span>';
                    }
                    $return .= '<button arquivo_id="' . $arquivo->id . '" style="margin-left:10px;float:right;" class="btn excluir_arquivo" title="Excluir Arquivo"><i class="fa fa-trash-o"></i></button>';
                    $return .= '<button arquivo_id="' . $arquivo->id . '" style="float:right;" class="btn editar_arquivo" data-toggle="modal" data-target="#myModal" title="Editar Arquivo"><i class="fa fa-pencil"></i></button>';
//                    if ($arquivo->tipo_arquivo_id == 1) {
//                        $return .= '<a href="' . $arquivo->getCaminhoArquivo() . '" target="_blank" class="btn" style="float:right;margin-right:10px;" title="Visualizar Arquivo"><i class="fa fa-file"></i></a>';
//                    } else if ($arquivo->tipo_arquivo_id == 2) {
//                        $return .= '<a href="#" class="btn visualizar_video_aula" data-toggle="modal" data-target="#modalVisualizarVideoAula" caminho_arquivo="' . $arquivo->getCaminhoArquivo() . '" style="float:right;margin-right:10px;" title="Visualizar Arquivo"><i class="fa fa-video-camera"></i></a>';
//                    } else if ($arquivo->tipo_arquivo_id == 3) {
//                        $return .= '<a href="#" class="btn visualizar_video_aula" data-toggle="modal" data-target="#modalVisualizarVideoAula" caminho_arquivo="' . $arquivo->getCaminhoArquivo() . '" style="float:right;margin-right:10px;" title="Visualizar Arquivo"><i class="fa fa-video-camera"></i></a>';
//                    }
                    $return .= '</li>';
                }
                $return .= '</ul>';
                $return .= '</div>';
            }
        }
        $return .= '</div>';
        if ($totalArquivos == 0) {
            $return = '<div id="div_nenhum_arquivo_cadastrado"><b>Nenhum Arquivo Cadastrado</b></div>';
        }
        return $return;
    }

}
