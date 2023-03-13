
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class='table table-striped table-dark'>
                <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User-Photo <a class="btn btn-danger float-right"href="index.php">back</a></th>
                    </tr>
                <?php
                    $file = fopen('users.csv', 'r');
                    while (($data = fgetcsv($file)) !== false) { ?>
                         <tr>
                         <?Php  foreach ($data as $cell) { ?>
                            <td><?php echo htmlspecialchars($cell);?></td>
                      <?php  } ?>
                        </tr>
                     <?php  }  fclose($file); ?>
                  
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>
</html>
