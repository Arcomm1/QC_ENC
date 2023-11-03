<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tools extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!is_cli()) {
            die("No direct script access allowed");
        }

        echo "QuickCDR Management Sctipt\n";
    }


    public function user_create($name = false, $password = false, $role = false)
    {
        if (!$name || !$password || !$role) {
            echo "Invalid arguments!\n";
            echo "USAGE: user_create USERNAME PASSWORD ROLE\n";
            exit(0);
        }

        if ($this->User_model->exists_by('name', $name)) {
            echo "User with same name already exists!\n";
            exit();
        }

        $id = $this->User_model->create(
            array(
                'name'      => $name,
                'password'  => md5($password),
                'role'      => $role
            )
        );

        if ($id) {
            echo "User with ID ".$id." created successfuly!\n";
        } else {
            echo "Could not create user!\n";
        }
    }


    public function user_delete($name = false)
    {
        if (!$name) {
            echo "Invalid arguments!\n";
            echo "USAGE: user_delete USERNAME\n";
            exit(0);
        }

        if ($name == 'admin') {
            echo "Can not delete Administrative user!\n";
            exit();
        }

        $user = $this->User_model->get_by('name', $name);

        if ($user) {
            foreach ($this->User_model->get_devices($user->id) as $d) {
                $this->User_model->remove_device($user->id, $d->id);
            }
        }

        $this->User_model->delete_by('name', $name);

        echo "User with ".$name." deleted successfuly!\n";
    }


    public function user_list()
    {
        echo "Current user list:\n";
        $mask = "|%5.5s |%-30.30s |%-30.30s\n";
        printf($mask, 'ID', 'USERNAME', 'ROLE');
        foreach ($this->User_model->get_all() as $u) {
            printf($mask, $u->id, $u->name, $u->role);
        }
    }


    public function user_device_add($name = false, $device_id = false)
    {
        if (!$name || !$device_id) {
            echo "Invalid arguments!\n";
            echo "USAGE: user_device_add USERNAME DEVICE\n";
            exit(0);
        }

        if (!is_numeric($device_id)) {
            echo "Device is not correct. Device should be numeric!\n";
            exit(0);
        }

        $user = $this->User_model->get_by('name', $name);

        if (!$user) {
            echo "User ".$name." does not exist!\n";
            exit();
        }

        $this->User_model->add_device($user->id, $device_id);
        echo "Successfuly added device ".$device_id." to user ".$name."\n!";
    }


    public function user_device_remove($name = false, $device_id = false)
    {
        if (!$name || !$device_id) {
            echo "Invalid arguments!\n";
            echo "USAGE: user_device_remove USERNAME DEVICE\n";
            exit(0);
        }

        if (!is_numeric($device_id)) {
            echo "Device is not correct. Device should be numeric!\n";
            exit(0);
        }

        if (!$this->Device_model->exists($device_id)) {
            echo "Device ".$device_id." does not exist!\n";
            exit(0);
        }

        $user = $this->User_model->get_by('name', $name);

        if (!$user) {
            echo "User ".$name." does not exist!\n";
            exit();
        }

        $this->User_model->remove_device($user->id, $device_id);
        echo "Successfuly removed device ".$device_id." from user ".$name."\n!";
    }


    public function user_device_list($name = false)
    {
        if (!$name) {
            echo "Invalid arguments!\n";
            echo "USAGE: user_device_list USERNAME\n";
            exit(0);
        }

        $user = $this->User_model->get_by('name', $name);

        if (!$user) {
            echo "User ".$name." does not exist!\n";
            exit();
        }

        echo "Current device list for user ".$name.":\n";
        $mask = "|%20.20s |%-30.30s\n";
        printf($mask, 'EXTENSION', 'DESCRIPTION');
        foreach ($this->User_model->get_devices($user->id) as $d) {
            printf($mask, $d->id, $d->description);
        }
    }


    public function device_list()
    {
        echo "Current device list:\n";
        $mask = "|%20.20s |%-30.30s\n";
        printf($mask, 'EXTENSION', 'DESCRIPTION');
        foreach ($this->Device_model->get_all() as $d) {
            printf($mask, $d->id, $d->description);
        }
    }


    public function user_device_alias_add($name = false, $device_id = false, $alias = false)
    {
        if (!$name || !$device_id || !$alias) {
            echo "Invalid arguments!\n";
            echo "USAGE: user_device_add USERNAME DEVICE ALIAS\n";
            exit(0);
        }

        if (!is_numeric($device_id)) {
            echo "Device is not correct. Device should be numeric!\n";
            exit(0);
        }

        $user = $this->User_model->get_by('name', $name);

        if (!$user) {
            echo "User ".$name." does not exist!\n";
            exit();
        }

        $this->User_model->add_device_alias($user->id, $device_id, $alias);
        echo "Successfuly added device alias ".$device_id." > ".$alias." to user ".$name."\n";
    }


}
