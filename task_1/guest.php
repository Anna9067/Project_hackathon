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
    <div class="d1">
        <form action= "search.php" method="POST">
        <input type="text" name="search" placeholder="Шукати">
        <button type="submit" name="submit"></button>
        </form>
    </div> 
    <div class="tab">
    <table cellpadding="0" border="1"> 
        <thead>
        <tr>
            <th>ID</th>
            <th>ПІБ</th>
            <th>Середній бал</th>
            <th>Форма навчання</th>
            <th>Група</th>
        </tr>
        </thead>
    <tbody>
    <?php 
         $connection = mysqli_connect('localhost', 'root', '', 'uni_project'); // підключення до mysql
         if($connection->connect_error) {
             die("Connection failed:". $connection->connect_error);
         }
        $query="SELECT * FROM `students`";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        if($count > 0) {
            while($row = mysqli_fetch_assoc($result)){
                echo "
                    <tr>
                    <td>". $row['id'] ."</td>
                    <td>". $row['Name'] ."</td>
                    <td>". $row['Grade'] ."</td>
                    <td>". $row['Education'] ."</td>
                    <td>". $row['Study_group'] ."</td>
                    </tr>
                ";
            }
        } else {
            echo "Нічого не знайдено";
        }
        mysqli_close($connection); 
    ?>
    </tbody>
    </table>
    </div>
</body>
</html>