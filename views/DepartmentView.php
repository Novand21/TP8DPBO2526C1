<?php

class DepartmentView
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
              <a class="navbar-brand" href="index.php?page=lecturers">Departments</a>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=lecturers">Lecturers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?page=departments">Departments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=courses">Courses</a>
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
        $this->header("Departments");
        $rows = "";
        foreach ($data as $row) {
            $rows .= "
            <tr>
              <th>{$row['id']}</th>
              <td>{$row['name']}</td>
              <td>{$row['faculty']}</td>
              <td>
                <a class='btn btn-success' href='index.php?page=departments&action=edit&id={$row['id']}'>Edit</a>
                <a class='btn btn-danger' href='index.php?page=departments&action=delete&id={$row['id']}'>Delete</a>
              </td>
            </tr>";
        }

        echo '
        <div class="container my-4">
          <div class="col-1 my-3">
            <a type="button" class="btn btn-primary nav-link active" href="index.php?page=departments&action=add">Add New</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>FACULTY</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <tbody>' . $rows . '</tbody>
          </table>
        </div>';
        $this->footer();
    }

    public function renderAdd()
    {
        $this->header("Create Department");
        echo '
        <div class="col-lg-6 m-auto">
          <form method="post" action="index.php?page=departments&action=add">
            <br><br>
            <div class="card">
              <div class="card-header bg-primary">
                <h1 class="text-white text-center">Create Department</h1>
              </div><br>

              <label> DEPARTMENT NAME: </label>
              <input type="text" name="name" class="form-control" required> <br>

              <label> FACULTY: </label>
              <input type="text" name="faculty" class="form-control" required> <br>

              <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
              <a class="btn btn-info" href="index.php?page=departments">Cancel</a><br>
            </div>
          </form>
        </div>';
        $this->footer();
    }

    public function renderEdit($data)
    {
        $this->header("Update Department");
        echo '
        <div class="col-lg-6 m-auto">
          <form method="post" action="index.php?page=departments&action=edit">
            <br><br>
            <div class="card">
              <div class="card-header bg-warning">
                <h1 class="text-white text-center">Update Department</h1>
              </div><br>

              <input type="hidden" name="id" value="' . $data['id'] . '" class="form-control"> <br>

              <label> DEPARTMENT NAME: </label>
              <input type="text" name="name" value="' . $data['name'] . '" class="form-control" required> <br>

              <label> FACULTY: </label>
              <input type="text" name="faculty" value="' . $data['faculty'] . '" class="form-control" required> <br>

              <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
              <a class="btn btn-info" href="index.php?page=departments">Cancel</a><br>
            </div>
          </form>
        </div>';
        $this->footer();
    }
}