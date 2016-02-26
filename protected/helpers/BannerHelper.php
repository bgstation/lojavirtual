<?php

class BannerHelper {

    public static function renderBanners($oBanners) {
        $return = '';
        $cont = 1;
        foreach ($oBanners as $banner) {
            $classe = $cont == 1 ? 'active' : '';
            $return .= '<div class="item ' . $classe . '">';
            $return .= '<img src="' . $banner->getImagem() . '" />';
            $return .= '</div>';
            $cont++;
        }
        return $return;
    }

    public static function renderContadorBanners($oBanners) {
        $return = '';
        $cont = 0;
        foreach ($oBanners as $banner) {
            $classe = $cont == 0 ? 'class="active"' : '';
            $return .= '<li data-target="#home-slider" data-slide-to="' . $cont++ . '" ' . $classe . '></li>';
            $cont++;
        }
        return $return;
    }

}

?>