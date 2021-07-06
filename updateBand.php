<?php

include('./partials/partial.php');

if (isset($_POST['updateBand'])) {

    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $emptyFields[$field] = ucwords($field) . ' is empty.';
        }
    }

    if (!array_filter($emptyFields)) {
        $newBandCode = $_POST['bandCode'];

        foreach ($bands as $band) {
            if ($band->getAttribute('bandCode') == $newBandCode) {
                $newBand = $xml->createElement('band');
                $newBand->setAttribute('bandCode', $newBandCode);
                $newBand->appendChild($xml->createElement('bandName', $_POST['bandName']));
                $newBand->appendChild($xml->createElement('debut', $_POST['debut']));
                $newBand->appendChild($xml->createElement('hitSong', $_POST['hitSong']));

                $newBandGenres['xml'] = $xml->createElement('genres');
                $newBandGenres['values'] = explode(", ", $_POST['genres']);

                foreach ($newBandGenres['values'] as $genre) {
                    $newBandGenres['xml']->appendChild($xml->createElement('genre', $genre));
                }

                $newBand->appendChild($newBandGenres['xml']);
                $xml->getElementsByTagName('bands')->item(0)->replaceChild($newBand, $band);
                $xml->save('IconicOpmBands.xml');

                $success = true;
                unset($_POST);
            }
        }
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
    <link rel="stylesheet" href="css/form.css">
    <title>Update Band</title>
</head>

<body>
    <div class="main-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="container form-submit">
            <h1>Edit Band</h1>
            <div class="multi-input">
                <div>
                    <label>Band Code</label>
                    <select name="bandCode" class="bandCodeSelect <?php echo $emptyFields['bandCode'] ? 'input-danger' : ''; ?>">
                        <option value="" selected>Choose Band Code</option>
                    </select>
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
                <button type="submit" name="updateBand" class="btn-update">UPDATE</button>
                <h4>or</h4>
                <a href="index.php">Go Back</a>
            </div>
        </form>

        <?php if ($success) { ?>
            <div class="notification-container">
                <div class="notification notification-update">
                    <p>Band Updated!</p>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="js/updateGenre.js"></script>
    <script src="js/addGenre.js"></script>
    <script src="js/removeGenre.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/getBandData.js"></script>
</body>

</html>