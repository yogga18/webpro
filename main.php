<?php
 	require "./pages/config.php";
   session_start();
 	date_default_timezone_set("Asia/Jakarta");

 	// Memeriksa user logout atau belum login
 	if(!isset($_SESSION["login"]) || isset($_GET["logout"])) {
 		session_destroy();
 		echo"
 		<script>
 			document.location.href = 'pages/Login-page.php';
 		</script>";
 	}

 	$user_id = $_SESSION["login"];
 	$user = findOne("SELECT * FROM user WHERE id = '$user_id'");

 	// Relasi antara tabel user dan post
 	$posts = findAll("SELECT u.*, p.* FROM post p INNER JOIN user u WHERE p.user_id=u.id ORDER BY created_at DESC");
 	
 	// Memeriksa method post yang dikirim ke halaman ini
 	if(isset($_POST["post"])) {
 		$content = $_POST["content"];
 		$created_at = date("Y-m-d H:i:s");

 		$create_post = commit("INSERT INTO post SET user_id='$user_id', content='$content', created_at='$created_at'");
 		if($create_post < 0) {
 			echo"
 			<script>
 				alert('Post gagal dikirim');
 				document.location.href = 'main.php';
 			</script>";
 		}
 		echo"
 		<script>
 			document.location.href = 'main.php';
 		</script>";
 	}
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Blk• Design System by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="index-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="main.php" title="Designed and Coded by Creative Tim">
          <span>Home</span>
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="main.php">Home</a>
            </div>
            <div class="col-6 collapse-close text-right">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>

        <ul class="navbar-nav">
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> Menu
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="./pages/profile.php" class="dropdown-item">
                <i class="tim-icons icon-paper"></i> Profile
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-default d-none d-lg-block" href="?logout" onclick="scrollToDownload()">
              <i class="tim-icons icon-user-run"></i> Logout
            </a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
		<div class="section section-hero section-shaped">
			<div class="shape shape-style-1 shape-primary">
				<span class="span-150"></span>
				<span class="span-50"></span>
				<span class="span-50"></span>
				<span class="span-75"></span>
				<span class="span-50"></span>
				<span class="span-100"></span>
				<span class="span-50"></span>
				<span class="span-100"></span>
			</div>
			<div class="page-header">
				<div class="container shape-container d-flex align-items-center py-lg">
					<div class="col px-0">
						<div class="row align-items-center justify-content-center">
							<div class="col-lg-7 text-center">
								<h2 class="font-weight-bold text-white">Hai, 	<?= $user["username"]; ?></h2>
								<p class="lead text-white">Berkicaulah!</p>
								<div class="btn-wrapper mt-3">
									<form method="post">
										<textarea class="form-control" rows="5" placeholder="Hmmm..." name="content" required></textarea>
										<button type="submit" class="btn btn-primary mt-3" name="post">Bagikan</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section section-typography">
			<div class="container">
				<div class="mx-auto text-center">
					<h2 class="font-weight-bold mb-5">Timeline</h2>
				</div>
				<?php foreach($posts as $post) : ?>
				<div class="row py-3 align-items-center">
					<div class="col-sm-3 text-center">
					<?php if($post["avatar"] != null) : ?>
 				<img src="avatar/<?= $post["avatar"]; ?>" alt="Rounded image" class="img-fluid rounded shadow"
 					width="120">
 			<?php else : ?>
 				<img src="assets/img/default.jpg" alt="Rounded image" class="img-fluid rounded shadow"
 					width="120">
 			<?php endif; ?>
					</div>
					<div class="col-sm-9">
					<p class="font-weight-bold">
 				<?= $post["username"]; ?>
 				<small class="text-muted"><?= $post["created_at"]; ?></small>
 			</p>
 			<p><?= $post["content"]; ?></p>
					</div>
				</div>
				<?php endforeach;?>
				
			</div>
		</div>
	</div>












<!--Footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <h1 class="title">BLK•</h1>
          </div>
          <div class="col-md-3">
            <ul class="nav">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a href="./examples/landing-page.html" class="nav-link">
                  Landing
                </a>
              </li>
              <li class="nav-item">
                <a href="./examples/register-page.html" class="nav-link">
                  Register
                </a>
              </li>
              <li class="nav-item">
                <a href="./examples/profile-page.html" class="nav-link">
                  Profile
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <ul class="nav">
              <li class="nav-item">
                <a href="https://creative-tim.com/contact-us" class="nav-link">
                  Contact Us
                </a>
              </li>
              <li class="nav-item">
                <a href="https://creative-tim.com/about-us" class="nav-link">
                  About Us
                </a>
              </li>
              <li class="nav-item">
                <a href="https://creative-tim.com/blog" class="nav-link">
                  Blog
                </a>
              </li>
              <li class="nav-item">
                <a href="https://opensource.org/licenses/MIT" class="nav-link">
                  License
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="title">Follow us:</h3>
            <div class="btn-wrapper profile">
              <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-twitter"></i>
              </a>
              <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Like us">
                <i class="fab fa-facebook-square"></i>
              </a>
              <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-icon btn-neutral  btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-dribbble"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="./assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="./assets/js/plugins/moment.min.js"></script>
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
  <!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      blackKit.initDatePicker();
      blackKit.initSliders();
    });

    function scrollToDownload() {

      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
  </script>
</body>

</html>
