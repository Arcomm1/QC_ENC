<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Stats extends MY_Controller
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
        $this->data->js_include = base_url('assets/js/components/stats.js');
        $this->load->view('common/header', $this->data);
        $this->load->view('stats/index');
        $this->load->view('common/footer');
    }


    public function get_by_disposition()
    {
        $calldate_gt = $this->input->post('calldate_gt') ? $this->input->post('calldate_gt') : QC_TODAY_START;
        $calldate_lt = $this->input->post('calldate_lt') ? $this->input->post('calldate_lt') : QC_TODAY_END;

        foreach (qc_get_disposition_types() as $d) {
            $stats[$d] = $this->Call_model->count(
                $this->data->available_device_ids,
                array(
                    'calldate >'    => $calldate_gt,
                    'calldate <'    => $calldate_lt,
                    'disposition'   => $d
                )
            );
        }

        $this->r->status    = 'OK';
        $this->r->message   = 'Queue stats will follow';
        $this->r->data      = $stats;
        $this->_respond();
    }


    public function get_by_direction()
    {
        $calldate_gt = $this->input->post('calldate_gt') ? $this->input->post('calldate_gt') : QC_TODAY_START;
        $calldate_lt = $this->input->post('calldate_lt') ? $this->input->post('calldate_lt') : QC_TODAY_END;

        $stats['outgoing']  = $this->Call_model->count(
            $this->data->available_device_ids,
            array(
                'calldate >'    => $calldate_gt,
                'calldate <'    => $calldate_lt,
                'src'           => $this->data->available_device_ids
            ),
            array(
                'dst'           => $this->data->available_device_ids
            )
        );

        $stats['incoming']  = $this->Call_model->count(
            $this->data->available_device_ids,
            array(
                'calldate >'    => $calldate_gt,
                'calldate <'    => $calldate_lt,
                'dst'           => $this->data->available_device_ids
            ),
            array(
                'src'           => $this->data->available_device_ids
            )
        );

        $stats['internal']  = $this->Call_model->count(
            $this->data->available_device_ids,
            array(
                'calldate >'    => $calldate_gt,
                'calldate <'    => $calldate_lt,
                'src'           => $this->data->available_device_ids,
                'dst'           => $this->data->available_device_ids,
            )
        );

        $this->r->status    = 'OK';
        $this->r->message   = 'Queue stats will follow';
        $this->r->data      = $stats;
        $this->_respond();
    }


    public function get_by_duration()
    {
        $calldate_gt = $this->input->post('calldate_gt') ? $this->input->post('calldate_gt') : QC_TODAY_START;
        $calldate_lt = $this->input->post('calldate_lt') ? $this->input->post('calldate_lt') : QC_TODAY_END;

        $stats['lt_15']  = $this->Call_model->count(
            $this->data->available_device_ids,
            array(
                'calldate >'    => $calldate_gt,
                'calldate <'    => $calldate_lt,
                'disposition'   => 'ANSWERED',
                'billsec <'     => 15
            )
        );

        $stats['lt_30']  = $this->Call_model->count(
            $this->data->available_device_ids,
            array(
                'calldate >'    => $calldate_gt,
                'calldate <'    => $calldate_lt,
                'disposition'   => 'ANSWERED',
                'billsec <'     => 30
            )
        );

        $stats['lt_60']  = $this->Call_model->count(
            $this->data->available_device_ids,
            array(
                'calldate >'    => $calldate_gt,
                'calldate <'    => $calldate_lt,
                'disposition'   => 'ANSWERED',
                'billsec <'     => 60
            )
        );

        $this->r->status    = 'OK';
        $this->r->message   = 'Queue stats will follow';
        $this->r->data      = $stats;
        $this->_respond();
    }


    public function get_by_device()
    {
        $calldate_gt = $this->input->post('calldate_gt') ? $this->input->post('calldate_gt') : QC_TODAY_START;
        $calldate_lt = $this->input->post('calldate_lt') ? $this->input->post('calldate_lt') : QC_TODAY_END;

        foreach ($this->data->available_devices as $d) {
            $stats[$d->id]['data'] = $d;
            $stats[$d->id]['calls'] = $this->Call_model->count(
                array($d->id),
                array(
                    'calldate >'    => $calldate_gt,
                    'calldate <'    => $calldate_lt,
                )
            );
            $stats[$d->id]['answered'] = $this->Call_model->count(
                array($d->id),
                array(
                    'calldate >'    => $calldate_gt,
                    'calldate <'    => $calldate_lt,
                    'disposition'   => 'ANSWERED'
                )
            );
            $stats[$d->id]['no_answer'] = $this->Call_model->count(
                array($d->id),
                array(
                    'calldate >'    => $calldate_gt,
                    'calldate <'    => $calldate_lt,
                    'disposition'   => 'NO ANSWER'
                )
            );
            $stats[$d->id]['busy'] = $this->Call_model->count(
                array($d->id),
                array(
                    'calldate >'    => $calldate_gt,
                    'calldate <'    => $calldate_lt,
                    'disposition'   => 'BUSY'
                )
            );
            $stats[$d->id]['failed'] = $this->Call_model->count(
                array($d->id),
                array(
                    'calldate >'    => $calldate_gt,
                    'calldate <'    => $calldate_lt,
                    'disposition'   => 'FAILED'
                )
            );
        }

        $this->r->status    = 'OK';
        $this->r->message   = 'Queue stats will follow';
        $this->r->data      = $stats;
        $this->_respond();
    }


}
