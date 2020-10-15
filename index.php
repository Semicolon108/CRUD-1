<?php
// Database Connection
    require_once("dbconnection.php");
    //$detailID = $_REQUEST["edit"]
?>

<?php
// This Code gets record by id from the database
    $update = false;
    if (isset( $_REQUEST["edit"])) {
        $detailsID = $_REQUEST["edit"];
        $update = true;
        $result_edit = $db_register->query("SELECT id, full_name, email_id, phone_no, address FROM tb_users WHERE id = $detailsID");
        $row_edit = $result_edit->fetch_assoc();
    }
?>

<?php
// This code deletes from the database
    if (isset( $_REQUEST["del"])) {
        $detailsID = $_REQUEST["del"];
        $result_delete = $db_register->query("DELETE FROM tb_users WHERE id = $detailsID");
        header("Location: index.php");
    }
?>

<?php
// This code Fetches all data from the database
    $result_details = $db_register->query("SELECT id, full_name, email_id, phone_no, address FROM tb_users");
    $row_details = $result_details->fetch_assoc();
?>
<?php 
// This code Create data into the database
   if (isset($_POST["textSubmit"])) {

       $id = mt_rand(00000000000, 99999999999);
       $fullName = $_POST["textFullName"];
       $emailId = $_POST["textEmailId"];
       $phoneNo = $_POST["textPhoneNo"];
       $address = $_POST["textAddress"];
    
   
        $insert_details = "INSERT INTO tb_users(id, full_name, email_id, phone_no, address ) VALUES ('$id', '$fullName','$emailId', '$phoneNo', '$address' )";

        if ($db_register->query($insert_details) === TRUE) {
            header("Location: index.php?error=0");
        } else {
            header("Location: index.php?error=1");
        }
    }

?>

<?php 
    // This Code Updates the the record by id from the database
   if (isset($_POST["textUpdate"])) {

       $id = $_POST["id"];
       $fullName = $_POST["textFullName"];
       $emailId = $_POST["textEmailId"];
       $phoneNo = $_POST["textPhoneNo"];
       $address = $_POST["textAddress"];
    
   
        $update_details = "UPDATE tb_users SET full_name = '$fullName', email_id = '$emailId', phone_no =  '$phoneNo', address = '$address' WHERE id = '$id'";

        if ($db_register->query($update_details) === TRUE) {
            header("Location: index.php?error=0");
        } else {
            header("Location: index.php?error=1");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>

<body>
    <form method="post">
        <label for="fullNAme">Full Name</label><br>
        <input type="text" name="textFullName" value="<?php
        if ($update == true) {echo $row_edit ["full_name"]; }?>"><br><br>

        <label for="fullNAme">Eamil </label><br>
        <input type="email" name="textEmailId" value="<?php echo $row_edit["email_id"]; ?>"><br><br>

        <label for="fullNAme"> Telephone</label><br>
        <input type="text" name="textPhoneNo"  value="<?php echo $row_edit["phone_no"]; ?>"><br><br>

        <label for="fullNAme">Address</label><br>
        <textarea name="textAddress" id="" cols="30" rows="10" ><?php echo $row_edit["address"]; ?></textarea><br><br>
        <?php if ($update != TRUE) { ?>
            <input type="submit" name="textSubmit" value="submit">
        <?php } else{ ?>
            <input type="text" name="id"  value="<?php echo $row_edit ["id"]; ?>" hidden>
            <input type="submit" name="textUpdate" value="UPDATE">

        <?php } ?>

    </form>

   


<h2>Address Details</h2>

    <table>
    <tr>
        <th>Full name</th>
        <th>Email Address</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>
    <?php  while ( $row_details = $result_details->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row_details["full_name"]; ?></td>
            <td><?php echo $row_details["email_id"]; ?></td>
            <td><?php echo $row_details["phone_no"] ;?></td>
            <td><?php echo $row_details["address"]; ?></td>
            <td><a href="index.php?edit=<?php echo $row_details["id"]; ?>">update</a> </td>
            <td><a href="index.php?del=<?php echo $row_details["id"]; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </table>
</body>
</html>