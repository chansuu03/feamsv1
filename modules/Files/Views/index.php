<?= $this->extend('Modules\Views\template');?>

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

<?php if(session()->getFlashdata('msg')):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('msg') ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
<?php endif;?>

<!-- Association files -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Association Files</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="d-flex flex-row-reverse" style="margin-bottom: 5px;">
            <?php if($logged_in['dept_id'] == 1): ?>
            <a href="<?= base_url('files/add');?>" class="btn btn-outline-success btn-sm align-self-end" role="button" aria-pressed="true">Add Files</a>
            <?php elseif($logged_in['dept_id'] != 1): ?>
            <a href="<?= base_url($logged_in['username'].'/files/add');?>" class="btn btn-outline-success btn-sm align-self-end" role="button" aria-pressed="true">Add Files</a>
            <?php endif;?>
        </div>

        <table id="assocFiles" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> </th>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>Uploader</th>
                    <th>Date Uploaded</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    function readableBytes($bytes) {
                        $i = floor(log($bytes) / log(1024));
                        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    
                        return sprintf('%.02F', $bytes / pow(1024, $i)) * 1 . ' ' . $sizes[$i];
                    }
                ?>
                <?php $i = 1;?>
                <?php foreach($files as $file):?>
                <tr>
                    <td><?php echo $i; $i++;?></td>
                    <td>
                        <a href="<?= base_url();?>/uploads/files/assoc/<?= $file['name'];?>"><?= $file['name'];?></a>
                    </td>
                    <td>
                        <?= readableBytes($file['size']);?>
                    </td>
                    <td><?= $file['uploader'];?></td>
                    <td>
                        <?php
                            $date = date_create($file['uploaded_at']);
                            echo date_format($date, 'F d, Y H:i');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if(session()->get('type') == 1):?>
                        <button type="button" value="<?= $file['file_id']?>" name="button" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete" id="del"><i class="fas fa-trash"></i></button>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Member files -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Member Files</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="memberFiles" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th> </th>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>Uploader</th>
                    <th>Date Uploaded</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;?>
                <?php foreach($members as $member):?>
                <tr>
                    <td><?php echo $i; $i++;?></td>
                    <td>
                        <a href="<?= base_url();?>/uploads/files/assoc/<?= $member['name'];?>"><?= $member['name'];?></a>
                    </td>
                    <td>
                        <?= readableBytes($member['size']);?>
                    </td>
                    <td><?= $member['uploader'];?></td>
                    <td>
                        <?php
                            $date = date_create($member['uploaded_at']);
                            echo date_format($date, 'F d, Y H:i');
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <button type="button" value="<?= $member['file_id']?>" name="button" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete" id="del"><i class="fas fa-trash"></i></button>
                    </td>
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
        $("#assocFiles").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>

<script>
    $(function () {
        $("#memberFiles").DataTable({
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
          window.location = '/<?=$logged_in['username'] ?>/files/delete/' + id;
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
