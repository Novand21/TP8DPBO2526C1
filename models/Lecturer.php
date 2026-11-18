<?php

include_once("models/DB.php");

class Lecturer extends DB
{
    function getLecturer()
    {
        $query = "SELECT lecturers.*, departments.name AS department_name
                  FROM lecturers
                  LEFT JOIN departments ON lecturers.department_id = departments.id
                  ORDER BY lecturers.id ASC";
        return $this->execute($query);
    }

    function getLecturerById($id)
    {
        $query = "SELECT * FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }

    function add($data)
    {
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $department_id = !empty($data['department_id']) ? $data['department_id'] : "NULL";

        $query = "INSERT INTO lecturers (name, nidn, phone, join_date, department_id)
                  VALUES ('$name', '$nidn', '$phone', '$join_date', $department_id)";
        return $this->execute($query);
    }

    function edit($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $department_id = !empty($data['department_id']) ? $data['department_id'] : "NULL";

        $query = "UPDATE lecturers
                  SET name = '$name', nidn = '$nidn', phone = '$phone', join_date = '$join_date', department_id = $department_id
                  WHERE id = $id";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }
}