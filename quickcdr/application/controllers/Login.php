<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->lang->load('main', 'english');
    }


    public function index()
    {
        $this->data['page_title'] = lang('log_in');

        if ($this->input->post()) {

            if (!$this->input->post('username') || !$this->input->post('password')) {
                $this->data['auth_errors'] = lang('enter_username_and_password');
            } else {
                $user = $this->User_model->get_by('name', $this->input->post('username'));

                if (!$user) {
                    $this->data['auth_errors'] = lang('invalid_username');
                } else {
                    if (md5($this->input->post('password')) != $user->password) {
                        $this->data['auth_errors'] = lang('invalid_password');
                    } else {
                        $this->session->set_userdata('logged_in', true);
                        $this->session->set_userdata('user_id', $user->id);

                        redirect(site_url('start'), 'refresh');
                    }
                }
            }
        }

        $this->load->view('login/index', $this->data);
    }


}
