<?php

class LecturerView
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
              <a class="navbar-brand" href="index.php?page=lecturers">Lecturers</a>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?page=lecturers">Lecturers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?page=departments">Departments</a>
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
        $this->header("Home");
        $rows = "";
        foreach ($data as $row) {
            $deptName = $row['department_name'] ?? '-';
            $rows .= "
            <tr>
              <th>{$row['id']}</th>
              <td>{$row['name']}</td>
              <td>{$row['nidn']}</td>
              <td>{$row['phone']}</td>
              <td>{$row['join_date']}</td>
              <td>{$deptName}</td>
              <td>
                <a class='btn btn-success' href='index.php?page=lecturers&action=edit&id={$row['id']}'>Edit</a>
                <a class='btn btn-danger' href='index.php?page=lecturers&action=delete&id={$row['id']}'>Delete</a>
              </td>
            </tr>";
        }

        echo '
        <div class="container my-4">
          <div class="col-1 my-3">
            <a type="button" class="btn btn-primary nav-link active" href="index.php?page=lecturers&action=add">Add New</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>NIDN</th>
                <th>PHONE</th>
                <th>JOIN DATE</th>
                <th>DEPARTMENT</th>
                <th>ACTIONS</th>
              </tr>
            </thead>
            <tbody>' . $rows . '</tbody>
          </table>
        </div>';
        $this->footer();
    }

    public function renderAdd($departments)
    {
        $this->header("Create");
        $options = '<option value="">-- Select Department --</option>';
        foreach ($departments as $dept) {
            $options .= "<option value='{$dept['id']}'>{$dept['name']}</option>";
        }

        echo '
        <div class="col-lg-6 m-auto">
          <form method="post" action="index.php?page=lecturers&action=add">
            <br><br>
            <div class="card">
              <div class="card-header bg-primary">
                <h1 class="text-white text-center">Create Lecturer</h1>
              </div><br>

              <label> NAME: </label>
              <input type="text" name="name" class="form-control" required> <br>

              <label> NIDN: </label>
              <input type="text" name="nidn" class="form-control" required> <br>

              <label> PHONE: </label>
              <input type="text" name="phone" class="form-control" required> <br>

              <label> JOIN DATE: </label>
              <input type="date" name="join_date" class="form-control" required> <br>

              <label> DEPARTMENT: </label>
              <select name="department_id" class="form-control">' . $options . '</select> <br>

              <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
              <a class="btn btn-info" href="index.php?page=lecturers">Cancel</a><br>
            </div>
          </form>
        </div>';
        $this->footer();
    }

    public function renderEdit($data, $departments)
    {
        $this->header("Ubah");
        $options = '<option value="">-- Select Department --</option>';
        foreach ($departments as $dept) {
            $selected = ($data['department_id'] == $dept['id']) ? 'selected' : '';
            $options .= "<option value='{$dept['id']}' $selected>{$dept['name']}</option>";
        }

        echo '
        <div class="col-lg-6 m-auto">
          <form method="post" action="index.php?page=lecturers&action=edit">
            <br><br>
            <div class="card">
              <div class="card-header bg-warning">
                <h1 class="text-white text-center">Update Lecturer</h1>
              </div><br>

              <input type="hidden" name="id" value="' . $data['id'] . '" class="form-control"> <br>

              <label> NAME: </label>
              <input type="text" name="name" value="' . $data['name'] . '" class="form-control" required> <br>

              <label> NIDN: </label>
              <input type="text" name="nidn" value="' . $data['nidn'] . '" class="form-control" required> <br>

              <label> PHONE: </label>
              <input type="text" name="phone" value="' . $data['phone'] . '" class="form-control" required> <br>

              <label> JOIN DATE: </label>
              <input type="date" name="join_date" value="' . $data['join_date'] . '" class="form-control" required> <br>

              <label> DEPARTMENT: </label>
              <select name="department_id" class="form-control">' . $options . '</select> <br>

              <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
              <a class="btn btn-info" href="index.php?page=lecturers">Cancel</a><br>
            </div>
          </form>
        </div>';
        $this->footer();
    }
}