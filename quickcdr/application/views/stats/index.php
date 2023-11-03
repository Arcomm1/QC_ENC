<div id="stats">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-info">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="calldate_gt"><?php echo lang('date_gt'); ?></label>
                                <input name="calldate_gt" type="text" class="form-control" placeholder="<?php echo lang('select_date_gt'); ?>" id="calldate_gt" value="<?php echo $this->input->get('calldate_gt'); ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="calldate_lt"><?php echo lang('date_lt'); ?></label>
                                <input name="calldate_lt" type="text" class="form-control" placeholder="<?php echo lang('select_date_lt'); ?>" id="calldate_lt" value="<?php echo $this->input->get('calldate_lt'); ?>">
                            </div>
                        </div>
                        <div class="col-1 d-flex align-items-end">
                            <div class="form-group">
                                <button @click="refresh" class="btn btn-primary"><?php echo lang('search'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-body">
                    <h3 class="card-title"><?php echo lang('calls_by_disposition'); ?></h3>
                    <div class="row">
                        <div class="col">
                            <canvas id="ctx_disposition_distrib"></canvas>
                        </div>
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr v-for="disposition in Object.keys(by_disposition)">
                                        <th>{{ lang[disposition] }}</th>
                                        <td>{{ by_disposition[disposition] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card border-danger">
                <div class="card-body">
                    <h3 class="card-title"><?php echo lang('calls_by_direction'); ?></h3>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr v-for="direction in Object.keys(by_direction)">
                                        <th>{{ lang[direction] }}</th>
                                        <td>{{ by_direction[direction] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <canvas id="ctx_direction_distrib"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-body">
                    <h3 class="card-title"><?php echo lang('calls_by_duration'); ?></h3>
                    <div class="row">
                        <div class="col">
                            <canvas id="ctx_duration_distrib"></canvas>
                        </div>
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr v-for="duration in Object.keys(by_duration)">
                                        <th>{{ lang[duration] }}</th>
                                        <td>{{ by_duration[duration] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="settings-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo lang('settings'); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="language"><?php echo lang('interface_language'); ?></label>
                                <select v-model="language" class="form-control" id="language" name="language">
                                    <?php foreach (qc_get_languages() as $l) { ?>
                                        <option value="<?php echo $l; ?>"><?php echo lang($l); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="start_page"><?php echo lang('start_page'); ?></label>
                                <select v-model="start_page" class="form-control" id="start_page" name="start_page">
                                    <option <?php if ($logged_in_user->start_page == 'calls') { echo "selected"; } ?> value="calls"><?php echo lang('calls'); ?></option>
                                    <option <?php if ($logged_in_user->start_page == 'stats') { echo "selected"; } ?> value="stats"><?php echo lang('stats'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="update_settings" type="button" class="btn btn-success"><?php echo lang('save_changes'); ?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
