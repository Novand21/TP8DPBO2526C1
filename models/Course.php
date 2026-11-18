<?php

include_once("models/DB.php");

class Course extends DB
{
    function getCourse()
    {
        $query = "SELECT courses.*, lecturers.name AS lecturer_name
                  FROM courses
                  LEFT JOIN lecturers ON courses.lecturer_id = lecturers.id
                  ORDER BY courses.id ASC";
        return $this->execute($query);
    }

    function getCourseById($id)
    {
        $query = "SELECT * FROM courses WHERE id = $id";
        return $this->execute($query);
    }

    function add($data)
    {
        $course_code = $data['course_code'];
        $course_name = $data['course_name'];
        $credits = $data['credits'];
        $lecturer_id = !empty($data['lecturer_id']) ? $data['lecturer_id'] : "NULL";

        $query = "INSERT INTO courses (course_code, course_name, credits, lecturer_id)
                  VALUES ('$course_code', '$course_name', $credits, $lecturer_id)";
        return $this->execute($query);
    }

    function edit($data)
    {
        $id = $data['id'];
        $course_code = $data['course_code'];
        $course_name = $data['course_name'];
        $credits = $data['credits'];
        $lecturer_id = !empty($data['lecturer_id']) ? $data['lecturer_id'] : "NULL";

        $query = "UPDATE courses
                  SET course_code = '$course_code', course_name = '$course_name', credits = $credits, lecturer_id = $lecturer_id
                  WHERE id = $id";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM courses WHERE id = $id";
        return $this->execute($query);
    }
}