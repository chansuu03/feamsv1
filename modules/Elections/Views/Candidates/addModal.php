<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Candidate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('elections/candidates/add');?>
          <div class="form-group">
            <label for="candidate_name">Candidate Name</label>
            <select id="candidate_name" class="form-control" name="candidate_name">
              <option selected value="">Choose...</option>
              <?php foreach($users as $user):?>
                <option value="<?= $user['user_id']?>"><?= $user['first_name']?> <?= $user['last_name']?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <label for="position">Position</label>
            <select id="position" class="form-control" name="position">
              <option selected value="">Choose...</option>
              <?php foreach($positions as $position):?>
                <option value="<?= $position['id']?>"><?= $position['description']?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <label for="platform">Platform</label>
            <textarea class="form-control" id="platform" rows="3" name="platform" value=""></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
      <?= form_close();?>
    </div>
  </div>
</div>