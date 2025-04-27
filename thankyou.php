<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ďakujeme!</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="hero_area">
        <!-- Header -->
        <?php include_once "assets/parts/header.php"; ?>
        <!-- End Header -->
    </div>

    <section class="thankyou_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>Ďakujeme za odoslanie formulára!</h2>
                <p>Vaša správa bola úspešne odoslaná. Budeme vás kontaktovať čo najskôr.</p>
                <a href="index.php" class="btn btn-primary">Späť na hlavnú stránku</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include_once "assets/parts/footer.php"; ?>
    <!-- End Footer -->

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>