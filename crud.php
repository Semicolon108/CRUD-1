<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
    *{
        padding: 0;
        margin: 0;
    }
    table{
        margin: 50px;
    }
    .first{
        background: silver;
        width: 300px;
        padding: 20px;
        border-radius: 10px;

    }
    input{
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 10px;
        width: 100%;
    }
    .cent{
        display: flex;
        justify-content: center;
        
    }
    button{
        width: 30%;
        border-radius: 10px;
        padding: 5px;
    }
    
    </style>
</head>
<body>
<?php require_once 'connection.php';?>
<?php
if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
</div>
<?php endif; ?>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'crud1') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM tb_crud1") or die($mysqli->error);
//pre_r($result);
//pre_r($result->fetch_assoc());
//pre_r($result->fetch_assoc());
?>
<div class="row justify-content-center">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>gender</th>
                <th>permanent location</th>
                <th colspan="2">Action</th>
            <tr>
    </thead>  
    <?php
    while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['location']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['permanent_location']; ?></td>
        <td>
            <a href= "crud.php?edit=<?php echo $row['id']; ?>"
            class ="btn btn-info">Edit</a>
            <a href= "crud.php?delete=<?php echo $row['id']; ?>"
            class ="btn btn-danger">Delete</a>
        </td>
    </tr>
    <?php endwhile;?>
    </table>

</div>
<?php
function pre_r($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>

<div class="cent">
    <form action="connection.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="first">
    <div>
    <label for="">Name</label><br>
    <input type="text" name="name" value= "<?php echo $name; ?>" placeholder="enter your name">
    </div>
    <div>
    <label for="">Location</label><br>
    <input type="text" name="location" value= "<?php echo $location; ?>" placeholder="enter your location">
    </div>
    <div>
    <label for="">Gender</label><br>
    <input type="radio" name="gender" value= "male">
    <input type="radio" name="gender" value= "female">
    </div>
    <div>
    <label for="">Permanent location</label><br>
    <input type="checkbox" name="nigeria" value= "<?php echo $Nigeria; ?>">
    <input type="checkbox" name="china" value= "<?php echo $China; ?>">
    </div>
    <div>
    <?php
    if ($update == true):
        ?>
       <button type="submit" name="update">Update</button> 
    <?php else: ?> 
    <button type="submit" name="save">Send</button>
    <?php endif; ?>
    </div>
    </div>
    </form>
    <div>

</body>
</html>