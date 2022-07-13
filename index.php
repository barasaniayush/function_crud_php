<?php
include('controller.php');
if (isset($_POST['update'])) {
    updateRecord($id);
}

if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];
    deleteRecord($deleteid);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <nav class="navbar bg-dark">
        <form class="container-fluid justify-content-start">
        <a href="add.php"><button class="btn btn-success" type="button">Add New Student</button></a>
        </form>
    </nav>
    <div class="container">
        <h3 class="text-center my-3">List of Students</h3>
        <table class="table table-dark table-striped">
            <tr class="text-center">
                <td>S.N.</td>
                <td>Name</td>
                <td>Email</td>
                <td>Address</td>
                <td>Phone number</td>
                <td>Gender</td>
                <td>Action</td>
            </tr>
            <?php
            $select = displayRecord();
            while ($data = mysqli_fetch_array($select)) {
            ?>
                <tr class="text-center">
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['address']; ?></td>
                    <td><?php echo $data['phone']; ?></td>
                    <td><?php echo $data['gender']; ?></td>
                    <td><a href="add.php?updateid=<?php echo $data['id']; ?>"><button class="btn btn-success">Edit</button></a>
                        <a href="index.php?deleteid=<?php echo $data['id']; ?>"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>