<div id="users">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <?php echo $user->name.": ".lang('numbers'); ?>
                    <div class="btn-group">
                        <a href="<?php echo site_url('users/edit/'.$user->id); ?>" class="btn btn-primary"><?php echo lang('back'); ?></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <?php echo form_open(); ?>
                            <div class="input-group">
                                <input class="form-control" type="text" name="new_device_id" id="new_device_id" placeholder="<?php echo lang('choose_number'); ?>">
                                <button type="submit" class="btn btn-success"><?php echo lang('add'); ?></a>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col"><?php echo lang('number'); ?></th>
                                        <?php if ($logged_in_user->show_names == 'yes') { ?>
                                            <th scope="col"><?php echo lang('full_name'); ?></th>
                                        <?php } ?>
                                        <th scope="col" style="width:10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($devices as $d) { ?>
                                        <tr>
                                            <td><?php echo $d->id; ?></td>
                                            <?php if ($logged_in_user->show_names == 'yes') { ?>
                                                <td><?php echo $d->description ? $d->description : ""; ?></td>
                                            <?php } ?>
                                            <td><a href="<?php echo site_url('users/remove_device/'.$user->id."/".$d->id); ?>"><i class="fas fa-times mr-2"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
