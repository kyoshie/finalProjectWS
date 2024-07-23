<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Register</title>
</head>
<body>
    <section class="vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-8 col-10 mx-auto rounded-3">
                    <div class="container-fluid bg-white text-dark rounded p-5 shadow">
                        <div class="logo-container">
                            <img src="images/logo-login.png" alt="Logo">
                        </div>
                        <form action="" method="post" name="login">
                            <div class="form-container">
                                <input type="text" class="form-control" name="studentNo" placeholder="Student Number" required>
                            </div>
                            <div class="form-container">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="both-container">
                                <input type="checkbox" name="rememberMe" id="rememberMe">
                                <label for="rememberMe">Remember me</label>
                            
                            
                                <a href="#">Forgot password?</a>
                            </div>
                            <div class="submit-container">
                                <input type="submit" class="btn btn-primary" value="Login" name="login_btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>