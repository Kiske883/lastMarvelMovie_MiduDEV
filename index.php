<?php
/*  Este es el comando para levantar php en un puerto en concreto
    php -S localhost:8000 */
const API_URL = "https://whenisthenextmcufilm.com/api";

// Inicializamos el curlHandle
$ch = curl_init(API_URL);

/* Indicamos que queremos recibir el resultado de la peticion CURL 
   y no mostrarla por pantalla */
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

/* Ejecutamos la peticion y almacenamos el resultado */
$result = curl_exec($ch);

/* En lugar de hacerlo de esta forma podriamos hacer de una forma más
   sencilla, ahora bien, esta forma solo permite GET
   $result = file_get_contents(API_URL);   
*/

/* Ahora vamos a parsear los datos en un Json 
   el segundo parametro le indicamos que lo queremos 
   con un array asociativo */
$data = json_decode($result, true);

/* Despues de parsear los datos en $data
   lo que tenemos que hacer es cerrar el curlhandle */
curl_close($ch);

// Hacemos una var_dump para saber que contiene data
// var_dump($data);

?>

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="La próxima película de Marvel" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>La próxima película de Marvel</title>

    <link rel="stylesheet" href="css/style.css" />

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>

<main>
    <pre >
        <?php var_dump($data); ?>
    </pre>
    <section >
        <h2>La próxima película de Marvel</h2>
        <img class = "img" src="<?= $data["poster_url"]; ?>" alt= "Poster de <?= $data["title"]; ?>" />
    </section>
    <hgroup>
        <h2><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días.</h2>
        <p>Fecha de estreno : <?= $data["release_date"]; ?> </p>
        <p>La siguiente es: <?= $data["following_production"]["title"]; ?> </p>
    </hgroup>
</main>