<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_create_schema extends CI_Migration {


    public function up()
    {
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 3,
                    'unsigned' => true,
                    'auto_increment' => true,
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 200,
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 300,
                ),
                'role' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 300
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'language' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
                'start_page' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ),
            )
        );
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('qc_users');


        $data[] = array(
            'name'          => 'admin',
            'password'      => '21232f297a57a5a743894a0e4a801fc3',
            'role'          => 'admin',
            'email'         => 'admin@example.com',
            'language'      => 'english',
            'start_page'    => 'calls',
        );
        $this->db->insert_batch('qc_users', $data);


        $this->dbforge->add_field(
            array(
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                ),
                'device_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                ),
            )
        );
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('device_id');
        $this->dbforge->create_table('qq_user_devices');
    }


    public functio down()
    {
        $this->dbforge->drop_table('qc_users');
        $this->dbforge->drop_table('qc_user_devices');
    }

}
