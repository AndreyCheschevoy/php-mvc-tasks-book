<?php

class Task
{
    // TEST CLASS
    private $db;

    public function __construct()
    {
        $this->db = new App\Libraries\Db;
    }

    public function countTasks($records)
    {
        $limit = 2;
        $query = "SELECT * FROM tasks";

        $this->db->query($query);
        $this->db->resultSet();
        $total_results = $this->db->rowCount();

        return $total_results;
    }
    // CREATE BLOG TABLE FOR THIS EXAMPLE
    public function getTasks()
    {
        $this->db->query("SELECT * FROM tasks");

        return $this->db->resultSet();
    }

    public function getPaginateTasks($offset, $records_per_page, $orderBy = 'username', $sortType = 'DESC')
    {

        $this->db->query("SELECT * FROM tasks ORDER BY $orderBy $sortType LIMIT $offset, $records_per_page");

        return $this->db->resultSet();
    }

    public function getTaskForEdit($id)
    {
        $this->db->query("SELECT * FROM tasks WHERE id = :id");
        $this->db->bind(":id", $id);

        return $this->db->single();

    }

    public function addTask($data)
    {

        $this->db->query('INSERT INTO tasks (email, username, text, status) VALUES(:email, :name, :text, :status)');
        // Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':text', $data['text']);
        $this->db->bind(':status', $data['status']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTask($data)
    {
        $this->db->query('UPDATE tasks SET text = :text, status = :status, changed = 1 WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':text', $data['text']);
        $this->db->bind(':status', $data['status']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteTasks($id)
    {
        $this->db->query('DELETE FROM tasks WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}