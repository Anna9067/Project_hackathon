   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group list forming</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/table.css">
   </head>
   <body>
   <?php
        $count_group = $_POST["groups"]; //кількість груп
        $connection = mysqli_connect('localhost', 'root', '');
        $database = 'uni_project';
        $select_db = mysqli_select_db($connection, $database); 
        mysqli_query($connection, "SET NAMES 'utf8'");

        $budget = "бюджет";
        $query = "SELECT * FROM students WHERE Education='$budget' AND Grade >= 180";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		for ($highgrade_budget = []; $row = mysqli_fetch_assoc($result); $highgrade_budget[] = $row);

        $query = "SELECT * FROM students WHERE Education='$budget' AND (Grade >= 160 AND Grade < 180)";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		for ($middlegrade_budget = []; $row = mysqli_fetch_assoc($result); $middlegrade_budget[] = $row);

        $query = "SELECT * FROM students WHERE Education='$budget' AND Grade < 160";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		for ($lowgrade_budget = []; $row = mysqli_fetch_assoc($result); $lowgrade_budget[] = $row);

        $contract = "контракт";
        $query = "SELECT * FROM students WHERE Education='$contract' AND Grade >= 180";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		for ($highgrade_contract = []; $row = mysqli_fetch_assoc($result); $highgrade_contract[] = $row);

        $query = "SELECT * FROM students WHERE Education='$contract' AND (Grade >= 160 AND Grade < 180)";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		for ($middlegrade_contract = []; $row = mysqli_fetch_assoc($result); $middlegrade_contract[] = $row);

        $query = "SELECT * FROM students WHERE Education='$contract' AND Grade < 160";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		for ($lowgrade_contract = []; $row = mysqli_fetch_assoc($result); $lowgrade_contract[] = $row);
      
        function editTab($data, $connection, $count_group){
            $N_group = 1;
            $i = 0;
            $n = count($data);
            while($i < $n) {
                $x = $data[$i]["id"];
                $query = "UPDATE students SET Study_group = '$N_group' WHERE id='$x'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $i++; $N_group++;
                if($N_group > $count_group) {
                    $N_group = 1;
                }
            } 
        }
        editTab($highgrade_budget, $connection, $count_group);
        editTab($middlegrade_budget, $connection, $count_group);
        editTab($lowgrade_budget, $connection, $count_group);
        editTab($highgrade_contract, $connection, $count_group);
        editTab($middlegrade_contract, $connection, $count_group);
        editTab($lowgrade_contract, $connection, $count_group);
 
        $answer = $_POST["answer"];
        $N_group = 1;
        if($answer == "Так"){
            while($N_group <= $count_group) {
                $query = "SELECT Grade FROM students WHERE Study_group='$N_group'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                for ($average = []; $row = mysqli_fetch_assoc($result); $average[] = $row);
                $n = count($average);
                $sum = 0;
                 for($i=0; $i < $n; $i++) {
                    $sum = $sum+$average[$i]["Grade"];
                } 
                $middle = $sum/$n;
                echo "<div class='light'>Середній бал групи $N_group: $middle <br></div>";
                $N_group++;
            }
        } else{
            $query="SELECT * FROM students";
            $result = mysqli_query($connection, $query);
        ?>
    <h2 class="title">Отримана таблиця абітурієнтів</h2>
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
        }
        }
        mysqli_close($connection); 
    ?>
    
   </body>
   </html>
   

