<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->r = new stdClass();

        $this->r->status = 'FAIL';
        $this->r->message = 'Internal error';
        $this->r->data = new stdClass();
    }


    private function _respond() {
        header('Content-Type: application/json');
        echo json_encode($this->r, JSON_FORCE_OBJECT);
    }


    public function index()
    {
        $this->data->users = $this->User_model->get_all();
        $this->load->view('common/header', $this->data);
        $this->load->view('users/index');
        $this->load->view('common/footer');
    }


    public function edit($id = false)
    {
        if (!$id) {
            redirect(site_url('users'));
        }
        $this->data->user = $this->User_model->get($id);

        if (!$this->data->user) {
            redirect(site_url('users'));
        }

        if ($this->input->post()) {
            $data = $this->input->post();
            if ($this->input->post('password')) {
                if ($this->input->post('password') != $this->input->post('confirm_password')) {
                    redirect(site_url('users/edit/'.$id));
                }
            }

            unset($data['confirm_password']);
            $data['password'] = md5($data['password']);
            $this->User_model->update($id, $data);
            redirect(site_url('users/edit/'.$id));
        }

        $this->load->view('common/header', $this->data);
        $this->load->view('users/edit');
        $this->load->view('common/footer');
    }


    public function create()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            if (!$this->input->post('password') || !$this->input->post('confirm_password')) {
                redirect(site_url('users/create'));
            }
            if ($this->input->post('password') != $this->input->post('confirm_password')) {
                redirect(site_url('users/create'));
            }

            unset($data['confirm_password']);
            $data['password'] = md5($data['password']);

            $new_user_id = $this->User_model->create($data);
            redirect(site_url('users/edit/'.$new_user_id));
        }

        $this->load->view('common/header');
        $this->load->view('users/create');
        $this->load->view('common/footer');
    }


    public function devices($id = false)
    {
        if (!$id) {
            redirect(site_url('users'));
        }
        $this->data->user = $this->User_model->get($id);

        if (!$this->data->user) {
            redirect(site_url('users'));
        }

        $this->data->devices = $this->User_model->get_devices($id);

        if ($this->input->post()) {
            $this->User_model->add_device($id, $this->input->post('new_device_id'));
            redirect(site_url('users/devices/'.$id));
        }

        $this->load->view('common/header', $this->data);
        $this->load->view('users/devices');
        $this->load->view('common/footer');
    }


    public function update_settings($id = false)
    {
        if (!$id) {
            $this->r->message = 'Invalid request';
            $this->_respond();
        }

        if (!$this->input->post()) {
            $this->r->message = 'Invalid request';
            $this->_respond();
        }

        $this->r->status = 'OK';
        $this->r->message = "Settings updated succesfully";
        $this->r->data = $this->input->post();

        $this->User_model->update($id, $this->input->post());

        $this->_respond();
    }


    public function add_device($id = false, $device_id = false)
    {
        if (!$id || !$device_id) {
            redirect(site_url('users'));
        }

        if (!is_numeric($device_id)) {
            redirect(site_url('users'));
        }

        $user = $this->User_model->get($id);

        if (!$user) {
            redirect(site_url('users'));
        }

        $this->User_model->add_device($id, $device_id);
        redirect(site_url('users/devices/'.$id));
    }


    public function remove_device($id = false, $device_id = false)
    {
        if (!$id || !$device_id) {
            redirect(site_url('users'));
        }

        if (!is_numeric($device_id)) {
            redirect(site_url('users'));
        }

        $user = $this->User_model->get($id);

        if (!$user) {
            redirect(site_url('users'));
        }

        $this->User_model->remove_device($id, $device_id);
        redirect(site_url('users/devices/'.$id));
    }


}
