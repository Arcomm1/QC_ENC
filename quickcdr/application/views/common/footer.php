            <footer id="footer">
                <div class="row">
                    <div class="col-lg-12">
                        <hr>
                        <ul class="list-unstyled">
                            <li class="float-lg-right"><a href="#top"><?php echo lang('back_to_top'); ?></a></li>
                            <li><a href="http://arcomm.ge/next/?page_id=415"><?php echo lang('blog'); ?></a></li>
                            <li><a href="http://arcomm.ge/next/"><?php echo lang('company'); ?></a></li>

                        </ul>
                        <p><?php echo qc_get_version_string(); ?><a href="http://arcomm.ge"> ARComm LTD</a>. <?php echo lang('copyright'); ?> &copy 2019-<?php echo date('Y'); ?></p>

                    </div>
                </div>

            </footer>
        </div>

    </body>

<script type="text/javascript">
    var app_url = "<?php echo site_url();?>"
    var user_language = "<?php echo $logged_in_user->language; ?>"
    var user_id = "<?php echo $logged_in_user->id; ?>"
    var user_start_page = "<?php echo $logged_in_user->start_page; ?>"
</script>


<?php if (isset($js_vars) and is_array($js_vars)) { ?>
<script type="text/javascript">
    <?php foreach ($js_vars as $var => $val) {
        echo "var ".$var." = '".$val."';\n";
    } ?>
</script>
<?php } ?>

<script type="text/javascript">
    <?php echo "var lang = ".json_encode($this->lang->language);  ?>
</script>


<?php if (isset($js_include) and is_string($js_include)) { ?>
<script type="text/javascript" src="<?php echo $js_include; ?>"></script>
<?php } ?>
<?php if (isset($js_include) and is_array($js_include)) { foreach ($js_include as $js) { ?>
<script type="text/javascript" src="<?php echo $js; ?>"></script>
<?php } } ?>

<?php if ($this->session->flashdata('msg_style')) { die("test"); ?>
<script type="text/javascript">send_notif("<?php echo $this->session->flashdata('msg_body'); ?>", "<?php echo $this->session->flashdata('msg_style'); ?>");</script>

<?php } ?>

</html>
