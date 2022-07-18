<?php
include('config.php');
function insertRecord($name, $email, $phone, $address, $gender)
{
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['address'])
        || empty($_POST['phone'])
    ) {
        $_SESSION['all'] = "Please fill all the field";
        return false;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $_SESSION['all'] = "Invalid email";
        return false;
    }

    if (!preg_match("/^[a-zA-z ]*$/", $name)) {
        $_SESSION['all'] = "Name is invalid. Please enter alphabets only";
        return false;
    }

    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $_SESSION['all'] = "Phone number should be numeric and of 10 digit only";
        return false;
    }

    if (!preg_match("/^[a-zA-z ,]*$/", $address)) {
        $_SESSION['all'] = "Address is invalid. Please enter alphabets only";
        return false;
    }
    
    else {
        $sql = "INSERT INTO `student` (name, email, address, phone, gender) VALUES ('$name', '$email', '$address', '$phone', '$gender')";
        if ($GLOBALS['conn']->query($sql) == TRUE) 
        {
            $_SESSION['msg'] = "Data inserted successfully";
            header('location:index.php');
        } else {
            echo mysqli_error($GLOBALS['conn']);
        }
    }
}

function displayRecord()
{
    $sql = "SELECT * FROM `student`";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_object($result)) {
            $data[] = array(
                'id'=>$row->id,
                'name'=>$row->name,
                'email'=>$row->email,
                'address'=>$row->address,
                'phone'=>$row->phone,
                'gender'=>$row->gender
            );
        };
        return $data;
    } else {
        die(mysqli_error($GLOBALS['conn'])) ;
    }
}

function displayRecordById($updateid)
{
    $sql = "SELECT * FROM `student` WHERE id='$updateid'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result->num_rows == 1) {
        $row = mysqli_fetch_object($result);
        $data = array(
            'id'=>$row->id,
            'name'=>$row->name,
            'email'=>$row->email,
            'address'=>$row->address,
            'phone'=>$row->phone,
            'gender'=>$row->gender
        );
        return $data;
    } else {
       die(mysqli_error($GLOBALS['conn']));
    }
}

function updateRecord($id, $name, $email, $phone, $address, $gender)
{
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['address'])
        || empty($_POST['phone']) || empty($_POST['gender'])
    ) {
        $_SESSION['update'] = "All field required";
        return false;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
        $_SESSION['update'] = "Email format is invalid";
        return false;
    }

    if(!preg_match('/^[0-9]{10}+$/', $phone)) {
        $_SESSION['update'] = "Phone number should only contain numeric value";
        return false;
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $_SESSION['update'] = "Name is invalid";
        return false;  
    }

    if (!preg_match("/^[a-zA-z ,]*$/", $address)) {
        $_SESSION['update'] = "Address is invalid";
        return false;
    } else {
        $sql = "UPDATE `student` SET name='$name', email='$email', address='$address', phone='$phone', gender='$gender' WHERE id='$id'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $_SESSION['status'] = "Data updated successfully";
            header('location:index.php');
        } else {
            echo mysqli_error($GLOBALS['conn']);
        }
    }
}

function deleteRecord($deleteid)
{
    $sql = "DELETE FROM `student` WHERE id='$deleteid'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $_SESSION['del'] = "Data deleted successfully";
        header('location:index.php');
    } else {
        echo mysqli_error($GLOBALS['conn']);
    }
}