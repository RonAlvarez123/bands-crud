<?php

include('./partials/partial.php');

if (isset($_POST['deleteBand'])) {

    if (empty($_POST['bandCode'])) {
        $emptyFields['bandCode'] = ucwords('bandCode') . ' is empty.';
    }

    if (!array_filter($emptyFields)) {

        foreach ($bands as $band) {
            if ($band->getAttribute('bandCode') == $_POST['bandCode']) {
                $xml->getElementsByTagName('bands')->item(0)->removeChild($band);
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
    <title>Delete Band</title>
</head>


<body>
    <div class="main-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="container form-submit">
            <h1>Delete Band</h1>
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
                    <input type="number" name="debut" value="<?php echo $_POST['debut'] ?? ''; ?>" disabled>
                    <p></p>
                </div>
            </div>
            <div>
                <label>Band Name</label>
                <input type="text" name="bandName" value="<?php echo $_POST['bandName'] ?? ''; ?>" disabled>
            </div>
            <div>
                <label>Hit Song</label>
                <input type="text" name="hitSong" value="<?php echo $_POST['hitSong'] ?? ''; ?>" disabled>
            </div>
            <div>
                <label>Genres</label>
                <input type="text" name="genres" value="<?php echo $_POST['genres'] ?? ''; ?>" hidden>
                <div class="genres"></div>
            </div>
            <div>
                <button type="submit" name="deleteBand" class="btn-delete">DELETE</button>
                <h4>or</h4>
                <a href="index.php">Go Back</a>
            </div>
        </form>

        <?php if ($success) { ?>
            <div class="notification-container">
                <div class="notification notification-delete">
                    <p>Band Removed!</p>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="js/functions.js"></script>
    <script src="js/getBandData.js"></script>
</body>

</html>