<?= $this->extend('temp') ?>

<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= base_url();?>/css/register.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <?= form_open_multipart('register/verify')?>
                    <div class="card-header">
                        <h3>Registration</h3>
                    </div>
                    <div class="card-body">
                        <h5>Personal Info</h5>
                        <hr><!-- name -->
                        <div class="form-row">
                            <!-- first name -->
                            <div class="col form-group">
                                <label>First name </label>   
                                <input type="text" class="form-control" placeholder="" name="first_name">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <!-- middle name -->
                            <div class="col form-group">
                                <label>Middle name </label>   
                                <input type="text" class="form-control" placeholder="" name="middle_name">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <!-- last name -->
                            <div class="col form-group">
                                <label>Last name </label>   
                                <input type="text" class="form-control" placeholder="" name="last_name">
                            </div>
                        </div> 
                        <h5>Account Info</h5>
                        <hr>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-row">
                            <!-- Username -->
                            <div class="col form-group">
                                <label>Username </label>   
                                <input type="text" class="form-control" placeholder="" name="username">
                            </div>
                            <!-- Password -->
                            <div class="col form-group">
                                <label>Password</label>   
                                <input type="password" class="form-control" placeholder="" name="password">
                            </div>
                        </div> 
                    </div>
                    <div class="card-footer d-flex flex-row-reverse">
                        <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                <?= form_close();?>
            </div>        
        </div>
    </div>        
</div>
<?= $this->endSection() ?>