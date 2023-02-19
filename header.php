<!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">Online Quiz</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a id='index' href="index.php">Home</a></li>
          <?php 
            if(!(isset($_SESSION['uid'])))
            {
          ?>
            <li><a id='login' href="login.php">Login</a></li>
            <li><a id='register' href="register.php">Register</a></li>
          <?php
          }
          else
          {
          ?>
            <li><a id='viewResults' href="viewResults.php">View Results</a></li>
            <li><a id='logout' href="logout.php">Logout</a></li>
          <?php
          }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="index.php#availableQuizes" class="get-started-btn">Start Quiz</a>

    </div>
</header><!-- End Header -->