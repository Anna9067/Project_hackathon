<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group list forming</title>
    <link rel="stylesheet" href="css/search.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php 
        $connection = mysqli_connect('localhost', 'root', '', 'uni_project'); // підключення до mysql
        if($connection->connect_error) {
            die("Connection failed:". $connection->connect_error);
        }
        if(isset($_POST['submit'])) {
            $str=$_POST["search"];
            $sth="SELECT * FROM `students` WHERE Name like '%$str%'";
            $outcome=mysqli_query($connection, $sth);
            if($outcome){
                $num=mysqli_num_rows($outcome);
                if($num > 0){
                    echo "
                    <div class='tab'>
                    <table cellpadding='0' border='1'> 
                     <thead>
                        <tr>
                            <th>ID</th>
                            <th>ПІБ</th>
                            <th>Середній бал</th>
                            <th>Форма навчання</th>
                            <th>Група</th>
                        </tr>
                    </thead>
                ";
                while($array=mysqli_fetch_assoc($outcome)){
                    echo "
                    <tbody>
                        <tr>
                        <td>". $array['id'] ."</td>
                        <td>". $array['Name'] ."</td>
                        <td>". $array['Grade'] ."</td>
                        <td>". $array['Education'] ."</td>
                        <td>". $array['Study_group'] ."</td>
                        </tr>
                    </tbody>
                ";    
                } 
                $way="img\\2.png";
                echo "
                    </table>
                    </div>
                    <img class= 'picture' src=$way>
                ";
                }
            }
            else {
                echo "DATA NOT FOUND";

            }
        }
        mysqli_close($connection); 
?>
</body>
</html>