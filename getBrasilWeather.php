<?php
    date_default_timezone_set('America/Sao_Paulo');
    $night = 0;
    if( date('H') >= 18 || date('H') <= 6 ){
        $night = 1;
    }
    

    $content = file_get_contents("https://www.climatempo.com.br/brasil");

    $city_regex = '/<a\s+href="[^"]+" class="city">([^<]+)/';
    $temperature_regex = '/<p class="max[^>]+>\s*<span[^>]+>\s*<\/span>\s*([^<]+)/';
    $min_temperature_regex = '/<p class="min[^>]+>\s*<span[^>]+>\s*<\/span>\s*([^<]+)/';
    $rain_regex = '/([0-9]+)mm \| ([0-9]+)% de chuva/';

    preg_match_all($city_regex, $content, $city_matches);
    preg_match_all($temperature_regex, $content, $temperature_matches);
    preg_match_all($min_temperature_regex, $content, $min_temperature_matches);
    preg_match_all($rain_regex, $content, $rain_matches);

    $cities = $city_matches[1];
    $temperatures = $temperature_matches[1];
    $min_temperatures = $min_temperature_matches[1];
    $rains = $rain_matches[0];

    $cities_data = [];
    for ($i = 0; $i < count($temperatures); $i++) {
        $pct_rain = explode("%", explode(" | ", $rains[$i])[1])[0];

        if($pct_rain > 50 && $night ){
            $icon_image = "icone-noite-chuva.png";

        }else if( $pct_rain <= 50 && $night ){
            $icon_image = "icone-noite.png";

        }else if($pct_rain > 50 && !$night ){
            $icon_image = "icone-dia-chuva.png";

        }else{
            $icon_image = "icone-dia.png";

        }

        $city_data = array(
            'city' => explode(" - ", $cities[$i])[0],
            'state' => explode(" - ", $cities[$i])[1],
            'max_temperature' => trim($temperatures[$i]),
            'min_temperature' => trim($min_temperatures[$i]),
            'mm_rain' => explode(" | ", $rains[$i])[0],
            'pct_rain' => $pct_rain,
            'icon_image' => $icon_image
        );
        array_push($cities_data, $city_data);

    }
    $cities_data = json_encode($cities_data);

    echo $cities_data;
    file_put_contents("assets/json/weatherData.json", $cities_data);

