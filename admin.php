<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin.css" />
</head>
<body>
  <div class="d-flex" id="wrapper">
  
  <!--Sidebar Start -->
    <div class="side" id="sidebar-wrapper">

      <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
        <img src="images/ub-logo.png" alt="logo"> Kalinangan
      </div>

      <div class="list-group list-group-flush my-3">
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
          <i class="fa-solid fa-book"></i>Journal
        </a>

        <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
          <i class="fas fa-project-diagram me-2"></i>Logout
        </a>

      </div>

    </div>
  <!--Sidebar end -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">

        <div class="d-flex align-items-center">
          <i class="fas fa-align-left primaryt-text fs-4 me-3" id="menu-toggle"></i>
          <h2 class="fs-4 m-0">Dashboard</h2>
        </div>
      </nav>

      <div class="container-fluid px-3">

        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
          <div>
              <h3 class="fs-2">720</h3>
              <p class="fs-5">Products</p>
          </div>
          <i class="fa-solid fa-users primary-text border rounded-full secondary-bg p-3"></i> 
        </div>

        <!-- Journal Start-->
        <div class="p-3 shadow-sm d-flex justify-content-start align-items-center rounded ">
            <form class ="journal" method="post" action="process.php" >
              <div class="journal-header"> 
                <h3 class ="journal-title">Journal</h3>
                <br>
                <br>
              </div>
              <small>Put the contents of the journal here!</small>
                <div class="journal-body">
                  <div class= "mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Issue</label>
                          <input type="number" class="form-control" id="issue" name="issue">
                      </div>
                    </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Volume</label>
                        <input type="number" class="form-control" id="volume" name="volume">
                    </div>
                  </div>
                      </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
              </form>
          </div>
        </div>

      </div>
    </div>
  </div>                    





  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="admin.js"></script>
</body>
</html>


