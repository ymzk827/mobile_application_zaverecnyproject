<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>UXOS</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <?php include_once "assets/parts/header.php" ?>
    <!-- end header section -->
  </div>


  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="d-flex ">
        <h2>
          Contact Us
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">

        <?php include_once "functions/login.php";
        use data\userManager;
        $UM = new userManager();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $UM->register($_POST['login'], $_POST['email'], $_POST['password'], $rola="user");
        }
        ?>

          <form action="", method="post">
            <div class="contact_form-container">
              <div>
                <form action="">
                <div>
                  <input type="text" name="login" id="login" placeholder="Login">
                </div>
                <div>
                  <input type="text" name="email" id="email" placeholder="E-Mail">
                </div>
                <div>
                  <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="mt-5">
                  <button type="submit">
                    Register
                  </button>
                </form>
                </div>
              </div>

            </div>

          </form>
        </div>
        <div class="col-md-6">
          <div class="contact_img-box">
            <img src="images/contact-img.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->
  <!-- info section -->
 
  <?php include_once "assets/parts/footer.php" ?>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  </script>
</body>

</html>