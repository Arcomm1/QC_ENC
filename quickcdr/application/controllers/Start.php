<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Start extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        redirect(site_url($this->data->logged_in_user->start_page));
    }


}
