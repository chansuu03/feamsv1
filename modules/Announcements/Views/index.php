<?= $this->extend('Modules\Views\template');?>

<?= $this->section('content_header');?>
<div class="col-sm-6">
  <h1 class="m-0 text-dark">Announcements</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
    <li class="breadcrumb-item active">Announcements</li>
  </ol>
</div><!-- /.col -->
<?= $this->endSection();?>

<?= $this->section('content');?>

<div class="row">
  <div class="col-md-12">
      <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('msg') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif;?>
      <?php if(session()->getFlashdata('failedmsg')):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle"></i> <?= session()->getFlashdata('failedmsg') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif;?>
    <div class="card">
      <div class="card-header bg-light">
        <div class="d-flex justify-content-between">
          <span style="margin-top: 3px;">All announcements</span>
          <a href="<?= base_url('announcements/add');?>" class="btn btn-outline-success btn-sm align-self-end" role="button" aria-pressed="true">Add Announcement</a>
        </div>
      </div>
      <!-- card header -->
      <div class="card-body">
        <table id="announcements" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Date Posted</th>
              <th>Start Date</th>
              <th>Updated at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($announce as $ann ): ?>
              <tr>
                <td><?= $ann['title']?></td>
                <td><?= $ann['description']?></td>
                <td><?= $ann['date_posted']?></td>
                <td><?= $ann['start_date']?></td>
                <td><?= $ann['updated_at']?></td>
                <td style="text-align: center;">
                  <a href="<?= base_url('announcements/'.$ann['ann_id']);?>" type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Show details"><i class="fas fa-bars"></i></a>
                  <button type="button" value="<?= $ann['ann_id']?>" name="button" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete" id="del"><i class="fas fa-trash"></i></button>
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
        text: 'You can view deleted announcements at the deleted section',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          window.location = 'announcements/delete/' + id;
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
