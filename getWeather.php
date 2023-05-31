<?php

    $content = file_get_contents("https://www.tempo.com/".$_GET["city"].".htm");

    if (preg_match('/<span class="dato-temperatura changeUnitT" data="[^"]+">([^<]+)/', $content, $matches)) {
        $valor = $matches[1];
        echo $valor;
    }else{
        return 0;
    }
