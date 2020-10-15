<?php
require 'back.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todoList</title>

    <style>
    *{
        padding: 0;
        margin: 0;
    }
    body{
        display: flex;
        align-items:center;
        background-color: blue;
        justify-content:center
    }
    .input{
        display: block;
        background: white;
        padding: 20px;

    }
    .big, button{
        width: 350px;
        height: 40px;
        margin-bottom: 10px; 
        padding-left: 20px
    }
    .details{
        display: block;
        background: silver;
        padding: 20px;
        margin-top: 20px;
    }
    .details .inner{
        background: white;
        padding: 20px
    }
    .inline{
        display: flex;
        margin-right: 10px;
    }
    </style>
</head>
<body>

<div>
<form>
<div class="input">
    <input class="big" type= "text" placeholder="add new item" name="title"><br>
    <button type="submit">Add &nbsp; <span>&#43;</span></button>
    </form>
    </div>
    <?php
        $todo = $conn->query("SELECT * FROM todo ORDER BY id DESC");
    ?>
    <?php if($todo->rowCount() === 0){?>
    <div class="details">
    
    </div>
    <?php } ?>
    <?php while($todos = $todo->fetch(PDO::FETCH_ASSOC)){?>
    <div class="details">
    <div class="inner">
    <div class="inline">
    <input class="inline" type="checkbox">
    <h6>this is a boy</h6>
    </div>
    <p> created: 3/04/90</p>
    </div>
    <?php } ?>
    </div>
    
    </div>
</body>
</html>