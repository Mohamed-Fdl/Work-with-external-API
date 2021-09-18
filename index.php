<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Check city weather</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/bootstrap.js"></script>
    <!-- <script src="js/jquery.js"></script> -->
    <script src="js/bootstrap.bundle.js"></script>
</head>

<body class="container">
    <div class="row">
        <div class="col-md-12"><br>
            <h1>City you want to know weather</h1><br>
            <form action="treat.php" method="post">
                <div class="form-group">
                    <label for="file"></label>
                    <input type="text" name='city' value="<?php if(isset($_SESSION['q'])) {echo $_SESSION['q'];}?>" class="form-control" required id="city" aria-describedby="emailHelp">
                    <!-- <small id="emailHelp" class="form-text text-muted">File extension: JPG</small> -->
                </div>
                <!-- <input type="hidden" name="key" value="df209baa34925bdde6455ae371faafcf"> -->
                <button type="submit" class="btn btn-primary">Check</button>
            </form>
            <br><br>
        </div>
    </div>
    <?php if (isset($_SESSION['data'])) { ?>
        <div class="row">
            <?php if (isset($_SESSION['data']['message'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['data']['message']; ?>
                </div>
            <?php } else { ?>
                <h2>Results</h2>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">City name</th>
                            <th scope="col">Country code</th>
                            <th scope="col">Position</th>
                            <th scope="col">Weather</th>
                            <th scope="col">Temp (in °F)</th>
                            <th scope="col">Wind speed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $_SESSION['data']['name'] ?></th>
                            <td><?= $_SESSION['data']['sys']['country'] ?></td>
                            <td>Lon: <?= $_SESSION['data']['coord']['lon'] ?> | Lat: <?= $_SESSION['data']['coord']['lat'] ?></td>
                            <td><?= $_SESSION['data']['weather'][0]['main'] ?> : <?= $_SESSION['data']['weather'][0]['description'] ?></td>
                            <td><?= number_format($_SESSION['data']['main']['temp'] , 2, ',', '.') ?></td>
                            <td><?= $_SESSION['data']['wind']['speed'] ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    <?php } ?>
</body>

</html>
