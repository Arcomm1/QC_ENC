<div id="users">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <?php echo lang('manage_users'); ?>
                    <a href="<?php echo site_url('users/create'); ?>" class="btn btn-primary"><?php echo lang('create'); ?></a>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col"><?php echo lang('user'); ?></th>
                                <th scope="col"><?php echo lang('full_name'); ?></th>
                                <th scope="col"><?php echo lang('role'); ?></th>
                                <th scope="col" style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u) { ?>
                                <tr>
                                    <td><?php echo $u->name; ?></td>
                                    <td><?php echo $u->full_name; ?></th>
                                    <td><?php echo lang($u->role); ?></td>
                                    <td><a href="<?php echo site_url('users/edit/'.$u->id); ?>"><i class="fas fa-edit mr-2"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
