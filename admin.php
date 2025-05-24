<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <h2 class="text-center mb-4">Admin Panel</h2>
  <td><button onclick='window.location.href = "http://127.0.0.1/edsa-project/"' class='btn btn-sm btn-primary edit-btn'>Back</button></td>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="adminTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="feedback-tab" data-bs-toggle="tab" data-bs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="false">Feedback</button>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content mt-3">
    
    <!-- Users Tab -->
    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>id</th>
              <th>login</th>
              <th>email</th>
              <th>rola</th>
              <th>act_status</th>
            </tr>
          </thead>
          <?php
          include_once 'functions/admin/adminpanel.php';
          use data\adminPanel;
          $admin = new adminPanel();
          
           $admin->getUserInfo();
          ?>
        </table>
      </div>
    </div>

    <!-- Feedback Tab -->
    <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Message</th>
              <th>ButtonLink</th>
              <th>Client Role</th>
              <th>Image Source</th>
            </tr>
          </thead>
          <?php
           $admin->getFeedback();
          ?>
        </table>
      </div>
    </div>

  </div>
</div>

<script src="js/ajax_script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
