<?= $this->extend('Modules\Views\template');?>

<?= $this->section('styles');?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.css">
<?= $this->endSection();?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Sliders</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('sliders');?>">Sliders</a></li>
    <li class="breadcrumb-item active">Add Slider</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>
<?php helper('form'); ?>
<?= form_open_multipart('sliders/add'); ?>
  <!-- SELECT2 EXAMPLE -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title" style="margin-top: 2px;">Slider Details</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <!-- Slider Title -->
      <div class="form-group">
        <label>Slider Title:</label>
        <input type="text" class="form-control <?php if(!empty($errors['title'])) echo 'is-invalid';?>" placeholder="Enter ..." name="title">
        <?php if(!empty($errors['title'])): ?>
        <div class="invalid-feedback">
          <?= $errors['title']?>
        </div>
        <?php endif; ?>
      </div>
      <!-- Slider Description -->
      <div class="form-group">
        <label>Slider Description:</label>
        <textarea class="form-control <?php if(!empty($errors['description'])) echo 'is-invalid';?>" rows="3" placeholder="Enter ..." name="description"></textarea>
        <?php if(!empty($errors['description'])): ?>
        <div class="invalid-feedback">
          <?= $errors['description']?>
        </div>
        <?php endif; ?>
      </div>
      <!-- Image upload -->
      <div class="form-group">
        <label for="exampleInputFile">Slider Image:</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input <?php if(!empty($errors['image'])) echo 'is-invalid';?>" id="image" name="image">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>
        </div>
        <?php if(!empty($errors['image'])): ?>
          <small id="emailHelp" class="form-text text-danger"><?= $errors['image']?></small>
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
      var name = document.getElementById("image").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = name
    })
  </script>
<?= $this->endSection();?>
