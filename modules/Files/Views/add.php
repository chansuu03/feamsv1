<?= $this->extend('Modules\Views\template');?>

<?= $this->section('styles');?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.css">
<?= $this->endSection();?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Files</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Files</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>
<?php helper('form'); ?>

<?php if($logged_in['role'] == 1): ?>
  <?= form_open_multipart('files/add'); ?>
<?php elseif($logged_in['role'] != 1): ?>
  <?= form_open_multipart($logged_in['username'].'/files/add'); ?>
<?php endif;?>
  <!-- SELECT2 EXAMPLE -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title" style="margin-top: 2px;">File Details</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <!-- Announcement Title -->
      <div class="form-group">
        <label>File title</label>
        <input type="text" class="form-control <?php if(!empty($errors['title'])) echo 'is-invalid';?>" placeholder="Enter ..." name="title">
        <?php if(!empty($errors['title'])): ?>
        <div class="invalid-feedback">
          <?= $errors['title']?>
        </div>
        <?php endif; ?>
      </div>

      <!-- Image upload -->
      <div class="form-group">
        <label for="exampleInputFile">File to be uploaded:</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input <?php if(!empty($errors['assocFile'])) echo 'is-invalid';?>" id="assocFile" name="assocFile">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>
        </div>
        <?php if(!empty($errors['assocFile'])): ?>
          <small id="assocFileError" class="form-text text-danger"><?= $errors['assocFile']?></small>
        <?php endif; ?>
      </div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary float-right">Submit</button>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
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
      var name = document.getElementById("assocFile").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = name
    })
  </script>
<?= $this->endSection();?>
