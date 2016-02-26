<div id="home">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#home-slider" data-slide-to="0" class="active"></li>
            <li data-target="#home-slider" data-slide-to="1"></li>
            <?= BannerHelper::renderContadorBanners($oBanners) ?>
        </ol>
        <div class="carousel-inner">
            <?= BannerHelper::renderBanners($oBanners) ?>
        </div>
        <a class="left carousel-control" href="#home-slider" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right carousel-control" href="#home-slider" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
        <div class="pattern"></div>
    </div>
</div>