<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('login'));
        }

        $this->data = new stdClass();

        $u = $this->User_model->get($this->session->userdata('user_id'));

        if (!$u) {
            redirect(site_url('logout'));
        }

        unset($u->password);

        $this->lang->load('main', $u->language);

        $this->data->logged_in_user = $u;

        $this->data->available_devices = array();
        $this->data->available_device_ids = array();

        if ($this->data->logged_in_user->role == 'admin') {
            $this->data->available_devices = $this->Device_model->get_all();
            foreach ($this->data->available_devices as $d) {
                $this->data->available_device_ids[] = $d->id;
            }
        } else {
            $this->data->available_devices = $this->User_model->get_devices($this->data->logged_in_user->id);
            foreach ($this->data->available_devices as $d) {
                $this->data->available_device_ids[] = $d->id;
            }
        }

        $this->data->device_aliases = $this->User_model->get_device_aliases($this->data->logged_in_user->id);

        $this->data->page_title = 'QuickCDR';
    }


}
