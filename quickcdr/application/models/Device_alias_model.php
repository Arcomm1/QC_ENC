<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Device_alias_model extends MY_Model {


    public function __construct()
    {
        $this->_table = 'qc_device_aliases';
        parent::__construct();
    }


}
