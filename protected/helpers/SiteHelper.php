<?php

class SiteHelper {

    public static function renderErros($aErros) {
        $return = '';
        if (empty($aErros)) {
            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                $aErros[] = $message;
            }
            if (empty($aErros)) {
                $aErros = Yii::app()->user->getState('aErros');
                Yii::app()->user->setState('aErros', null);
            }
            if (empty($aErros)) {
                return $return;
            }
        }
        $return .= '<ol class="breadcrumb flash_message_erro">';
        $return .= '<li>';
        foreach ($aErros as $campo => $erro) {
            $return .= strlen($erro[0]) == 1 ? $erro . '<br/>' : $erro[0] . '<br/>';
        }
        $return .= '</li>';
        $return .= '</ol>';
        Yii::app()->user->setState('aErros', null);
        return $return;
    }

    public static function renderFlashMessage() {
        $return = '';
        $flashMessages = Yii::app()->user->getFlashes();
        if ($flashMessages) {
            $return .= '<ul class="flashes">';
            foreach ($flashMessages as $key => $message) {
                $return .= '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
            }
            $return .= '</ul>';
        }
        return $return;
    }

}
