<?= $this->extend('Modules\Views\template');?>

<?= $this->section('styles');?>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.css">

<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>

<?= $this->endSection();?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Users</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('users/active');?>">Users</a></li>
    <li class="breadcrumb-item active">Add User</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php if(session()->getFlashdata('msg')):?>
  <div class="alert alert-<?php if(session()->getFlashdata('err')) echo 'danger'; else echo 'success';?> alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('msg') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif;?>

<?php helper('form'); ?>
<?= form_open_multipart('users/add'); ?>

<!-- Personal Information -->
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Personal Information</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- name -->
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="first_name" class="required">First Name</label>
        <input type="text" class="form-control <?php if(isset($firstname_error)) echo 'is-invalid';?>" id="first_name" placeholder="Juan" name="first_name">
        <?php if(isset($firstname_error)):?>
        <span id="firstname_error" class="error invalid-feedback"><?= $firstname_error ?></span>
        <?php endif;?>
      </div>
      <div class="form-group col-md-4">
        <label for="middle_name" class="required">Middle Name</label>
        <input type="text" class="form-control <?php if(isset($middlename_error)) echo 'is-invalid';?>" id="middle_name" placeholder="Maestro" name="middle_name">
        <?php if(isset($middlename_error)):?>
        <span id="middlename_error" class="error invalid-feedback"><?= $middlename_error ?></span>
        <?php endif;?>
      </div>
      <div class="form-group col-md-4">
        <label for="last_name" class="required">Last Name</label>
        <input type="text" class="form-control <?php if(isset($lastname_error)) echo 'is-invalid';?>" id="last_name" placeholder="Dela Cruz" name="last_name">
        <?php if(isset($lastname_error)):?>
        <span id="lastname_error" class="error invalid-feedback"><?= $lastname_error ?></span>
        <?php endif;?>
      </div>
    </div>
    <!-- 2nd row -->
    <div class="form-row">
      <!-- birthdate -->
      <div class="form-group col-md-6">
        <div class="form-group">
          <label for="birthdate" class="required">Birthdate</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control <?php if(isset($birthdate_error)) echo 'is-invalid';?>" id="birthdate" name="birthdate">
          </div>
          <?php if(isset($birthdate_error)):?>
          <span id="birthdate_error" class="error invalid-feedback"><?= $birthdate_error ?></span>
          <?php endif;?>
        </div>
      </div>
      <!-- Gender -->
      <div class="form-group col-md-5">
        <div class="form-group">
          <label for="gender" class="required">Gender</label>
          <div class="row">
            <div class="col" style="margin-top: 6px;">
              <div class="icheck-primary d-inline">
                <input type="radio" id="male" name="gender" value="1" required>
                <label for="male">Male</label>
              </div>
            </div>
            <div class="col" style="margin-top: 6px;">
              <div class="icheck-primary d-inline">
                <input type="radio" id="female" name="gender" value="2" required>
                <label for="female">Female</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Address -->
    <div class="form-group">
      <label for="address" class="required">Address</label>
      <textarea class="form-control <?php if(isset($address_error)) echo 'is-invalid';?>" id="address" rows="3" name="address"></textarea>
      <?php if(isset($address_error)):?>
      <span id="address_error" class="error invalid-feedback"><?= $address_error ?></span>
      <?php endif;?>
    </div>
    <!-- E-mail -->
    <div class="form-group">
      <label for="exampleFormControlInput1" class="required">Email address</label>
      <input type="email" class="form-control <?php if(isset($email_error)) echo 'is-invalid';?>" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
      <?php if(isset($email_error)):?>
      <span id="email_error" class="error invalid-feedback"><?= $email_error ?></span>
      <?php endif;?>
    </div>
    <!-- Contact number -->
    <div class="form-group">
      <label for="contact_number" class="required">Contact number</label>
      <input type="text" class="form-control <?php if(isset($contact_error)) echo 'is-invalid';?>" id="contact_number" placeholder="09********" name="contact_number">
      <?php if(isset($contact_error)):?>
      <span id="contact_error" class="error invalid-feedback"><?= $contact_error ?></span>
      <?php endif;?>
    </div>
  </div>
