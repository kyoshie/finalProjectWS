<?php
require_once 'connection.php';

$journal_id = isset($_GET['journal_id']) ? intval($_GET['journal_id']) : 0;

function fetch_articles($journal_id)
{
    global $connection;
    $sql = "SELECT * FROM articles WHERE journal_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $journal_id);
    $stmt->execute();
    return $stmt->get_result();
}

function delete_article($article_id)
{
    global $connection;
    $article_id = intval($article_id);
    $sql = "DELETE FROM articles WHERE article_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $article_id);
    if ($stmt->execute()) {
        header("Location: admin.php?journal_id=" . intval($_GET['journal_id']));
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

if (isset($_GET['delete_id'])) {
    delete_article($_GET['delete_id']);
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
                        <i class="fa-light fa-plus">Article</i>
                    </button>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="heading">
                    <h5>Article List</h5>
                </div>
                <div class="row">
                    <?php
                    $articles = fetch_articles($journal_id);
                    if (mysqli_num_rows($articles) > 0) {
                        while ($article = mysqli_fetch_assoc($articles)) {
                            if (!isset($article['article_id'])) {
                                echo '<div class="alert alert-warning">article_id not set for an article.</div>';
                                continue;
                            }
                            echo '<div class="col-md-4 mb-3">';
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($article['title']) . '</h5>';
                            echo '<p class="card-text">Authors: ' . htmlspecialchars($article['authors']) . '</p>';
                            echo '<p class="card-text">Keywords: ' . htmlspecialchars($article['keywords']) . '</p>';
                            echo '<a href="view_article.php?article_id=' . htmlspecialchars($article['article_id']) . '" class="btn btn-primary">View</a> ';
                            echo '<a href="view_journal.php?delete_id=' . htmlspecialchars($article['article_id']) . '&journal_id=' . $journal_id . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this article?\')">Delete</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-12">';
                        echo '<div class="alert alert-info" role="alert">No articles found.</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Article</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="article" name="articleForm" method="post" action="process.php"  enctype="multipart/form-data">
                                <div class="article-header">
                                    <h3 class="article-title">Article</h3>
                                </div>
                                <small>Put the information of the Article here!</small>
                                <div class="article-body">
                                    <div class="mb-3">
                                        <label class="form-label">Journal</label>
                                        <select class="form-select" name="journal_id" required>
                                            <?php
                                            $sql = "SELECT * FROM journals";
                                            $result = mysqli_query($connection, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . htmlspecialchars($row['journal_id']) . "'" . ($journal_id == $row['journal_id'] ? ' selected' : '') . ">" . htmlspecialchars($row['title']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Abstract</label>
                                        <textarea class="form-control" id="abstract" name="abstract" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Authors</label>
                                        <input type="text" class="form-control" id="authors" name="authors">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">References</label>
                                        <textarea class="form-control" id="ref" name="ref" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" class="form-control" id="keywords" name="keywords">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">PDF File</label>
                                        <input type="file" class="form-control" id="pdf_file" name="pdf_file">
                                    </div>
                                    <button type="submit" class="btn btn-secondary" name="article_submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin.js"></script>
</body>

</html>