<?php
session_start();
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    if ( empty( $name ) || empty( $email ) || empty( $password ) ) {
        die( "Error: All fields are required." );
    }
    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        die( "Error: Invalid email format." );
    }
    if ( isset( $_FILES["profile_pic"] ) ) {
        $target_dir = "uploads/";
        $target_file = $target_dir . date( "YmdHis" ) . "_" . basename( $_FILES["profile_pic"]["name"] );
        if ( move_uploaded_file( $_FILES["profile_pic"]["tmp_name"], $target_file ) ) {
            $file = fopen( "users.csv", "a" );
            fputcsv( $file, array( $name, $email, $target_file ) );
            fclose( $file );
            setcookie( "username", $name, time() + 86400 );
            header( "Location: view-users.php" );
            exit();
        } else {
            die( "Error: Failed to upload profile picture." );
        }
    } else {
        die( "Error: Profile picture is required." );
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <label for="name">Name:</label>
                    <input type="text" id="name"class="form-control" name="name"placeholder="your name" required><br>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email"class="form-control" name="email"placeholder="your email" required><br>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password"class="form-control" name="password" placeholder="your password" required><br>
                    
                    <label for="profile_pic">Profile Picture:</label>
                    <input type="file" id="profile_pic"class="form-control" name="profile_pic" required><br>
                    
                    <input type="submit"class="form-control btn btn-success" value="Register">
                </form>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</body>
</html>
