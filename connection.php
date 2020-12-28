<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'crud1') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';
$gender = '';
$permanent_location = '';
if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $gender = $_POST['gender'];
    
    

    if ($name != '' & $location != ''){

    $mysqli->query("INSERT INTO tb_crud1 (name, location) VALUES('$name', '$location', '$gender', '$permanent_location')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: crud.php");
    }
    else{
        $_SESSION['message'] = "Sorry, the inputs cannot be empty!";
        $_SESSION['msg_type'] = "primary";
        header("location: crud.php");
    }
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
     $mysqli->query("DELETE FROM tb_crud1 WHERE id=$id") or die ($mysqli->error());
     
     $_SESSION['message'] = "Record has been deleted!";
     $_SESSION['msg_type'] = "danger";
     header("location: crud.php");
    }

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tb_crud1 WHERE id=$id") or die ($mysqli->error());
    if (mysqli_num_rows($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        $gender = $row['gender'];
        
    }
}
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE tb_crud1 SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error)
;

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header("location: crud.php");
}