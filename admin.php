<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

    <link rel= "stylesheet" href="admin.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    
  </style>
</head>
<body>
  <div class="wrapper d-flex">

    <!--sidebar start -->
    <aside id="sidebar" class="bg-dark">
      <div class="icon d-flex align-items-center p-3">
      <img src="images/ub-logo.png">
        <div class="sidebar-logo ms-2">
          <a href="#" class="text-decoration-none text-white fs-5">Kalinangan</a>
        </div>
      </div>

      <ul class="nav flex-column">
        <li class="nav-item px-1">
          <a href="#" class=" journal nav-link">
            <i class="bi bi-journal-arrow-up"></i>
            <span>Journal</span>
          </a>
        </li>

        <li class="nav-item px-1">
          <a href="#" class=" nav-link">
            <i class="bi bi-box-arrow-left"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>

      
    </aside>
    <!--sidebar end -->

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg py-4 px-4">
            <button id="toggle-btn" class="btn btn-secondary">
                <i class="bi bi-grid"></i>
            </button>
        </nav>

        <main id="content" class="p-4 flex-grow-1">
            <h1>Dashboard</h1>
            <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="admin.js"></script>
</body>
</html>


