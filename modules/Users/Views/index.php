<?= $this->extend('Modules\Views\template');?>

<?= $this->section('styles');?>
    <style>
        button.link { 
            background:none;
            border:none; 
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
    <li class="breadcrumb-item active">Users</li>
  </ol>
</div><!-- /.col -->

<?= $this->endSection();?>

<?= $this->section('content');?>

<div class="row">
  <div class="col-md-12">
      <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-<?php if(session()->getFlashdata('err')) echo 'danger'; else echo 'success';?> alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('msg') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif;?>
    <div class="card">
      <div class="card-header bg-light">
        <div class="d-flex justify-content-between">
          <span style="margin-top: 3px;">Active Users</span>
        </div>
      </div>
      <!-- card header -->
      <div class="card-body">
        <table id="announcements" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Employee ID</th>
              <th>Username</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Contact No.</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user ): ?>
              <tr>
                <td><?= $user['employee_id']?></td>
                <td><?= $user['username']?></td>
                <td><?= $user['first_name']?> <?= $user['last_name']?></td>
                <td><?= $user['email']?></td>
                <td><?= $user['contact_number']?></td>
                <td>
                <button class="link text-primary upd" value="<?= $user['user_id']?>"><?php
                    if($user['status'] == 'a')
                      echo "Active";
                    else
                      echo "Inactive";
                  ?>
                </button>
                </td>
                <td style="text-align: center;">
                  <a href="<?= base_url('users/'.$user['username']);?>" type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Show details"><i class="fas fa-bars"></i></a>
                  <button type="button" value="<?= $user['user_id']?>" name="button" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete" id="del"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script type="text/javascript">
  $(function () {
  $('#announcements').DataTable({
    "responsive": true,
    "autoWidth": false,
    });
  });

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<!-- SweetAlert2 Delete -->
<script type="text/javascript">

  $(document).ready(function ()
  {
    $('.del').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();

      Swal.fire({
        icon: 'question',
        title: 'Delete?',
        text: 'You can view deleted users at the deleted section',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        if (result.isConfirmed)
        {
          window.location = 'delete/' + id;
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>

<!-- SweetAlert2 Update Status -->
<script type="text/javascript">

  $(document).ready(function ()
  {
    $('.upd').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();

      Swal.fire({
        icon: 'question',
        title: 'Update status?',
        text: 'User status will be updated, are you sure?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        if (result.isConfirmed)
        {
          window.location = 'status/' + id ;
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>

<?= $this->endSection();?>
