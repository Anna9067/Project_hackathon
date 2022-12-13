<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Group list forming</title>
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>
    <main> 
        <div class="buttons">
        <a href = "guest.php" class="floating-button" >Зайти як гість</a>
        <a class="floating-button" onclick="openForm()">Зайти як адмін</a>
        </div>

        <div class="login-page" id="myForm">
            <div class="form" >
              <form class="login-form" method = "POST">
                <input type="password" name="password" placeholder="Password" required/>
                <button type="submit">Вхід</button>
              </form>
            </div>
        </div>

        <?php 

            require('connect.php');
            if(isset($_POST["password"])) {
            $password = $_POST["password"];
            $query = "SELECT * FROM owners WHERE password='$password'"; 
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection)); // запит
            $count = mysqli_num_rows($result);  //возвращает количество рядов результата запроса
            mysqli_close($connection); 
            if($count == 1) {
                header("Location: question.html");
            }
          }  
        ?>  
    </main>
    <script src="index.js"></script>
    <script>
        function openForm() {
          document.getElementById("myForm").style.display = "block";
        }
    </script>
  </body>
</html>


