<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php if (isset($_SESSION['message'])): ?>
    
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?> 
    </div>
    <?php endif ?>

    <div class="container">
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
            // pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()):  ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                            class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                            class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>

        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                    <?php
                        if ($update == true):
                    ?>
                        <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else: ?>
                        <button class="btn btn-primary" type="submit" name="save">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>