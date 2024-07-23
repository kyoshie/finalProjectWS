<?php 
//for inserting into journal
function insert_journal($title, $date, $volume, $issue) {
    require_once "connection.php";

    $sql = "INSERT INTO journals (title, date, volume, issue)
            VALUES ('$title', '$date', '$volume', '$issue')";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: ";
    }
}

if (isset($_POST['submit'])) {
    if (empty($_POST['title']) || empty($_POST['date']) || empty($_POST['issue']) || empty($_POST['volume'])) {
        header('Location: admin.php');
        exit(); 
    } else {
        insert_journal($_POST['title'], $_POST['date'], $_POST['issue'], $_POST['volume']);
    }
}

//for article insertion
function insert_article($title, $abstract, $authors, $ref, $keywords, $journal_id ) {
    require_once "connection.php";

    $sql = "INSERT INTO articles (title, abstract, authors, ref, keywords, journal_id)
            VALUES ('$title', '$abstract', '$authors', '$ref', '$keywords',  '$journal_id')";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: ";
    }
}

if (isset($_POST['article_submit'])) {
    if (empty($_POST['title']) || empty($_POST['abstract']) || empty($_POST['authors']) || empty($_POST['ref'])|| empty($_POST['keywords'])) {
        header('Location: admin.php');
        exit(); 
    } else {
        insert_article($_POST['title'], $_POST['abstract'], $_POST['authors'], $_POST['ref'], $_POST['keywords'], $_POST['journal_id']);
    }
}



//for file submission through add article

if (isset($_POST['article_submit'])) {
    $article_id = intval($_POST['article_id']);
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $authors = $_POST['authors'];
    $ref = $_POST['ref'];
    $keywords = $_POST['keywords'];

    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileName = $_FILES['pdf_file']['name'];
        $fileSize = $_FILES['pdf_file']['size'];
        $fileType = $_FILES['pdf_file']['type'];
        $fileError = $_FILES['pdf_file']['error'];

  
        if ($fileError == UPLOAD_ERR_OK) {
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

       
            $allowedExts = array('pdf');
            if (in_array($fileExtension, $allowedExts)) {
  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $newFileName;

          
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
           
                    $sql = "UPDATE articles SET title = ?, abstract = ?, authors = ?, ref = ?, keywords = ?, pdf_file = ? WHERE article_id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("ssssssi", $title, $abstract, $authors, $ref, $keywords, $newFileName, $article_id);

                    if ($stmt->execute()) {
                        echo "Article updated successfully.";
                    } else {
                        echo "Database Error: " . $stmt->error;
                    }
                } else {
                    echo "Error moving the uploaded file.";
                }
            } else {
                echo "Unsupported file type.";
            }
        } else {
            echo "File upload error: " . $fileError;
        }
    } else {
        echo "No file was uploaded or there was an upload error.";
    }
} else {
    echo "Form not submitted.";
}

?>