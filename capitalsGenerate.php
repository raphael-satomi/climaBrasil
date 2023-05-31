<?php
    $url = 'http://localhost/climaTempo/getBrasilWeather.php';

    $curl = curl_init();    
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($curl), true);
    
    curl_close($curl);

    foreach( $response as $capital){ ?>
        <div class="icon" state="<?= $capital['state'] ?>" 
                onclick="getCardWeather( '<?= $capital['state'] ?>')">

            <div class="data-temperature">
                <div class="int-icon">
                    <img src="assets/img/<?= $capital['icon_image'] ?>" />
                    <span class="state-name"><?= $capital['city'] ?></span>
                </div>
                <div class="temperature-level">
                    <span class="max-temperature"><?= $capital['max_temperature'] ?></span>
                    <span class="min-temperature"><?= $capital['min_temperature']?></span>
                </div>
            </div>
        </div><?php
    }

?>