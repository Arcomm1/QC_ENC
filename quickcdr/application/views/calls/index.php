<div id="calls">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header"><?php echo lang('search_calls'). "&nbsp<strong>[".lang('found').": ".$num_calls."]</strong>"; ?></div>
                <div class="card-body">
                    <?php echo form_open(false,array('method' => 'get')); ?>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="src"><?php echo lang('src'); ?></label>
                                <input name="src" type="text" class="form-control" placeholder="<?php echo lang('enter_src'); ?>" id="src" value="<?php echo $this->input->get('src'); ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="dst"><?php echo lang('dst'); ?></label>
                                <input name="dst" type="text" class="form-control" placeholder="<?php echo lang('enter_dst'); ?>" id="dst" value="<?php echo $this->input->get('dst'); ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="calldate_gt"><?php echo lang('date_gt'); ?></label>
                                <input name="calldate_gt" type="text" class="form-control" placeholder="<?php echo lang('select_date_gt'); ?>" id="calldate_gt" value="<?php echo $this->input->get('calldate_gt'); ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="calldate_lt"><?php echo lang('date_lt'); ?></label>
                                <input name="calldate_lt" type="text" class="form-control" placeholder="<?php echo lang('select_date_lt') ;?>" id="calldate_lt" value="<?php echo $this->input->get('calldate_lt'); ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="disposition"><?php echo lang('disposition'); ?></label>
                                <select name="disposition" id="disposition" class="form-control">
                                    <option value=""><?php echo lang('select')."..."; ?></option>
                                    <?php foreach (qc_get_disposition_types() as $disp) { ?>
                                        <?php if ($disp == $this->input->get('disposition')) { ?>
                                            <option selected value="<?php echo $disp; ?>"><?php echo lang($disp); ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $disp; ?>"><?php echo lang($disp); ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-1 d-flex align-items-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><?php echo lang('search'); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <div class="card border-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col"></th>
                                        <th scope="col"><?php echo lang('src'); ?></th>
                                        <th scope="col"><?php echo lang('dst'); ?></th>
                                        <th scope="col"><?php echo lang('date') ;?></th>
                                        <th scope="col"><?php echo lang('duration') ;?></th>
                                        <th scope="col"><?php echo lang('disposition'); ?></th>
                                        <th scope="col" style="width:10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($calls as $c) { ?>
                                        <tr>
                                            <td>
                                                <?php if (in_array($c->src, $available_device_ids)) { ?>
                                                    <i class="fas fa-chevron-up text-primary mr-3"></i>
                                                <?php } else { ?>
                                                    <i class="fas fa-chevron-down text-primary mr-3"></i>
                                                <?php } ?>
                                                <?php if ($c->disposition == 'ANSWERED') { ?>
                                                    <i class="fas fa-check text-success"></i>
                                                <?php } else { ?>
                                                    <i class="fas fa-ban text-danger"></i>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo array_key_exists($c->src, $device_aliases) ? $device_aliases[$c->src] : $c->src;
                                                    if ($logged_in_user->show_names == 'yes') {
                                                        echo array_key_exists($c->src, $device_names) ? " - ".$device_names[$c->src] : ""; 
                                                    } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo array_key_exists($c->dst, $device_aliases) ? $device_aliases[$c->dst] : $c->dst; 
                                                    if ($logged_in_user->show_names == 'yes') {
                                                        echo array_key_exists($c->dst, $device_names) ? " - ".$device_names[$c->dst] : ""; 
                                                    } 
                                                ?>
                                            </td>
                                            <td><?php echo $c->calldate; ?></td>
                                            <td><?php echo qc_sec_to_min($c->billsec); ?></td>
                                            <td><?php echo lang($c->disposition); ?></td>
                                            <td>
                                                <?php if ($this->data->logged_in_user->can_listen == 'yes') { ?>
                                                <a @click="load_player('<?php echo $c->uniqueid; ?>')" class="text-danger" data-toggle="modal" data-target="#play_recording"><i class="fas fa-play mr-2"></i></a>
                                                <?php } ?>
                                                <?php if ($this->data->logged_in_user->can_download == 'yes') { ?>
                                                <a href="<?php echo site_url('calls/get_file/'.$c->uniqueid); ?>"><i class="fas fa-download mr-2"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php echo $pagination_links; ?>
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

    <div class="modal fade" id="play_recording" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                            <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                                <div class="jp-type-single">
                                    <div class="jp-gui jp-interface">
                                        <div class="jp-controls">
                                            <a class="jp-play"><i class="fa fa-play"></i></a>
                                            <a class="jp-pause"><i class="fa fa-pause"></i></a>
                                            <a class="jp-stop"><i class="fa fa-stop"></i></a>
                                        </div>
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-volume-controls">
                                            <a class="jp-mute"><i class="fa fa-volume-off"></i></a>
                                            <a class="jp-volume-max"><i class="fa fa-volume-up"></i></a>
                                            <div class="jp-volume-bar">
                                                <div class="jp-volume-bar-value"></div>
                                            </div>
                                        </div>
                                        <div class="jp-time-holder">
                                            <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                            <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="jp-no-solution">
                                        <span>Update Required</span>
                                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" class="close" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
                </div>
            </div>
        </div>
    </div>


</div>
