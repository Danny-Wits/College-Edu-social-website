<?php
include('database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Index</title>
</head>

<body>
  <h2>Login</h2>
  <form method="post">
    <label for="Name">Name </label><br />
    <input type="text" id="Name" name="name" value="<?php if (isset($_POST['name'])) {
      echo $_POST['name'];
    } ?>" /><br />
    <label for="password">Password</label><br />
    <input type="password" id="password" name="password" /><br /><br />
    <button>Login</button>
  </form>

  <!-- BACKEND  -->

  <?php
  if (isset($_POST['name']) and $_POST['password']) {
    $Name = $_POST['name'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `login_data` WHERE Username = '$Name'";
    $data = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_assoc($data)) {
      $hash = hash("md2", $password);
      if ($row['Password'] == $hash) {
        header("location: main.php");
      } else {
        echo "incorrect password";
      }
    } else {
      echo "not registered register here :<a href='register.php'> Register</a>";

    }
  }

  ?>

</body>

</html>