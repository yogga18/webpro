<?php
     require "config.php";
     session_start();

     // Memeriksa user logout atau belum login
     if(!isset($_SESSION["login"]) || isset($_GET["logout"])) {
         session_destroy();
         echo"
         <script>
             document.location.href = 'Login-page.php';
         </script>";
     }

     $user_id = $_SESSION["login"];
     $user = findOne("SELECT * FROM user WHERE id = '$user_id'");
     $posts = findAll("SELECT * FROM post WHERE user_id='$user_id' ORDER BY created_at DESC");

     if(isset($_POST["update"])) {
      $user_id = $_POST["id"];
      $username = $_POST["username"];
      $email = $_POST["email"];
      $avatar = $_POST["old_avatar"];
      $file = $_FILES["new_avatar"];
 
      // Memeriksa adanya file yang diupoload, (file baru, file lama)
      if($file["name"] != null) {
          $avatar = uploadAvatar($file, $avatar);
      }
      
      $update_user = commit("UPDATE user SET username = '$username', email = '$email', avatar = '$avatar' WHERE id = '$user_id'");
      if($update_user > 0) {
          echo"
          <script>
              alert('Profile berhasil diubah');
              document.location.href = 'profile.php';
          </script>";
      }
      else {
          echo"
          <script>
              alert('Profile gagal diubah');
              document.location.href = 'profile.php';
          </script>";
      }

     }

     // Memeriksa method get yang dikirim ke halaman ini
     if(isset($_GET["delete"])) {
         $post_id = $_GET["delete"];

         $delete_post = commit("DELETE FROM post WHERE id='$post_id'");
         if($delete_post < 0) {
             echo"
             <script>
                 alert('Post gagal dihapus');
                 document.location.href = 'profile.php';
             </script>";
         }
         echo"
         <script>
              alert('Post berhasil dihapus');
              document.location.href = 'profile.php';
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
   <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
   <!-- CSS Files -->
   <link href="../assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
   <!-- CSS Just for demo purpose, don't include it in your project -->
   <link href="../assets/demo/demo.css" rel="stylesheet" />

   <!-- main css -->
   <link href="../scss/main.css" rel="stylesheet" />
 </head>
 
 <body class="index-page">

   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
     <div class="container">
       <div class="navbar-translate">
        <a class="navbar-brand" href="../main.php" title="Designed and Coded by Creative Tim">
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
               <a>
               Home
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
               <a href="../main.php" class="dropdown-item">
                 <i class="tim-icons icon-bank"></i>Home
               </a>
               <a href="./edit.php" class="dropdown-item">
                 <i class="tim-icons icon-single-02"></i>Edit
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
   
   <!-- Back Ground -->
   <div class="wrapper">
   <!-- page-header -->
     <div class="header-filter">
       <div class="squares square1"></div>
       <div class="squares square2"></div>
       <div class="squares square3"></div>
       <div class="squares square4"></div>
       <div class="squares square5"></div>
       <div class="squares square6"></div>
       <div class="squares square7"></div>
       <!-- <div class="container">
        <div class="content-center brand">
         </div>
       </div> -->
     </div>


          <div class="col-12 mb-5 wrapper-form">
            <div class="card card-coin card-plain">

              <div class="card-header">
                <?php if($user["avatar"] != null) : ?>
                <img src="../avatar/<?= $user["avatar"]; ?>" class="img-center img-fluid rounded-circle">
                <?php else : ?>
                <img src="../assets/img/default.jpg" class="img-center img-fluid rounded-circle">
                <?php endif; ?>
              </div>

              <h4 class="title text-center"><?= $user["username"]; ?></h4>

              <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-primary justify-content-center">
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#linkb">
                    <h4>Edit</h4>
                    </a>
                  </li>
                </ul>

                <div class="tab-content tab-subcategories">
                  <div class="tab-pane" id="linkb">

                  <form role="form" method="post" enctype="multipart/form-data">
                    <input value="<?= $user["id"]; ?>" type="hidden" name="id">
                    <input value="" type="hidden" name="old_avatar">
                    <div class="form-group mb-3">
                      <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>
                        <input class="form-control" value="<?= $user["username"]; ?>" type="text" name="username">
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                          </div>
                          <input class="form-control" value="<?= $user["email"]; ?>" type="email" name="email">
                      </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="new_avatar">
                        <label class="custom-file-label" for="customFile">Pilih gambar</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-5" name="update">Simpan</button>
                    </div>
                  </form>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>


    <div class="container my-5 mb-5">
      <div class="mx-auto text-center">
        <h2 class="font-weight-bold mb-5">Ceritaku</h2>
      </div>
        <?php foreach($posts as $post) : ?>
          <div class="row py-3 align-items-center mx-auto text-center status-wrapper">
            <div class="col-sm-3 text-center">

              <?php if($user["avatar"] != null) : ?>
                  <img src="../avatar/<?= $user["avatar"]; ?>" alt="Rounded image" class="rounded shadow" width="100" height="100">
              <?php else : ?>
                  <img src="../assets/img/default.jpg" class="img-center img-fluid rounded-circle" width="100" height="100">
              <?php endif; ?>
              
            </div>
              <div class="col-sm-9 p-5">
                <p class="font-weight-bold">
                  <?= $user["username"]; ?>
                    <small class="text-muted"><?= $post["created_at"]; ?></small>
                    <span><a class="btn btn-danger btn-sm" href="?delete=<?= $post['id']; ?>">Hapus</a></span>
                </p>
                <p><?= $post["content"]; ?></p>
              </div>
          </div>
        <?php endforeach; ?>
    </div>



     <footer class="footer my-5">
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
   <!-- Back Ground End-->
   
   






   
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
 