<?= $this->extend('Modules\Views\template');?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Reports</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Reports</li>
    <li class="breadcrumb-item active">Login</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Login Reports</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <p class="text-right">
            <a href="<?= base_url('reports/login/print');?>" class="text-right">Print Report</a>
        </p>
        <table id="login" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Date Login</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $detail):?>
                    <?php            
                        $date = date_create($detail['login_date']);
                        $datelogged = date_format($date, 'F d, Y H:i:s');
                    ?>
                    <tr>
                        <td><?= $detail['first_name']?></td>
                        <td><?= $detail['last_name']?></td>
                        <td><?= $detail['username']?></td>
                        <td><?= $detail['role_id']?></td>
                        <td><?= $datelogged?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script>
  $(function () {
    $("#login").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
<?= $this->endSection();?>
