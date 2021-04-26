<?= $this->extend('Modules\Views\template');?>

<?= $this->section('styles');?>

<?= $this->endSection();?>

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
               src="<?= base_url();?>/uploads/profile_pictures/<?= $user['profile_pic']?>"
               alt="User profile picture">
        </div>

        <h3 class="profile-username text-center"><?= $user['first_name']?> <?= $user['last_name']?></h3>
        <p class="text-muted text-center"><?= $user['employee_id']?></p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Employee ID</b> <a class="float-right"><?= $user['employee_id']?></a>
          </li>
          <li class="list-group-item">
            <b>Contact</b> <a class="float-right"><?= $user['contact_number']?></a>
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
          <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Details</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="settings">
            <form class="form-horizontal">
              <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="inputName" value="<?php
                    if($user['gender'] == 1)
                      echo "Male";
                    else
                      echo "Female";
                  ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" readonly class="form-control-plaintext" id="inputEmail" placeholder="Email" value="<?= $user['email']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Birthdate</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="inputEmail" placeholder="Email" value="<?php
                    $date = date_create($user['birthdate']);
                    echo date_format($date, 'F d, Y');
                  ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="inputEmail" placeholder="Email" value="<?= $user['address']?>">
                </div>
              </div>
              <!-- <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Edit Profile</button>
                </div>
              </div> -->
            </form>
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
