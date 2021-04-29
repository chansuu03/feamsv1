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
  <h1 class="m-0 text-dark">Sliders</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Sliders</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>

<div class="card">
  <div class="card-header">
        <h3 class="card-title">Sliders</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
  </div>
  <div class="card-body">
        <div class="d-flex flex-row-reverse" style="margin-bottom: 5px;">
            <?php if($logged_in['role'] == 1): ?>
              <a href="<?= base_url('sliders/add');?>" class="btn btn-outline-success btn-sm align-self-end" role="button" aria-pressed="true">Add Slider</a>
            <?php endif;?>
        </div>
        <!-- Table -->
        <table id="sliders" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($sliders as $slider):?>
                <tr>
                  <td><?= $slider['title']?></td>
                  <td><?= $slider['description']?></td>
                  <td>
                    <a href="<?= base_url('/uploads/sliders/'.$slider['image_file'])?>" target="_blank">View Image</a>
                  </td>
                  <td>
                    <a href="" type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Show details"><i class="fas fa-bars"></i></a>
                    <button type="button" value="<?= $slider['slider_id']?>" name="button" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete" id="del"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              <?php endforeach;?>
            </tbody>
        </table>        
  </div>
</div>

<?= $this->endSection();?>

<?= $this->section('scripts') ?>
<script>
    $(function () {
        $("#sliders").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>

<!-- SweetAlert2 -->
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
        text: 'Are you sure you want to delete uploaded file?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          window.location = '/sliders/delete/' + id;
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
