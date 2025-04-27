<header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.php">
            <span>
              UXOS
            </span>
            
          </a>
          <?php session_start();
          include_once "functions/login.php";
          if (isset($_SESSION['user_id'])): ?>
            <div style="text-align: center; margin-top: 20px;">
                <span style="color: black; font-size: 14px;">
                    You are logged in as <strong><?php echo htmlspecialchars($_SESSION['login']); ?></strong> 
                    (<?php echo htmlspecialchars($_SESSION['rola']); ?>)
                </span>
                <form action="functions/logout.php" method="POST" style="margin-top: 5px;">
                    <button type="submit" class="btn btn-danger" style="font-size: 13px;">Log out</button>
                </form>
            </div>
        <?php else: ?>
            <div style="text-align: center; margin-top: 20px;">
                <span style="color: black; font-size: 14px;">
                    You are not logged in. Please <a href="http://127.0.0.1/edsa-project/loginpage.php" style="color: blue;">log in</a> or <a href="http://127.0.0.1/edsa-project/loginpage.php" style="color: blue;">register</a>.
                </span>
            </div>
        <?php endif; ?>
          <div class="navbar-collapse" id="">
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <a href="index.php">HOMEPAGE</a>
                <a href="about.php">ABOUT</a>
                <a href="feature.php">FEATURE</a>
                <a href="contact.php">CONTACT US</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>