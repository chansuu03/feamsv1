<?= $this->extend('Modules\Views\template');?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Positions List</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Elections</li>
    <li class="breadcrumb-item active">Positions</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>
<?php if(!empty(session()->getFlashdata('failMsg'))):?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('failMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php elseif(!empty(session()->getFlashdata('successMsg'))):?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('successMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif;?>

<div class="card">
  <div class="card-header">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">Primary</button>
  </div>
  <div class="card-body">
  <table id="positions" class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Description</th>
            <th scope="col">Max Votes</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position):?>
                <tr>
                    <td><?= $position['description']?></td>
                    <td><?= $position['max_vote']?></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm edit"  data-toggle="modal" data-target="#addModal" data-id="<?= $position['id']?>">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm del" value="<?= $position['id']?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>  
  </div>
</div>

<?= $this->include('Modules\Elections\Views\Positions\addModal') ?>
<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script>
    $(function () {
        $("#positions").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>

<script type="text/javascript">

  $(document).ready(function ()
  {
    $('.del').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();

      Swal.fire({
        icon: 'question',
        title: 'Delete position?',
        text: 'Election position will be deleted, are you sure?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        if (result.isConfirmed)
        {
          window.location = 'positions/del/' + id ;
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
