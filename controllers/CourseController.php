<?php

include_once("config.php");
include_once("models/Course.php");
include_once("models/Lecturer.php");
include_once("views/CourseView.php");

class CourseController
{
    private $course;
    private $lecturer;

    function __construct()
    {
        $this->course = new Course(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index()
    {
        $this->course->open();
        $this->course->getCourse();

        $data = array();
        while ($row = $this->course->getResult()) {
            array_push($data, $row);
        }

        $this->course->close();

        $view = new CourseView();
        $view->render($data);
    }

    function add()
    {
        if (isset($_POST['submit'])) {
            $this->course->open();
            $this->course->add($_POST);
            $this->course->close();

            header("location:index.php?page=courses");
            exit;
        }

        $this->lecturer->open();
        $this->lecturer->getLecturer();
        $lecturers = array();
        while ($row = $this->lecturer->getResult()) {
            array_push($lecturers, $row);
        }
        $this->lecturer->close();

        $view = new CourseView();
        $view->renderAdd($lecturers);
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            $this->course->open();
            $this->course->edit($_POST);
            $this->course->close();

            header("location:index.php?page=courses");
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->course->open();
            $this->course->getCourseById($id);
            $data = $this->course->getResult();
            $this->course->close();

            $this->lecturer->open();
            $this->lecturer->getLecturer();
            $lecturers = array();
            while ($row = $this->lecturer->getResult()) {
                array_push($lecturers, $row);
            }
            $this->lecturer->close();

            $view = new CourseView();
            $view->renderEdit($data, $lecturers);
        }
    }

    function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->course->open();
            $this->course->delete($id);
            $this->course->close();
        }

        header("location:index.php?page=courses");
        exit;
    }
}