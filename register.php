<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="Name" id="name" value="<?php if (isset($_POST['Name'])) {
            echo $_POST['Name'];
        } ?>" placeholder="Name as on College ID card " required /><br>
        <label for="Rollno">Exam Roll_no:</label>
        <input type="text" name="Rollno" id="Rollno" value="<?php if (isset($_POST['Rollno'])) {
            echo $_POST['Rollno'];
        } ?>" placeholder="Enter your Exam Roll No" /><br>
        <label for="password">Password:</label>
        <input type="password" name="Password" id="password" value="<?php if (isset($_POST['Password'])) {
            echo $_POST['Password'];
        } ?>" placeholder="Password" required /><br>
        <label for="cpassword">Confirm Password:</label>
        <input type="password" name="cPassword" id="cpassword" value="<?php if (isset($_POST['cPassword'])) {
            echo $_POST['cPassword'];
        } ?>" placeholder="Confirm Password" required /><br>

        <input type="file" accept="image/*" name="Img" id="img"><br>
        <textarea name="bio" id="bio" cols="30" rows="15" placeholder="Enter your bio here in upto 70 words"
            maxlength="449"></textarea>
        <br>
        <p class="stream">Stream</p>
        <select id="stream" name="stream">
            <option value="Default"></option>
            <option value="Arts">Arts</option>
            <option value="Medical">Medical</option>
            <option value="Non-Medical">Non-Medical</option>
            <option value="BCom">BCom</option>
            <option value="BCA">BCA</option>
        </select>
        <br>
        <p class="stream">Gmail</p>
        <input type="text" name="Gmail" id="gmail" maxlength="34" placeholder="Enter your gmail here">
        <br><button class="sub" name="sub">Submit</button>

    </form>


    <?php
    // Backend
    if (isset($_POST['sub'])) {
        include("database.php");
        $Name = $_POST['Name'];
        $Roll_no = $_POST['Rollno'];
        $password = $_POST['Password'];
        $cpassword = $_POST['cPassword'];
        $bio = $_POST['bio'];
        $stream = $_POST['stream'];
        $gmail = $_POST['Gmail'];


        //query
        $query = "SELECT * FROM `auth_data` WHERE Name = '$Name' ";
        $data = mysqli_query($connection, $query);
        $flag = false;
        $flag_log = false;
        $flag_roll = false;
        //extraction 
        while ($row = mysqli_fetch_assoc($data)) {
            $roll = $row['Roll_no'];
            $flag = true;
            if ($roll == $Roll_no) {
                if ($row['log'] == 0) {
                    $flag_roll = true;
                    $flag_log = true;
                    $flag = true;
                    $name = $row["Name"];
                    break;
                } else {
                    echo "You already have an account";
                    die();
                }
            }
        }
        //check
        if ($flag) {
            if ($flag_roll) {
                if ($password == $cpassword) {
                    $hash = hash("md2", $password);

                    $query = " INSERT INTO `login_data` (`Sno.`, `Username`, `Password`) VALUES (NULL, '$Name.$roll', '$hash') ";
                    mysqli_query($connection, $query);

                    $query = " UPDATE `auth_data` SET `log` = '1' WHERE `auth_data`.`Roll_no` = '$roll'";
                    mysqli_query($connection, $query);


                    header("Location: index.php");
                    die();
                } else {
                    echo "passwords dont match";
                }

            } else {
                echo "enter correct roll_no";
            }


        } else {
            echo 'Name not found';

        }
    }
    ?>


</body>

</html>