<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_title; ?> | Quickqueues</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>" type="image/png">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" media="screen">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome-all.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/datatables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.datetimepicker.min.css'); ?>">
        <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/blue.monday/css/jplayer.blue.monday.min.css'); ?>"> -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jplayer-flat/jplayer-flat-audio-theme.css'); ?>">

        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/datatables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/moment-locales.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datetimepicker.full.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.bundle.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/vue.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/axios.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-notify.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.jplayer.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.jplayer.min.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url('assets/js/components/common.js'); ?>"></script>

    </head>

    <body>

        <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="<?php echo site_url('start'); ?>">
                    QuickCDR
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" id="nav-calls">
                        <a class="nav-link" href="<?php echo site_url('calls'); ?>"><?php echo lang('calls'); ?></a>
                    </li>
                    <li class="nav-item" id="nav-stats">
                        <a class="nav-link" href="<?php echo site_url('stats'); ?>"><?php echo lang('stats'); ?></a>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#qq_navbar" aria-controls="qq_navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="qq_navbar">
                    <ul class="nav navbar-nav ml-auto">
                        <?php if ($this->data->logged_in_user->role == 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('users'); ?>"><?php echo lang('users'); ?></a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#settings-modal"><?php echo lang('settings'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('logout'); ?>"><?php echo lang('log_out'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            
