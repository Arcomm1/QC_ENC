<div id="users">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <?php echo lang('edit').": ".$user->name; ?>
                    <div class="btn-group">
                        <?php if ($user->role == 'manager') { ?>
                        <a href="<?php echo site_url('users/devices/'.$user->id); ?>" class="btn btn-success"><?php echo lang('numbers'); ?></a>
                        <?php } ?>
                        <a href="<?php echo site_url('users'); ?>" class="btn btn-primary"><?php echo lang('back'); ?></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo form_open(); ?>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="name"><?php echo lang('enter_username'); ?></label>
                                <input disabled="" type="text" name="name" id="name" class="form-control" placeholder="<?php echo $user->name; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="full_name"><?php echo lang('full_name'); ?></label>
                                <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $user->full_name; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="password"><?php echo lang('enter_password'); ?></label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="confirm_password"><?php echo lang('confirm_password'); ?></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="can_download"><?php echo lang('can_download'); ?></label>
                                <select class="form-control" id="can_download" name="can_download">
                                    <option <?php if ($user->can_download == 'yes') { echo "selected"; } ?> value="yes"><?php echo lang('yes'); ?></option>
                                    <option <?php if ($user->can_download == 'no') { echo "selected"; } ?> value="no"><?php echo lang('no'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="can_listen"><?php echo lang('can_listen'); ?></label>
                                <select class="form-control" id="can_listen" name="can_listen">
                                    <option <?php if ($user->can_listen == 'yes') { echo "selected"; } ?> value="yes"><?php echo lang('yes'); ?></option>
                                    <option <?php if ($user->can_listen == 'no') { echo "selected"; } ?> value="no"><?php echo lang('no'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="role"><?php echo lang('role'); ?></label>
                                <select class="form-control" id="role" name="role">
                                    <option <?php if ($user->role == 'admin') { echo "selected"; } ?> value="admin"><?php echo lang('admin'); ?></option>
                                    <option <?php if ($user->role == 'manager') { echo "selected"; } ?> value="manager"><?php echo lang('manager'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="start_page"><?php echo lang('start_page'); ?></label>
                                <select class="form-control" id="start_page" name="start_page">
                                    <option <?php if ($user->start_page == 'calls') { echo "selected"; } ?> value="calls"><?php echo lang('calls'); ?></option>
                                    <option <?php if ($user->start_page == 'stats') { echo "selected"; } ?> value="stats"><?php echo lang('stats'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label class="col-form-label" for="language"><?php echo lang('interface_language'); ?></label>
                                <select class="form-control" id="language" name="language">
                                    <?php foreach (qc_get_languages() as $l) { ?>
                                        <?php if ($user->language == $l) { ?>
                                            <option selected value="<?php echo $l; ?>"><?php echo lang($l); ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $l; ?>"><?php echo lang($l); ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary"><?php echo lang('save_changes'); ?></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
