<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_title; ?> | QuickCDR</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="icon" href="<?=base_url('assets/img/')?>favicon.ico" type="image/png">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" media="screen">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.min.css'); ?>">

        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
    </head>

    <body>

        <div class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a href="#" class="navbar-brand">QuickCDR</a>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center" style="margin-top: 10%">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card border-info">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <h3 class="card-title"><?php echo lang('log_in'); ?></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php if (isset($auth_errors)) { ?>
                                    <div class="alert alert-danger">
                                        <center>
                                            <?php echo $auth_errors; ?>
                                        </center>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php echo form_open(); ?>
                                        <fieldset>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo lang('enter_username'); ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo lang('enter_password'); ?>">
                                            </div>
                                            <div class="form-group d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary mb-2"><?php echo lang('enter'); ?></button>
                                            </div>
                                        </fieldset>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
