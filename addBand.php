<?php

include('./partials/partial.php');

if (isset($_POST['addBand'])) {
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $emptyFields[$field] = ucwords($field) . ' is empty.';
        }
    }

    if (!array_filter($emptyFields)) {

        // var_dump($_POST['genres']);
        // exit;

        $newBand['code'] = $_POST['bandCode'];
        $newBand['genres'] = explode(", ", $_POST['genres']);

        $band = $xml->createElement("band");
        $band->setAttribute("bandCode", $newBand['code']);
        $newBand['name'] = $xml->createElement("bandName", $_POST['bandName']);
        $newBand['debut'] = $xml->createElement("debut", $_POST['debut']);
        $newBand['hitSong'] = $xml->createElement("hitSong", $_POST['hitSong']);
        $createGenres = $xml->createElement("genres");

        foreach ($newBand['genres'] as $genre) {
            $createGenre = $xml->createElement("genre", $genre);
            $createGenres->appendChild($createGenre);
        }

        $band->appendChild($newBand['name']);
        $band->appendChild($newBand['debut']);
        $band->appendChild($newBand['hitSong']);
        $band->appendChild($createGenres);

        $xml->getElementsByTagName("bands")->item(0)->appendChild($band);
        $xml->save("IconicOpmBands.xml");

        $success = true;
        unset($_POST);
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
    <link rel="stylesheet" href="css/addBand.css">
    <title>Add Band</title>
</head>

<body>
    <div class="main-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="container form-submit">
            <h1>Add Band</h1>
            <div class="multi-input">
                <div>
                    <label>Band Code</label>
                    <input type="number" name="bandCode" class="<?php echo $emptyFields['bandCode'] ? 'input-danger' : ''; ?>" value="<?php echo $_POST['bandCode'] ?? ''; ?>">
                    <p class="<?php echo $emptyFields['bandCode'] ? 'text-danger' : ''; ?>"><?php echo $emptyFields['bandCode'] ?? ''; ?></p>
                </div>
                <div>
                    <label>Debut</label>
                    <input type="number" name="debut" class="<?php echo $emptyFields['debut'] ? 'input-danger' : ''; ?>" value="<?php echo $_POST['debut'] ?? ''; ?>">
                    <p class="<?php echo $emptyFields['debut'] ? 'text-danger' : ''; ?>"><?php echo $emptyFields['debut'] ?? ''; ?></p>
                </div>
            </div>
            <div>
                <label>Band Name</label>
                <input type="text" name="bandName" class="<?php echo $emptyFields['bandName'] ? 'input-danger' : ''; ?>" value="<?php echo $_POST['bandName'] ?? ''; ?>" autocomplete="off">
                <p class="<?php echo $emptyFields['bandName'] ? 'text-danger' : ''; ?>"><?php echo $emptyFields['bandName'] ?? ''; ?></p>
            </div>
            <div>
                <label>Hit Song</label>
                <input type="text" name="hitSong" class="<?php echo $emptyFields['hitSong'] ? 'input-danger' : ''; ?>" value="<?php echo $_POST['hitSong'] ?? ''; ?>" autocomplete="off">
                <p class="<?php echo $emptyFields['hitSong'] ? 'text-danger' : ''; ?>"><?php echo $emptyFields['hitSong'] ?? ''; ?></p>
            </div>
            <div>
                <label>Genres &#40;<span>Press Enter to add genre/Click an added genre to remove it</span>&#41;</label>
                <input type="text" class="inputGenre <?php echo $emptyFields['genres'] ? 'input-danger' : ''; ?>">
                <input type="text" name="genres" value="<?php echo $_POST['genres'] ?? ''; ?>" hidden>
                <p class="<?php echo $emptyFields['genres'] ? 'text-danger' : ''; ?>"><?php echo $emptyFields['genres'] ?? ''; ?></p>
                <div class="genres">
                    <?php if (isset($_POST['genres']) && !empty($_POST['genres'])) { ?>
                        <?php foreach (explode(',', $_POST['genres']) as $genre) { ?>
                            <article class="pill"><?php echo $genre; ?></article>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div>
                <button type="submit" name="addBand">CREATE</button>
                <h4>or</h4>
                <a href="index.php">Go Back</a>
            </div>
        </form>

        <?php if ($success) { ?>
            <div class="notification-container">
                <div class="notification notification-success">
                    <p>Band Added!</p>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="js/addGenre.js"></script>
    <script src="js/removeGenre.js"></script>
    <script src="js/updateGenre.js"></script>
</body>

</html>