<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Calls extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $where['calldate >'] = $this->input->get('calldate_gt') ? $this->input->get('calldate_gt') : QC_TODAY_START;
        $where['calldate <'] = $this->input->get('calldate_lt') ? $this->input->get('calldate_lt') : QC_TODAY_END;

        $where['disposition'] = $this->input->get('disposition');

        $like['src'] = $this->input->get('src');
        $like['dst'] = $this->input->get('dst');

        $this->config->load('pagination');
        $config                 = $this->config->item('pagination');
        $config['base_url']     = site_url('calls/');
        $this->data->num_calls  = $this->Call_model->count($this->data->available_device_ids, $where, false, $like);
        $config['total_rows']   = $this->data->num_calls;
        $config['per_page']     = 20;
        $config['anchor_class'] = 'follow_link';
        $config['suffix']       = '&action=search';

        foreach ($this->input->get() as $f => $v) {
            if ($f == 'per_page') { continue; }
            $config['suffix'] .= '&'.$f."=".$v;
        }

        $config['first_url'] = '?per_page=1'.$config['suffix'];
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->input->get('per_page');
        $this->data->page = $page;

        $this->data->calls = $this->Call_model->search($this->data->available_device_ids, $where, $like, $config["per_page"], $page);

        $this->data->pagination_links  = $this->pagination->create_links();

        $this->data->js_include = base_url('assets/js/components/calls.js');

        if ($this->data->logged_in_user->show_names == 'yes') {
            foreach ($this->data->available_devices as $d) {
                if (!property_exists($d, 'description')) {
                    $d->description = $d->id;
                }
                $this->data->device_names[$d->id] = $d->description;
            }
        }

        $this->load->view('common/header', $this->data);
        $this->load->view('calls/index');
        $this->load->view('common/footer');
    }


    public function get_file($uniqueid = false)
    {
        if (!$uniqueid) {
            $this->load->library('user_agent');
            qc_set_flash_notif('danger', lang('something_wrong'));
            redirect($this->agent->referrer());
        }

        $call = $this->Call_model->get_by('uniqueid', $uniqueid);
        if (!$call) {
            qc_set_flash_notif('danger', lang('something_wrong'));
            redirect($this->agent->referrer());
        }

        $path = qc_get_call_recording_path($call);
        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($path));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Accept-Ranges: bytes');
            header('Pragma: public');
            header('Content-Length: ' . filesize($path));
            ob_clean();
            flush();
            readfile($path);
            exit();
        } else {
            qc_set_flash_notif('danger', lang('something_wrong'));
            redirect($this->agent->referrer());
        }


    }


}
