<?php
// Validate form inputs
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Save profile picture to server
    $uploads_dir = 'uploads/';
    $filename = uniqid() . '-' . $_FILES['profile_picture']['name'];
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploads_dir . $filename);
    
    // Add current date and time to filename
    $datetime = date('Y-m-d H:i:s');
    $new_filename = $datetime . '_' . $filename;
    rename($uploads_dir . $filename, $uploads_dir . $new_filename);
    
    // Save user data to CSV file
    $data = array($name, $email, $new_filename);
    $fp = fopen('users.csv', 'a');
    fputcsv($fp, $data);
    fclose($fp);
    
    // Start session and set cookie with user's name
    session_start();
    $_SESSION['name'] = $name;
    setcookie('name', $name, time() + 3600, '/');
    
    header('Location: view-users.php');
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
                    <input type="text" id="name"class="form-control" name="name" required><br><br>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email"class="form-control" name="email" required><br><br>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password"class="form-control" name="password" required><br><br>
                    
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture"class="form-control" name="profile_picture" required><br><br>
                    
                    <input type="submit"class="form-control btn btn-success" value="Register">
                </form>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</body>
</html>
