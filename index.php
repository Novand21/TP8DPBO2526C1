<?php

include_once("controllers/LecturerController.php");
include_once("controllers/DepartmentController.php");
include_once("controllers/CourseController.php");

$page = $_GET['page'] ?? 'lecturers';
$action = $_GET['action'] ?? 'index';

if ($page === 'departments') {
    $controller = new DepartmentController();
} elseif ($page === 'courses') {
    $controller = new CourseController();
} else {
    $controller = new LecturerController();
}

if ($action === 'add') {
    $controller->add();
} elseif ($action === 'edit') {
    $controller->edit();
} elseif ($action === 'delete') {
    $controller->delete();
} else {
    $controller->index();
}