<?php

function insertRecord()
{
    include('config.php');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    if (!preg_match("/^[a-zA-z]*$/", $name)) {
        echo "Only alphabets allowed";
    }

    if (!preg_match("/^[0-9]*$/", $phone)) {
        echo "Only number allowed";
    }

    if (!preg_match("/^[a-zA-z]*$/", $address)) {
        echo "Only address allowed";
    } else {
        $sql = "INSERT INTO `student` (name, email, address, phone, gender) VALUES ('$name', '$email', '$address', '$phone', '$gender')";
        if ($conn->query($sql) == TRUE) {
            // header('location:index.php');
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
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $editid = $_POST['hid'];

    if (!preg_match("/^[a-zA-z]*$/", $name)) {
        echo "Only alphabets allowed";
    }

    if (!preg_match("/^[0-9]*$/", $phone)) {
        echo "Only number allowed";
    }

    if (!preg_match("/^[a-zA-z]*$/", $address)) {
        echo "Only address allowed";
    } else {
        $sql = "UPDATE `student` SET name='$name', email='$email', address='$address', phone='$phone', gender='$gender' WHERE id='$editid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location:index.php');
        } else {
            echo "Error";
        }
    }
}

function deleteRecord($deleteid)
{
    include('config.php');
    $sql = "DELETE FROM `student` WHERE id='$deleteid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('location:index.php');
    } else {
        echo "Error";
    }
}
