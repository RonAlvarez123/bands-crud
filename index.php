<?php

include('./functions.php');

$xml = new DOMdocument();
$xml->load('IconicOpmBands.xml');

$bandsXml = $xml->getElementsByTagName('band');
$bands = [];

for ($i = 0; $i < count($bandsXml); $i++) {
    $bands[$i] = [
        'bandCode' => $bandsXml[$i]->getAttribute('bandCode'),
        'bandName' => $bandsXml[$i]->getElementsByTagName('bandName')->item(0)->nodeValue,
        'debut' => $bandsXml[$i]->getElementsByTagName('debut')->item(0)->nodeValue,
        'hitSong' => $bandsXml[$i]->getElementsByTagName('hitSong')->item(0)->nodeValue,
        'genres' => getGenres($bandsXml[$i]->getElementsByTagName("genre"))
    ];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/globalStyles.css">
    <link rel="stylesheet" href="css/index.css">
    <title>OPM Bands</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>

<body>

    <div class="main-container">
        <div class="container">
            <header>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="" class="search">
                    <input type="text" placeholder="Search band...">
                    <button type="submit" class="btn-click">
                        <img src="svg/search-solid.svg" alt="">
                    </button>
                </form>
                <section class="links">
                    <a href="updateBand.php" class="a-click btn-update">Update</a>
                    <a href="deleteBand.php" class="a-click btn-delete">Delete</a>
                </section>
            </header>

            <main>
                <section class="header">
                    <p>#</p>
                    <p>BandName</p>
                    <p>Debut</p>
                    <p>HitSong</p>
                    <p>Genres</p>
                </section>
                <div class="bands">
                    <?php foreach ($bands as $band) { ?>
                        <section>
                            <p><?php echo $band['bandCode'] ?></p>
                            <p><?php echo $band['bandName'] ?></p>
                            <p><?php echo $band['debut'] ?></p>
                            <p><?php echo $band['hitSong'] ?></p>
                            <p><?php echo $band['genres'] ?></p>
                        </section>
                    <?php } ?>
                </div>
            </main>

            <footer>
                <a href="addBand.php" class="a-click">Add Band</a>
            </footer>
        </div>
    </div>

    <script src="js/a_click_jquery.js"></script>
</body>

</html>