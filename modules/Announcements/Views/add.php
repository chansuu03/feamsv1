<?= $this->extend('Modules\Views\template');?>

<?= $this->section('styles');?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.css">
<?= $this->endSection();?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Announcements</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('announcements');?>">Announcements</a></li>
    <li class="breadcrumb-item active">Add announcement</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>
<?php helper('form'); ?>
<?= form_open_multipart('announcements/add'); ?>
  <!-- SELECT2 EXAMPLE -->
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title" style="margin-top: 2px;">Announcement Details</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <!-- Announcement Title -->
      <div class="form-group">
        <label>Announcement Title:</label>
        <input type="text" class="form-control <?php if(!empty($errors['title'])) echo 'is-invalid';?>" placeholder="Enter ..." name="title">
        <?php if(!empty($errors['title'])): ?>
        <div class="invalid-feedback">
          <?= $errors['title']?>
        </div>
        <?php endif; ?>
      </div>
      <!-- Announcement Description -->
      <div class="form-group">
        <label>Announcement Description:</label>
        <textarea class="form-control <?php if(!empty($errors['description'])) echo 'is-invalid';?>" rows="3" placeholder="Enter ..." name="description"></textarea>
        <?php if(!empty($errors['description'])): ?>
        <div class="invalid-feedback">
          <?= $errors['description']?>
        </div>
        <?php endif; ?>
      </div>
      <!-- Start and End date -->
      <div class="form-group">
        <label>Start and end date:</label>

        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <input type="text" class="form-control float-right <?php if(!empty($errors['start_date'])) echo 'is-invalid';?>" id="startEnd_date">
          <?php if(!empty($errors['start_date'])): ?>
          <div class="invalid-feedback">
            <?= $errors['start_date'] . ' and/or ' . $errors['end_date'] ?>
          </div>
          <?php endif; ?>
        </div>
        <!-- /.input group -->
      </div>
      <!-- Image upload -->
      <div class="form-group">
        <label for="exampleInputFile">Announcement Image:</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input <?php if(!empty($errors['image'])) echo 'is-invalid';?>" id="annImage" name="image">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>
        </div>
        <?php if(!empty($errors['image'])): ?>
          <small id="emailHelp" class="form-text text-danger"><?= $errors['image']?></small>
        <?php endif; ?>
      </div>
    </div>

    <!-- store different input from date range -->
    <input type="hidden" id="startDate" name="start_date">
    <input type="hidden" id="endDate" name="end_date">

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
      var name = document.getElementById("annImage").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = name
    })
  </script>

  <script>
  var startDate;
  var endDate;
  //date range picker function
  $(function() {
    $('#startEnd_date').daterangepicker({ //startEnd_date is ID nung sa input type
      drops: 'up', //papalitan kung saan lalabas
      autoUpdateInput: true, //kung maguupdate ba agad (di nagana lmao)
      locale: {
        format: 'YYYY-MM-DD' //sql format ng date.
      },
    }, function(start, end, label)
    {
      startDate = start.format('YYYY-MM-DD'); //store sa variable with the format
      endDate = end.format('YYYY-MM-DD'); //store sa variable with the format

      // lalagay na sa hidden input types
      document.getElementById("startDate").value = startDate;
      document.getElementById("endDate").value = endDate;
    });
  });

  </script>
<?= $this->endSection();?>
