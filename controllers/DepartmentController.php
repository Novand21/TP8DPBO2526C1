<?php

include_once("config.php");
include_once("models/Department.php");
include_once("views/DepartmentView.php");

class DepartmentController
{
    private $department;

    function __construct()
    {
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index()
    {
        $this->department->open();
        $this->department->getDepartment();

        $data = array();
        while ($row = $this->department->getResult()) {
            array_push($data, $row);
        }

        $this->department->close();

        $view = new DepartmentView();
        $view->render($data);
    }

    function add()
    {
        if (isset($_POST['submit'])) {
            $this->department->open();
            $this->department->add($_POST);
            $this->department->close();

            header("location:index.php?page=departments");
            exit;
        }

        $view = new DepartmentView();
        $view->renderAdd();
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            $this->department->open();
            $this->department->edit($_POST);
            $this->department->close();

            header("location:index.php?page=departments");
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->department->open();
            $this->department->getDepartmentById($id);
            $data = $this->department->getResult();
            $this->department->close();

            $view = new DepartmentView();
            $view->renderEdit($data);
        }
    }

    function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->department->open();
            $this->department->delete($id);
            $this->department->close();
        }

        header("location:index.php?page=departments");
        exit;
    }
}