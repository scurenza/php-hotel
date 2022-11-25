<?php
$data = $_GET;
// var_dump($data);
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

if ($_GET["hotel-parking"] && $_GET["hotel-vote"]) {
    foreach ($hotels as $hotel) {
        if ($data["hotel-parking"] === 'true' && $hotel['parking'] && $hotel["vote"] >= $data["hotel-vote"]) {
            $filtered[] = $hotel;
        } elseif ($data["hotel-parking"] === 'false' && !$hotel['parking'] && $hotel["vote"] >= $data["hotel-vote"]) {
            $filtered[] = $hotel;
        }
    }
} elseif ($_GET["hotel-parking"]) {
    foreach ($hotels as $hotel) {
        if ($data["hotel-parking"] === 'true' && $hotel['parking']) {
            $filtered[] = $hotel;
        } elseif ($data["hotel-parking"] === 'false' && !$hotel['parking']) {
            $filtered[] = $hotel;
        }
    }
} elseif ($_GET["hotel-vote"]) {
    foreach ($hotels as $hotel) {
        if ($hotel["vote"] >= $data["hotel-vote"]) {
            $filtered[] = $hotel;
        }
    }
} elseif (!$_GET) {
    foreach ($hotels as $hotel) {
        $filtered[] = $hotel;
    }
}

// var_dump($filtered);
?>


<!-- // foreach ($hotels as $hotel) {
//     foreach ($hotel as $key => $item) {
//         echo "<h3>" . $key . ": " . "</h3>" . $item;
//         // echo "</br>";
//     }
//     echo "</hr>";
// } -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Hotels</title>

    <!-- Bootstrap -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <section class="hotels">
        <form action="index.php" method="GET">
            <div class="m-3">
                <label for="hotel-parking">L'Hotel deve avere il parcheggio?</label>
                <select name="hotel-parking" id="hotel-parking">
                    <option value=""></option>
                    <option value="true">Si</option>
                    <option value="false">No</option>
                </select>
            </div>
            <div class="m-3">
                <label for="hotel-vote">Quante stelle deve avere minimo?</label>
                <input type="text" name="hotel-vote" id="hotel-vote" placeholder="0">
            </div>
            <div class="m-3">
                <button class="me-3" type="submit">Invia</button>
                <button class="me-3" type="reset">Cancella</button>
                <a href="index.php">Cancella i filtri</a>
            </div>
        </form>
        <h1>Lista Hotels</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro [km]</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($filtered as $hotel) { ?>
                    <tr>
                        <?php foreach ($hotel as $key => $item) {
                            if ($key === "parking") {
                                if ($item) { ?>
                                    <th scope="row"> <?php echo "presente" ?> </th>
                                <?php } else { ?>
                                    <th scope="row"> <?php echo "assente" ?> </th>
                                <?php }
                            } else {
                                ?>

                                <th scope="row"> <?php echo $item ?> </th>
                        <?php }
                        } ?>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>