</div>
<!-- /.card -->

<!-- Employee Information -->
<div class="card card-default" id="empInfo">
  <div class="card-header">
    <h3 class="card-title">Employee Information</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="form-row">
      <!-- Employee ID -->
      <div class="form-group col-md-6">
        <label for="employee_id" class="required">Employee ID</label>
        <input type="text" class="form-control <?php if(isset($employee_id_error)) echo 'is-invalid';?>" id="employee_id" placeholder="2018-00523-TG-0" name="employee_id">
        <?php if(isset($employee_id_error)):?>
        <span id="employee_id_error" class="error invalid-feedback"><?= $employee_id_error ?></span>
        <?php endif;?>
      </div>
      <!-- Department -->
      <div class="form-group col-md-6">
        <label class="required">Department</label>
        <select class="custom-select <?php if(isset($dept_error)) echo 'is-invalid';?>" id="dept_id" name="dept_id">
          <?php foreach ($depts as $dept): ?>
            <option value="<?= $dept['dept_id'];?>"><?= $dept['dept_name'];?></option>
          <?php endforeach; ?>
        </select>
        <?php if(isset($dept_error)):?>
        <span id="dept_id-error" class="error invalid-feedback"><?= $dept_error ?></span>
        <?php endif;?>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Account Information -->
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Account Information</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="form-row">
      <div class="form-group col">
        <label class="required">Username</label>
        <input type="text" class="form-control <?php if(isset($username_error)) echo 'is-invalid';?>" name="username">
        <?php if(isset($username_error)):?>
        <span id="dept_id-error" class="error invalid-feedback"><?= $dept_error ?></span>
        <?php endif;?>
      </div>
      <div class="form-group col">
        <label class="required">Password</label>
        <input type="password" class="form-control <?php if(isset($password_error)) echo 'is-invalid';?>" name="password">
        <?php if(isset($password_error)):?>
        <span id="dept_id-error" class="error invalid-feedback"><?= $dept_error ?></span>
        <?php endif;?>
      </div>
    </div>
    <!-- Profile Picture -->
    <div class="form-group">
      <label for="profile_pic" class="required">Profile Picture</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input <?php if(!empty($errors['profile_pic']) ||isset($profilepic_error)) echo 'is-invalid';?>" id="profile_pic" name="profile_pic">
          <label class="custom-file-label" for="profile_pic">Choose file</label>
        </div>
      </div>
      <?php if(isset($profilepic_error)):?>
      <span id="dept_id-error" class="error invalid-feedback"><?= $dept_error ?></span>
      <?php endif;?>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-outline-secondary" onclick="formReset()">Clear</button>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
<?= form_close(); ?>
<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<!-- InputMask -->
<script src="<?= base_url();?>/dist/adminlte/plugins/moment/moment.min.js"></script>
<script src="<?= base_url();?>/dist/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.js"></script>

<!-- file uploads para mapalitan agad file name once makaselect na ng file -->
<script>
  document.querySelector('.custom-file-input').addEventListener('change', function (e)
  {
    var name = document.getElementById("profile_pic").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = name
  })
</script>

<script>
  $(function() {
    $('input[name="birthdate"]').daterangepicker({
      setStartDate: ('03/05/2005'),
      changeMonth: true,
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1951,
      maxYear: 2010,
      locale: {
        format: 'MMM DD,YYYY',
        cancelLabel: 'Clear'
      }
    });
  });
</script>

<script>
    $(document).ready(function(){
        $('.required').tooltip({
          placement : 'top',
          title: 'This is a required field.'
        });   
    });
</script>
<?= $this->endSection();?>
