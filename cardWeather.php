<?php
    $content = json_decode(file_get_contents("assets/json/weatherData.json"), true);

    $keyState = array_search($_GET['state'], array_column($content, 'state'));

    $weatherData = $content[$keyState];

    $mm = intval($weatherData["mm_rain"]);
    if( $mm == 0 ){
        $mm = 0;
    }else if( $mm > 0 && $mm < 10 ){
        $mm = 1;
    }else if( $mm >= 10 && $mm < 30 ){
        $mm = 2;
    }else {
        $mm = 3;
    }
?>
<div class="card">
    <div class="int-card">
        <span class="localization"><?= $weatherData["city"] ?> - <?= $weatherData["state"] ?></span>
        <img class="iconWeather" src="assets/img/large-<?= $weatherData['icon_image'] ?>" />
        <div class="weatherData">

            <div class="maxMinWeather">
                <div class="maxWeather"><?= $weatherData["max_temperature"] ?></div>
                <div class="minWeather"><?= $weatherData["min_temperature"] ?></div>
            </div>

            <div class="pctRain">
                <div class="drops" qtdDrops="<?= $mm ?>">
                    <?= $weatherData["mm_rain"] ?>
                </div>
                <div class="pctRain">
                    <?= $weatherData["pct_rain"] ?>% de chuva
                </div>
            </div>

        </div>
    </div>
</div>