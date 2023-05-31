<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/positionCapitals.css" />
        <link rel="stylesheet" href="assets/css/cardWeather.css?v=2" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <title>Clima Tempo</title>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    </head>
<body cardShowActive="0">

    <div class="backgroundCardShow"></div>

    <main>
        <div class="map-brasil">
            <div class="int-map-brasil">
                <!-- <img class="brasil-map" src="assets/img/brazil-map.png" /> -->

                <svg xmlns="http://www.w3.org/2000/svg">
                    <image xlink:href="assets/img/brazil-map.svg"/>
                </svg>
    
                <?php 
                    require "capitalsGenerate.php";
                ?>
    
            </div>
    
        </div>
    </main>

</body>
<script>
    function removerCaracteresEspeciais(string) {
        var mapaAcentosHex = {
            a: /[\xE0-\xE6]/g,
            e: /[\xE8-\xEB]/g,
            i: /[\xEC-\xEF]/g,
            o: /[\xF2-\xF6]/g,
            u: /[\xF9-\xFC]/g,
            c: /\xE7/g,
            n: /\xF1/g
        };

        for (var letra in mapaAcentosHex) {
            var expressaoRegular = mapaAcentosHex[letra];
            string = string.replace(expressaoRegular, letra);
        }

        string = string.replace(/[^\w\s]/gi, '');
        return string;
    }

    $("input[type='submit']").click(function(){
        cidade = removerCaracteresEspeciais($("#cidade").val());

        $.ajax({
            url: 'getTemperatura.php',
            type: 'GET',
            data: {
                city: cidade.split(" ").join("-")
            },
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    })

    function getCardWeather(state){
        httpGet("cardWeather.php?state="+state);
    }

    function httpGet(theUrl)
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
        xmlHttp.send( null );
        $("body").append(xmlHttp.responseText);
        $("body").attr("cardShowActive", "1");
    }

    $(".backgroundCardShow").click(function(){
        $("body").attr("cardShowActive", "0");
        $(".card").remove();
    })

</script>

</html>