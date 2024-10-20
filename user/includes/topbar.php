  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="contactus.php" class="nav-link">Enquiry</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle"  type="button" id="dropdownmenuebutton" data-toggle="dropdown" aria-expanded="false">
  <?php
    if(isset($_SESSION['auth']))
    {
   echo $_SESSION['auth_user']['user_name']; 
    }
    else{
   echo "not logged in";
    }

    ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownmenuebutton">
    <a class="dropdown-item" href="user_login.php">Log In</a>
    
    <form action="user_code.php" method="post">
<button type="submit" name="logout_btn" class="dropdown-item">Log Out</button>

    </form>
    
</div>
</li>

      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

     
           
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->