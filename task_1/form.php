<?php
     $connection = mysqli_connect('localhost', 'root', '', 'uni_project'); // підключення до mysql
     if($connection->connect_error) {
         die("Connection failed:". $connection->connect_error);
     }
     $id=$_GET['updateid'];
     if(isset($_POST['insert'])){
        $name=$_POST['Name'];
        $grade=$_POST['Grade'];
        $education=$_POST['Education'];
        $group=$_POST['Study_group'];

        $sql="UPDATE `students` SET id=$id,Name='$name',Grade='$grade',Education='$education',Study_group='$group' WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        if(!$result){
            die(mysqli_error($connection));
        } 
     }
     mysqli_close($connection); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group list forming</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
   <div class="container">
        <h1>Змінюємо дані</h1>
        <form method="POST">
           <input type="text" name="Name" placeholder="Введіть ПІБ абітурієнта" required><br>
            <input type="text" name="Grade" placeholder="Введіть середній бал" required> <br>
            <input type="text" name="Education" placeholder="Введіть форму навчання" required> <br>
             <input type="text" name="Study_group" placeholder="Введіть групу" required> <br>
             <input type="submit" name="insert" value="Оновити" class="btn">
        </form>
   </div>
  
</body>
</html>