<?php

include_once("config.php");
include_once("models/Lecturer.php");
include_once("models/Department.php");
include_once("views/LecturerView.php");

class LecturerController
{
    private $lecturer;
    private $department;

    function __construct()
    {
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index()
    {
        $this->lecturer->open();
        $this->lecturer->getLecturer();

        $data = array();
        while ($row = $this->lecturer->getResult()) {
            array_push($data, $row);
        }

        $this->lecturer->close();

        $view = new LecturerView();
        $view->render($data);
    }

    function add()
    {
        if (isset($_POST['submit'])) {
            $this->lecturer->open();
            $this->lecturer->add($_POST);
            $this->lecturer->close();

            header("location:index.php?page=lecturers");
            exit;
        }

        $this->department->open();
        $this->department->getDepartment();
        $departments = array();
        while ($row = $this->department->getResult()) {
            array_push($departments, $row);
        }
        $this->department->close();

        $view = new LecturerView();
        $view->renderAdd($departments);
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            $this->lecturer->open();
            $this->lecturer->edit($_POST);
            $this->lecturer->close();

            header("location:index.php?page=lecturers");
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->lecturer->open();
            $this->lecturer->getLecturerById($id);
            $data = $this->lecturer->getResult();
            $this->lecturer->close();

            $this->department->open();
            $this->department->getDepartment();
            $departments = array();
            while ($row = $this->department->getResult()) {
                array_push($departments, $row);
            }
            $this->department->close();

            $view = new LecturerView();
            $view->renderEdit($data, $departments);
        }
    }

    function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->lecturer->open();
            $this->lecturer->delete($id);
            $this->lecturer->close();
        }

        header("location:index.php?page=lecturers");
        exit;
    }
}