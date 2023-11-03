<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends MY_Model {


    public function __construct()
    {
        $this->_table_prefix = 'qc_';
        $this->_user_devices_table = 'qc_user_devices';
        $this->_device_aliases_table = 'qc_device_aliases'; 
        parent::__construct();
    }


    /**
     * Get list of devices associated with specific user ID
     *
     * @param int $id User ID
     * @return bool|array List of devices, or false on failure
     */
    public function get_devices($id = false) {

        if (!$id) {
            return false;
        }

        $devices = array();
        $associations = $this->db->get_where($this->_user_devices_table, array('user_id' => $id));
        foreach ($associations->result() as $a) {
            $d = $this->Device_model->get($a->device_id);
            if ($d) {
                $devices[] = $this->Device_model->get($a->device_id);
            } else {
                // Maybe this is pseudo device, like forwarded number
                // So we create presudo device object to mimic asterisk devices
                $p = new stdClass();
                $p->id = $a->device_id;
                $devices[] = $p;
            }
        }

        return $devices;

    }


    /**
     * Assign specific device to specific user
     *
     * @param int $id User ID
     * @param int $device_id Device ID
     * @return bool True on success, false otherwise
     */
    public function add_device($id = false, $device_id = false)
    {
        if (!$id || !$device_id) {
            return false;
        }
        $q = 'INSERT IGNORE INTO '.$this->_user_devices_table.' (user_id, device_id) ';
        $q .= 'VALUES('.$id.','.$device_id.');';
        $this->db->query($q);
        return true;
    }


    /**
     * Remove specific device from User
     *
     * @param int $id User ID
     * @param int $device_id Device ID
     * @return bool True on success, false otherwise
     */
    public function remove_device($id = false, $device_id = false)
    {
        if (!$id || !$device_id) {
            return false;
        }

        $this->db->where('user_id', $id);
        $this->db->where('device_id', $device_id);
        $this->db->delete($this->_user_devices_table);
        return true;
    }


    /**
     * Get list of device aliases associated with specific user ID
     *
     * @param int $id User ID
     * @return bool|array List of device aliases, or false on failure
     */
    public function get_device_aliases($id = false) {

        if (!$id) {
            return false;
        }

        $aliases = array();

        foreach ($this->Device_alias_model->get_many_by('user_id', $id) as $da) {
            $aliases[$da->device_id] = $da->alias;
        }

        return $aliases;

    }


    /**
     * Assign specific device alias for specific user
     *
     * @param int $id User ID
     * @param int $device_id Device ID
     * @param int $alias Device alias
     * @return bool True on success, false otherwise
     */
    public function add_device_alias($id = false, $device_id = false, $alias = false)
    {
        if (!$id || !$device_id || !$alias) {
            return false;
        }
        $q = 'INSERT IGNORE INTO '.$this->_device_aliases_table.' (user_id, device_id, alias) ';
        $q .= 'VALUES('.$id.','.$device_id.','.$alias.');';
        $this->db->query($q);
        return true;
    }

}
