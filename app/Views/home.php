<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url();?>/dist/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url();?>/css/home.css">

    <title>Faculty and Employees Association</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-custom">
      <a class="navbar-brand" href="#">FEA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php if($isLoggedIn == TRUE): ?>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?= base_url();?>/dashboard">Dashboard</a>
          </li> -->
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>/users">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>/announcements">Announcements</a>
            </li>
          <?php endif ?>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <?php if($isLoggedIn != TRUE): ?>
          <span class="navbar-text" style="margin-right: 5px;">
            Already have an account?
          </span>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>/login">Login</a>
            </li>
          </ul>
        <?php else: ?>
          <span class="navbar-text" style="margin-right: 5px;">
            Welcome back! <?= $username?>
          </span>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>/logout">logout</a>
            </li>
          </ul>
        <?php endif ?>
        </div>
      </div>
    </nav>
    <!-- end navbars -->

<div class="container-fluid">

</div>
    <div id="carousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?=base_url();?>\img\first.svg" alt="Los Angeles" width="100%" height="400">
          <div class="carousel-caption">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
        <?php foreach($sliders as $slider):?>
        <div class="carousel-item">
          <img src="<?=base_url();?>\uploads\sliders\<?= $slider['image_file']?>" alt="<?= $slider['title']?>" width="100%" height="400">
          <div class="carousel-caption">
            <h3><?= $slider['title']?></h3>
            <p><?= $slider['description']?></p>
          </div>
        </div>
        <?php endforeach;?>
        <!-- <div class="carousel-item">
          <img src="<?=base_url();?>\img\second.svg" alt="Los Angeles" width="100%" height="400">
          <div class="carousel-caption">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?=base_url();?>\img\third.svg" alt="Los Angeles" width="100%" height="400">
          <div class="carousel-caption">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div> -->
      </div>
      <a class="carousel-control-prev" href="#carousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#carousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
    <!-- end carousels -->

    <div class="container-fluid" style="margin-top: 15px;">
      <div class="row">
        <div class="col announces">
          <h3 id="announceHead">Announcements</h3>
          <hr style="border-top: 5px solid white;">
          <?php if (!empty($announcements)): ?>
            <?php foreach ($announcements as $announce): ?>
              <?php if ($announce['deleted_at'] == NULL): ?>
              <!-- annoucement 1 -->
              <div class="card flex-row" style="margin-bottom: 5px;">
                   <div class="card-header border-0">
                       <img src="<?= base_url();?>/uploads/announcements/<?= $announce['image'];?>" alt="" style="width: 300px; height: 200px;">
                   </div>
                   <div class="card-block px-2">
                     <h5 style="margin-top: 3px;"><?= $announce['title'];?></h5>
                     <p>Posted in: <?= $announce['date_posted'];?></p>
                     <p><?= $announce['description'];?></p>
                   </div>
               </div>
             <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <!-- annoucement 1 -->
          <!-- <div class="card flex-row" style="margin-bottom: 5px;">
               <div class="card-header border-0">
                   <img src="<?= base_url();?>/img/300x200.gif" alt="" style="width: 300px; height: 200px;">
               </div>
               <div class="card-block px-2">
                 <h5 style="margin-top: 3px;">Title</h5>
                 <p>Posted in: date</p>
                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               </div>
           </div> -->
        </div>
        <div class="col-4">
          <!-- embed video here -->
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url();?>/dist/bootstrap/4.1.3/js/jquery-3.6.0.js"></script>
    <script src="<?= base_url();?>/dist/bootstrap/4.1.3/js/popper.min.js"></script>
    <script src="<?= base_url();?>/dist/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>
