<?php

include_once("models/DB.php");

class Department extends DB
{
    function getDepartment()
    {
        $query = "SELECT * FROM departments ORDER BY id ASC";
        return $this->execute($query);
    }

    function getDepartmentById($id)
    {
        $query = "SELECT * FROM departments WHERE id = $id";
        return $this->execute($query);
    }

    function add($data)
    {
        $name = $data['name'];
        $faculty = $data['faculty'];

        $query = "INSERT INTO departments (name, faculty) VALUES ('$name', '$faculty')";
        return $this->execute($query);
    }

    function edit($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $faculty = $data['faculty'];

        $query = "UPDATE departments SET name = '$name', faculty = '$faculty' WHERE id = $id";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM departments WHERE id = $id";
        return $this->execute($query);
    }
}