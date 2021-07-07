<?php

include('./functions.php');

$xml = new DOMdocument();
$xml->load('IconicOpmBands.xml');

$bandsXml = $xml->getElementsByTagName('band');
$bands = [];

if (isset($_GET['search'])) {
    for ($i = 0; $i < count($bandsXml); $i++) {
        $bandName = strtolower($bandsXml[$i]->getElementsByTagName('bandName')->item(0)->nodeValue);

        if (strpos($bandName, strtolower($_GET['search'])) !== false) {
            include('./partials/appendBand.php');
        }
    }
} else {
    for ($i = 0; $i < count($bandsXml); $i++) {
        include('./partials/appendBand.php');
    }
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
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="search">
                    <div class="search-container">
                        <input type="text" placeholder="Search band..." name="search" autocomplete="off">
                        <ul class="search-results hide"></ul>
                    </div>
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
                <?php if (count($bands) > 0) { ?>
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
                <?php } else { ?>
                    <h2>No Results Found</h2>
                <?php } ?>
            </main>

            <footer>
                <a href="addBand.php" class="a-click">Add Band</a>
            </footer>
        </div>
    </div>

    <script src="js/jquery_anchorClick.js"></script>
    <script src="js/jquery_searchResultVisibility.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/jquery_fetchSearchResults.js"></script>
</body>

</html>