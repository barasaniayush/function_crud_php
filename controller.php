<?php    
function insertRecord()
{
    include('config.php');
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $dob = $_POST['dob'];
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['dob'])
        || empty($_POST['phone']) || empty($_POST['gender'])
    ) {
        $nameErr = "Please fill all the field";
        return false;
    }
    
    if (filter_var($email, FILTER_SANITIZE_EMAIL) == FALSE) {
        $emailErr = "Email format is invalid";
        return false;
    }

    if (!preg_match("/^[a-zA-z ]*$/", $name)) {
        $nameErr = "Name is invalid";
        return false;
    }

    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $phoneErr = "Only number allowed";
        return false;
    }

    if (!preg_match("/^[a-zA-z ]*$/", $address)) {
        $addressErr = "Address is invalid";
        return false;
    }
    
    
    else {
        $sql = "INSERT INTO `student` (name, email, dob, address, phone, gender) VALUES ('$name', '$email', '$dob', '$address', '$phone', '$gender')";
        if ($conn->query($sql) == TRUE) 
        {
            $_SESSION['status'] = "Data inserted successfully";
            header('location:index.php');
        } else {
            echo "Error inserting data";
        }
    }
}

function displayRecord()
{
    include('config.php');
    $sql = "SELECT * FROM `student`";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function displayRecordById($updateid)
{
    include('config.php');
    $sql = "SELECT * FROM `student` WHERE id='$updateid'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row;
    }
}

function updateRecord($id)
{
    include('config.php');
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $dob = $_POST['dob'];
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $editid = $_POST['hid'];

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['dob'])
        || empty($_POST['phone']) || empty($_POST['gender'])
    ) {
        $errMsg = "Please fill all the field";
        return false;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $emailErr = "Email format is invalid";
        return false;
    }

    if(!preg_match('/^[0-9]{10}+$/', $phone)) {
        $phoneErr = "Only number allowed";
        return false;
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr =  "Only alphabets allowed";
        return false;  
    }

    if (!preg_match("/^[0-9]*$/", $phone)) {
        $phoneErr = "Only number allowed";
        return false;
    }

    if(!isset($_POST["gender"])){
        $error = $error . "empty gender <br/>";
    }
    else{
        $gender = $_POST["gender"];
        if ($gender == "Male"){
            $Mchecked = "checked";
        }
        else if ($gender == "Female"){
            $Fchecked = "checked";
        }
    }

    if (!preg_match("/^[a-zA-z ]*$/", $address)) {
        $addressErr = "Only address allowed";
        return false;
    } else {
        $sql = "UPDATE `student` SET name='$name', email='$email', dob='$dob', address='$address', phone='$phone', gender='$gender' WHERE id='$editid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['status'] = "Data updated successfully";
            header('location:index.php');
        } else {
            header('location:index.php');
        }
    }
}

function deleteRecord($deleteid)
{
    include('config.php');
    $sql = "DELETE FROM `student` WHERE id='$deleteid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['status'] = "Data deleted successfully";
        header('location:index.php');
    } else {
        echo "Error";
    }
}