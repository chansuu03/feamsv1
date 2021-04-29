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