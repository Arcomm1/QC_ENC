<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Call_model extends MY_Model {


    public function __construct()
    {
        $this->_table = 'cdr';
        $this->_db_group = 'asteriskcdrdb';
        parent::__construct();
    }


    /**
     * Search calls
     *
     * @param array $limit_extensions List of extensions to which limit search
     * @param array $where Array of values to match with WHERE clause
     * @param array $like  Array of values to match with LIKE clause
     * @param int $limit Limit for pagination
     * @param int $offset Offset for pagination
     * @param bool Whether random calls should be returned
     * @return obj CodeIgniter database object
     */
    public function search($limit_extensions = array(), $where = false, $like = false, $offset = false, $limit = false, $random = false)
    {
        if ($where and is_array($where)) {
            foreach ($where as $column => $value) {
                if ($value) {
                    if (is_array($value)) {
                        $this->db->where_in($column, $value);
                    } else {
                        $this->db->where($column, $value);
                    }
                }
            }
        }

        if ($like and is_array($like)) {
            foreach ($like as $column => $value) {
                if ($value) {
                    if (is_array($value)) {
                        $this->db->group_start();
                        foreach ($value as $v) {
                            $this->db->or_like($column, $v);
                        }
                        $this->db->group_end();
                    } else {
                        $this->db->like($column, $value);
                    }
                }
            }
        }

        if (count($limit_extensions) > 0) {
            $this->db->group_start();
            $this->db->or_where_in('src', $limit_extensions);
            $this->db->or_where_in('dst', $limit_extensions);
            $this->db->group_end();
        }

        $this->db->where('dst !=', 's');

        // $this->db->where('dcontext !=', 'ext-queues');

        if ($offset) {
            $this->db->limit($offset, $limit);
        }
        if ($random) {
            $this->db->order_by('RAND()');
        } else {
            $this->db->order_by('calldate DESC');
        }


        // die($this->db->get_compiled_select());
        return $this->db->get($this->_table)->result();
    }


    /**
     * Count CDRs
     *
     * @param array $limit_extensions List of extensions to which limit search
     * @param array $where Array of values to match with WHERE clause
     * @param array $like  Array of values to match with LIKE clause
     * @return obj CodeIgniter database object
     */
    public function count($limit_extensions = array(), $where = false, $where_not_in = false, $like = false)
    {
        if ($where and is_array($where)) {
            foreach ($where as $column => $value) {
                if ($value) {
                    if (is_array($value)) {
                        $this->db->where_in($column, $value);
                    } else {
                        $this->db->where($column, $value);
                    }
                }
            }
        }

        if ($where_not_in and is_array($where_not_in)) {
            foreach ($where_not_in as $column => $value) {
                if ($value) {
                    if (is_array($value)) {
                        $this->db->where_not_in($column, $value);
                    } else {
                        $this->db->where_not($column, $value);
                    }
                }
            }
        }

        if ($like and is_array($like)) {
            foreach ($like as $column => $value) {
                if ($value) {
                    if (is_array($value)) {
                        $this->db->group_start();
                        foreach ($value as $v) {
                            $this->db->or_like($column, $v);
                        }
                        $this->db->group_end();
                    } else {
                        $this->db->like($column, $value);
                    }
                }
            }
        }
        $this->db->from($this->_table);

        if (count($limit_extensions) > 0) {
            $this->db->group_start();
            $this->db->or_where_in('src', $limit_extensions);
            $this->db->or_where_in('dst', $limit_extensions);
            $this->db->group_end();
        }
        // $this->db->order_by('id DESC');
        $this->db->where('dst !=', 's');

        // $this->db->where('dcontext !=', 'ext-queues');

        // die($this->db->get_compiled_select());
        return $this->db->count_all_results();
    }


}
