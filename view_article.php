<?php
require_once 'connection.php';

$article_id = isset($_GET['article_id']) ? intval($_GET['article_id']) : 0;

function fetch_article($article_id) {
    global $connection;
    $sql = "SELECT * FROM articles WHERE article_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

if ($article_id > 0) {
    $article = fetch_article($article_id);
    if (!$article) {
        die('Article not found.');
    }
} else {
    die('Invalid article ID.');
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
            </nav>

            <div class="container-fluid">
                <div class="heading">
                    <h5>Article List</h5>
                </div>
                <div class="row">
                    <?php if ($article_id > 0 && $article) : ?>
                        <form name="updateArticleForm" method="post" action="update_article.php" enctype="multipart/form-data">
                            <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($article_id); ?>">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($article['title'] ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Abstract</label>
                                <textarea class="form-control" id="abstract" name="abstract"><?php echo htmlspecialchars($article['abstract'] ?? ''); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Authors</label>
                                <input type="text" class="form-control" id="authors" name="authors" value="<?php echo htmlspecialchars($article['authors'] ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">References</label>
                                <textarea class="form-control" id="ref" name="ref"><?php echo htmlspecialchars($article['ref'] ?? ''); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keywords</label>
                                <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo htmlspecialchars($article['keywords'] ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">PDF File</label>
                                <input type="file" class="form-control" id="pdf_file" name="pdf_file">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='admin.php'">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                            </div>
                        </form>
                    <?php else : ?>
                        <p>No article available to edit.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="admin.js"></script>
    </div>
</body>

</html>
