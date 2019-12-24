<?php

use App\Libraries\Db;

class User
{
    // TEST CLASS
    private $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    // Login User
    public function login($name, $password){

        $this->db->query('SELECT * FROM users WHERE name = :name');
        $this->db->bind(':name', $name);

        $row = $this->db->single();

        if($password == $row->password){
            return $row;
        } else {
            return false;
        }
    }

    // CREATE BLOG TABLE FOR THIS EXAMPLE
    public function findUserByName($name)
    {
        $this->db->query("SELECT * FROM users WHERE name = :name");
        $this->db->bind(':name', $name);

        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }
}