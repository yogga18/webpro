<?php
 	require "config.php";
 	session_start();

 	// Memeriksa user logout atau belum login
 	if(!isset($_SESSION["login"]) || isset($_GET["logout"]) || !isset($_SESSION["admin"])) {
 		session_destroy();
 		echo"
 		<script>
 			document.location.href = 'Login-page.php';
 		</script>";
 	}
   $akun = findAll("SELECT * FROM user ORDER BY id DESC");

 	// Relasi antara tabel user dan post
 
 	


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
   <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
   <!-- CSS Files -->
   <link href="../assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
   <!-- CSS Just for demo purpose, don't include it in your project -->
   <link href="../assets/demo/demo.css" rel="stylesheet" />

   <!-- main css -->
   <link href="/css/main.css" rel="stylesheet" />
 </head>
 
 <body class="index-page">

   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
     <div class="container">
       <div class="navbar-translate">
          <a class="navbar-brand" href="admin.php" title="Designed and Coded by Creative Tim">
            <span>Admin Pages</span>
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
               <a>
                 Admin Pages
               </a>
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
               <a href="?logout" class="dropdown-item">
                  <i class="tim-icons icon-user-run"></i> Logout
               </a>
             </div>
           </li>

           <li class="nav-item">
             <a class="nav-link btn btn-default d-none d-lg-block" href="?logout">
               <i class="tim-icons icon-user-run"></i> Logout
             </a>
           </li>

         </ul>
       </div>
     </div>
   </nav>
   <!-- End Navbar -->
<br>
<br>
<br>
<br>

<br>
   <!-- tabel user -->
 
  <div class="container-fluid">
    <div class="TabelPeice">
      <div class="row">
        <div class="col-sm-12 col-md-12">

          <table class="table table-striped table-dark table-bordered animated fadeInUp" style="animation-delay: 0.3s">
            <thead>          <!-- INI FIELD -->
              <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Avatar</th>
              </tr>
            </thead>
                                                  <!-- PEMANGGILAN DATA DARI DATABASE HARGA -->
            <tbody> 
            <?php foreach($akun as $user) : ?>
        <tr>
            <td><?php echo $user["id"];?></td>
            <td><?php echo $user["username"];?></td>
            
            <td>
            <?php if($user["avatar"] != null) : ?>
              <img src="../avatar/<?= $user["avatar"]; ?>" alt="Rounded image" class="img-fluid rounded shadow"
 					width="120">
 		      	<?php else : ?>
              <img src="../assets/img/default.jpg" alt="Rounded image" class="img-fluid rounded shadow"
 					width="120">          
            <?php endif; ?>
             </td>
        </tr>
        <?php endforeach;?>       
            </tbody>
          </table>
        
        </div>
      </div>
    </div>
  </div>


 




   <!-- End Tabel User -->

   <!-- tes -->
  

   <!-- end test -->
 



   
   <!--   Core JS Files   -->
   <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
   <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
   <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
   <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
   <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
   <script src="../assets/js/plugins/bootstrap-switch.js"></script>
   <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
   <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
   <!-- Chart JS -->
   <script src="../assets/js/plugins/chartjs.min.js"></script>
   <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
   <script src="../assets/js/plugins/moment.min.js"></script>
   <script src="../assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
   <!-- Black Dashboard DEMO methods, don't include it in your project! -->
   <script src="../assets/demo/demo.js"></script>
   <!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
   <script src="../assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
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
 