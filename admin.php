<?php
require_once 'connection.php';
function fetch_journals()
{
  global $connection;
  $sql = "SELECT * FROM journals";
  $result = mysqli_query($connection, $sql);

  if (!$result) {
    die("Error fetching journals: " . mysqli_error($connection));
  }

  return $result;
}


function delete_journal($journal_id)
{
    global $connection;

    $sql = "DELETE FROM journals WHERE journal_id = ?";
    $request = $connection->prepare($sql);
    $request->bind_param("i", $journal_id);

    if (!$request->execute()) {
        die('Error deleting journal: ' . $request->error);
    }

    $request->close();
}

if (isset($_GET['delete_journal_id'])) {
    $journal_id = intval($_GET['delete_journal_id']);
    delete_journal($journal_id);
    header('Location: admin.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/admin.css" />
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar Start -->
    <div class="side" id="sidebar-wrapper">
      <a href="admin.php" class="brand-link">
        <img src="images/ub-logo.png" alt="AdminLTE Logo" class="brand-image img-circle">
        <span class="brand-text font-weight-heavy">Kalinangan</span>
      </a>

      <div class="list-group list-group-flush my-3">
        <a href="admin.php" class="list-group-item list-group-item-action bg-transparent second-text active">
          <i class="fa-solid fa-book"></i>Journal
        </a>

        <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
          <i class="fas fa-project-diagram me-2"></i>Logout
        </a>
      </div>
    </div>
    <!-- Sidebar end -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
          <i class="fas fa-align-left primaryt-text fs-4 me-3" id="menu-toggle"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Dashboard</h2>
        </div>
        <div class="ms-auto">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
            <i class="fa-light fa-plus">Journal</i>
          </button>
        </div>
      </nav>
      <div class="container-fluid">
        <div class="heading">
          <h5>Journal List</h5>
        </div>
        <div class="row">
          <?php
          require_once 'connection.php';
          $journals = fetch_journals();
          if (mysqli_num_rows($journals) > 0) {
            while ($journal = mysqli_fetch_assoc($journals)) {
              echo '<div class="col-md-3 mb-3">';
              echo '<div class="card">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . htmlspecialchars($journal['title']) . '</h5>';
              echo '<p class="card-text">Date: ' . htmlspecialchars($journal['date']) . '</p>';
              echo '<p class="card-text">Volume: ' . htmlspecialchars($journal['volume']) . '</p>';
              echo '<p class="card-text">Issue: ' . htmlspecialchars($journal['issue']) . '</p>';
              echo '<a href="view_journal.php?journal_id=' . htmlspecialchars($journal['journal_id']) . '" class="btn btn-primary">View</a> ';
              echo '<a href="admin.php?delete_journal_id=' . htmlspecialchars($journal['journal_id']) . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this journal?\')">Delete</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          } else {
            echo '<div class="col-12">';
            echo '<div class="alert alert-info" role="alert">No journals found.</div>';
            echo '</div>';
          }
          ?>
        </div>
      </div>

      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <form name="journalForm" method="post" action="process.php" onsubmit="return validateForm()">
                <div class="journal-header">
                  <h3 class="journal-title">Journal</h3>
                </div>
                <small>Put the informations of the journal here!</small>
                <div class="journal-body">
                  <div class="mb-3">
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
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary " name="submit">Save changes</button>
                  </div>
              </form>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="admin.js"></script>
  <script src="validation/jvalidation.js"></script>
</body>

</html>