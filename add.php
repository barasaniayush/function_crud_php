<?php
session_start();
include 'controller.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $dob = $_POST['dob'];
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    insertRecord($name, $email, $dob, $phone, $address, $gender);
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $dob = $_POST['dob'];
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $id = $_POST['hid'];
    updateRecord($id, $name, $email, $dob, $phone, $address, $gender);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <nav class="navbar bg-dark">
        <form class="container-fluid justify-content-start">
            <a href="index.php"><button class="btn btn-success mx-5" type="button">Return Home</button></a>
        </form>
    </nav>
    <div class="container my-5">
        <?php
        if (isset($_GET['updateid'])) {
            $updateid = $_GET['updateid'];
            $myrecord = displayRecordById($updateid);
        ?>
            <h3 class="my-3">Update Record</h3>
            <?php
            if(isset($_SESSION['update'])) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                '.$_SESSION['update'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            unset($_SESSION['update']);
            }
            ?>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $myrecord['name']; ?>" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $myrecord['email']; ?>" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="">Date of Birth</label>
                    <input type="date" name="dob" id="dob" value="<?php echo $myrecord['dob']; ?>" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo $myrecord['address']; ?>" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $myrecord['phone']; ?>" class="form-control"><br>
                </div>
                <div class="form-group">                    
                    <label for="">Gender:</label>
                    <input type="radio" name="gender" value="male" id="male" <?php echo($myrecord['gender']=='female')?"male":"checked"; ?>> Male
                    <input type="radio" name="gender" id="female" value="female" <?php echo($myrecord['gender']=='male')?"female":"checked"; ?>> Female<br><br>
                </div>
                <div class="form-group">
                    <input type="hidden" name="hid" value="<?php echo $myrecord['id']; ?>">
                    <input type="submit" value="Update" name="update" id="update" class="btn btn-primary">
                </div>
            </form>
        <?php
        } else {
        ?>
            <h3 class="my-5">Add New User</h3>
            <form action="#" method="post">
                <?php
                    if (isset($_SESSION['all'])) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    '.$_SESSION['all'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['all']);
                    }
                ?>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Full Name"><br>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email Address "><br>
                </div>
                <div class="form-group">
                    <label for="">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter address"><br>
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number"><br>
                </div>
                <div class="form-group">
                    <label for="">Gender:</label>
                    <input type="radio" name="gender" value="Male" id="male" checked> Male
                    <input type="radio" name="gender" value="Female" id="female"> Female<br><br>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" name="submit" id="name" class="btn btn-primary">
                </div>
            </form>
        <?php } ?><br>
    </div>
</body>
</html>