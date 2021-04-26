<?= $this->extend('Modules\Views\template');?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Profile</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item active">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
               src="<?= base_url();?>/uploads/profile_pictures/<?= $logged_in['profile_pic']?>"
               alt="User profile picture">
        </div>

        <h3 class="profile-username text-center"><?= $logged_in['first_name']?> <?= $logged_in['last_name']?></h3>
        <p class="text-muted text-center"><?= $logged_in['dept_name']?></p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Gender</b> <a class="float-right">
              <?php
                if($logged_in['gender'] == 1)
                  echo "Male";
                else
                  echo "Female";
              ?></a>
          </li>
          <li class="list-group-item">
            <b>Birthdate</b> <a class="float-right">
              <?php
                $date = date_create($logged_in['birthdate']);
                echo date_format($date, 'F d, Y');
              ?></a>
          </li>
          <li class="list-group-item">
            <b>Address</b> <a class="float-right"><?= $logged_in['address']?></a>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
        </ul>
      </div><!-- /.card-header -->
      <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('msg') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif;?>
      <?php helper('form'); ?>
      <?= form_open_multipart('profile/'.$logged_in['username'].'/update'); ?>
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="settings">
            <form class="form-horizontal">
              <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" name="first_name" placeholder="First Name" value="<?= $logged_in['first_name']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" name="last_name" placeholder="Last Name" value="<?= $logged_in['last_name']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?= $logged_in['email']?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn btn-primary sub">Edit Profile</button>
                </div>
              </div>
            <?= form_close(); ?>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection();?>

<?= $this->section('scripts')?>

<script type="text/javascript">

  $(document).ready(function ()
  {
    $('.sub').click(function (e)
    {
      e.preventDefault();
      // var id = $(this).val();
      var form = $(this).parents('form');
      Swal.fire({
        icon: 'question',
        text: 'You sure you want to update profile?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          // window.location = '/profile//update/';
          form.submit();
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>

<?= $this->endSection()?>
