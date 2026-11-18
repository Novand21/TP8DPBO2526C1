<?php

class CourseView
{
    private function header($title)
    {
        echo '<!doctype html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="bootstrap.min.css" rel="stylesheet">
          <title>' . $title . '</title>
        </head>
        <body>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.php?page=lecturers">Courses</a>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=lecturers">Lecturers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=departments">Departments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?page=courses">Courses</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>';
    }

    private function footer()
    {
        echo '<script src="bootstrap.bundle.min.js"></script>
        </body>
        </html>';
    }

    public function render($data)
    {
        $this->header("Courses");
        $rows = "";
        foreach ($data as $row) {
            $lecturerName = $row['lecturer_name'] ?? '-';
            $rows .= "
            <tr>
              <th>{$row['id']}</th>
              <td>{$row['course_code']}</td>
              <td>{$row['course_name']}</td>
              <td>{$row['credits']}</td>
              <td>{$lecturerName}</td>
              <td>
                <a class='btn btn-success' href='index.php?page=courses&action=edit&id={$row['id']}'>Edit</a>
                <a class='btn btn-danger' href='index.php?page=courses&action=delete&id={$row['id']}'>Delete</a>
              </td>
            </tr>";
        }

        echo '
        <div class="container my-4">
          <div class="col-1 my-3">
            <a type="button" class="btn btn-primary nav-link active" href="index.php?page=courses&action=add">Add New</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>COURSE CODE</th>
                <th>COURSE NAME</th>
                <th>CREDITS</th>
                <th>LECTURER</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <tbody>' . $rows . '</tbody>
          </table>
        </div>';
        $this->footer();
    }

    public function renderAdd($lecturers)
    {
        $this->header("Create Course");
        $options = '<option value="">-- Select Lecturer --</option>';
        foreach ($lecturers as $lec) {
            $options .= "<option value='{$lec['id']}'>{$lec['name']}</option>";
        }

        echo '
        <div class="col-lg-6 m-auto">
          <form method="post" action="index.php?page=courses&action=add">
            <br><br>
            <div class="card">
              <div class="card-header bg-primary">
                <h1 class="text-white text-center">Create Course</h1>
              </div><br>

              <label> COURSE CODE: </label>
              <input type="text" name="course_code" class="form-control" required> <br>

              <label> COURSE NAME: </label>
              <input type="text" name="course_name" class="form-control" required> <br>

              <label> CREDITS: </label>
              <input type="number" name="credits" class="form-control" required> <br>

              <label> LECTURER: </label>
              <select name="lecturer_id" class="form-control">' . $options . '</select> <br>

              <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
              <a class="btn btn-info" href="index.php?page=courses">Cancel</a><br>
            </div>
          </form>
        </div>';
        $this->footer();
    }

    public function renderEdit($data, $lecturers)
    {
        $this->header("Update Course");
        $options = '<option value="">-- Select Lecturer --</option>';
        foreach ($lecturers as $lec) {
            $selected = ($data['lecturer_id'] == $lec['id']) ? 'selected' : '';
            $options .= "<option value='{$lec['id']}' $selected>{$lec['name']}</option>";
        }

        echo '
        <div class="col-lg-6 m-auto">
          <form method="post" action="index.php?page=courses&action=edit">
            <br><br>
            <div class="card">
              <div class="card-header bg-warning">
                <h1 class="text-white text-center">Update Course</h1>
              </div><br>

              <input type="hidden" name="id" value="' . $data['id'] . '" class="form-control"> <br>

              <label> COURSE CODE: </label>
              <input type="text" name="course_code" value="' . $data['course_code'] . '" class="form-control" required> <br>

              <label> COURSE NAME: </label>
              <input type="text" name="course_name" value="' . $data['course_name'] . '" class="form-control" required> <br>

              <label> CREDITS: </label>
              <input type="number" name="credits" value="' . $data['credits'] . '" class="form-control" required> <br>

              <label> LECTURER: </label>
              <select name="lecturer_id" class="form-control">' . $options . '</select> <br>

              <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
              <a class="btn btn-info" href="index.php?page=courses">Cancel</a><br>
            </div>
          </form>
        </div>';
        $this->footer();
    }
}