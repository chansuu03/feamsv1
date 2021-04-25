<?= $this->extend('temp') ?>

<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= base_url();?>/css/login.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="<?= base_url();?>/login" method="post">
                        <img src= "img/fealogo.png" alt="logo" style="height: 65px; margin-bottom: 50px; margin-left: 78px;">
                        <h6 class="text-center" style="padding-bottom: 20px; color: black; opacity: 0.5;">Welcome to FEA Management System</h6>
                            <?php if(session()->getFlashdata('msg')):?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('msg') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <?php endif;?>
                            <div class="form-group">
                                <!-- <i class="fas fa-user" style="color: #616161;"></i>  --><label style="color: #616161;"></label><br>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <!-- <i class="fas fa-lock" style="color: #616161;"></i>  --><label style="color: #616161;"></label><br>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                            </div>

                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                            <div class="form-group" style="padding-top: 50px; font-size: 12px;">
                                <a href="#" class="text-info">Forgot Password?</a>
                                <!-- <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                            </div>
                            <div id="register-link" class="text-right" style="padding-top: 47px; font-size: 12px;">
                                <!-- <label for="remember-me" class="text-info remember-me"><span>Remember me</span>  <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                                <input class="checkbox" type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                                
                            </div>
                    </form>
                    <div id="register-link" class="text-center" style="padding-top: 35px; font-size: 12px;">
                        <label>Don't have an account?</label> <a href="<?= base_url('register');?>" class="text-info">Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>