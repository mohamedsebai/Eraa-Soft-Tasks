<header role="banner">
  <div class="top-bar">
    <div class="container">
      <div class="row">
      </div>
    </div>
  </div>

  <div class="container logo-wrap">
    <div class="row pt-5">
      <div class="col-12 text-center">
        <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
        <h1 class="site-logo"><a href="index.php">EraaSoft Small Shop</a></h1>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-md  navbar-light bg-light">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav mx-auto">
        <?php if(isset($_SESSION['role_user_user_id'])): ?>
          <li class="nav-item">
          <a class="nav-link " href="profile.php">Profile</a>
          </li>

          <li class="nav-item">
          <a class="nav-link " href="cart.php">Your_Cart</a>
          </li>
          <li class="nav-item">
          <a class="nav-link " href="orders.php">Your_Orders</a>
          </li>

          <li class="nav-item">
          <a class="nav-link " href="logout.php">Logout</a>
          </li>
          <?php else: ?>
          <a class="nav-link active " href="login.php">login</a>
          <a class="nav-link " href="register.php">register</a>
          <?php endif; ?>

          <li class="nav-item">
          <a class="nav-link " href="index.php">Products</a>
          </li>
          <li class="nav-item">
          <a class="nav-link active " href="index.php">Home</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</header>
