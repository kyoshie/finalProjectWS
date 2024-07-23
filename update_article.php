<?php
//for updating the article
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $article_id = isset($_POST['article_id']) ? intval($_POST['article_id']) : 0;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $abstract = isset($_POST['abstract']) ? $_POST['abstract'] : '';
    $authors = isset($_POST['authors']) ? $_POST['authors'] : '';
    $ref = isset($_POST['ref']) ? $_POST['ref'] : '';
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';

    $pdf_file_path = '';

    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $pdf_file_path = $upload_dir . basename($_FILES['pdf_file']['name']);
        if (!move_uploaded_file($_FILES['pdf_file']['tmp_name'], $pdf_file_path)) {
            die('Error uploading file.');
        }
    }

    $sql = "UPDATE articles SET title = ?, abstract = ?, authors = ?, ref = ?, keywords = ?, pdf_file = ? WHERE article_id = ?";
    $stmt = $connection->prepare($sql);

    if (!$stmt) {
        die('Error preparing statement: ' . $connection->error);
    }

    $stmt->bind_param("ssssssi", $title, $abstract, $authors, $ref, $keywords, $pdf_file_path, $article_id);

    if (!$stmt->execute()) {
        die('Error executing statement: ' . $stmt->error);
    }

    $stmt->close();

 
    header('Location: view_article.php?article_id=' . $article_id);
    exit;
}
?>
