<div id="users">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <?php echo lang('create'); ?>
                </div>
                <div class="card-body">
                    <?php echo form_open(); ?>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="name"><?php echo lang('enter_username'); ?></label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="full_name"><?php echo lang('full_name'); ?></label>
                                <input type="text" name="full_name" id="full_name" class="form-control">
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
                                    <option value="yes"><?php echo lang('yes'); ?></option>
                                    <option value="no"><?php echo lang('no'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="can_listen"><?php echo lang('can_listen'); ?></label>
                                <select class="form-control" id="can_listen" name="can_listen">
                                    <option value="yes"><?php echo lang('yes'); ?></option>
                                    <option value="no"><?php echo lang('no'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="role"><?php echo lang('role'); ?></label>
                                <select class="form-control" id="role" name="role">
                                    <option value="admin"><?php echo lang('admin'); ?></option>
                                    <option value="manager"><?php echo lang('manager'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="col-form-label" for="start_page"><?php echo lang('start_page'); ?></label>
                                <select class="form-control" id="start_page" name="start_page">
                                    <option value="calls"><?php echo lang('calls'); ?></option>
                                    <option value="stats"><?php echo lang('stats'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label class="col-form-label" for="language"><?php echo lang('interface_language'); ?></label>
                                <select class="form-control" id="language" name="language">
                                    <?php foreach (qc_get_languages() as $l) { ?>
                                        <option value="<?php echo $l; ?>"><?php echo lang($l); ?></option>
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
