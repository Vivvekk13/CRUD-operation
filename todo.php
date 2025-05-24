<?php

include("connection.php");


if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
    $dlt = $conn->prepare("DELETE FROM `notes` WHERE `id` = ?");
    $dlt->bind_param("i", $id);
     $dlt->execute();
     $dlt->close();
      header("location:http://localhost/vivek/todo.php");
} 

     function clean_inputs($field){
      $field = trim($field);
      $field = stripslashes($field);
      $field = htmlspecialchars($field);
      return $field;
     }




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Name = clean_inputs($_POST["Name"]);
    $Email = clean_inputs($_POST["Email"]);
    $address = clean_inputs($_POST["address"]);
    $mobile_number = clean_inputs($_POST["mobile_number"]);

    $isValid = true;

    if (!preg_match("/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/", $Name)) {
        $NameErr = "Invalid Name  format";
        $isValid = false;
    }

    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $Email)) {
        $EmailErr = "Invalid Email format";
        $isValid = false;
    }

    if (!preg_match("/^[7-9][0-9]{9}$/", $mobile_number)) {
        $mobile_numberErr = "Invalid mobile_number format";
        $isValid = false;
    }

    if ($isValid) {
        $ins = $conn->prepare("INSERT INTO `notes` (`Name`, `Email`, `mobile_number`, `address`, `tstamp`) VALUES (?, ?, ?, ?, current_timestamp())");
        $ins->bind_param("ssss", $Name, $Email, $mobile_number, $address);
        $ins->execute();
        $ins->close();
       
       
    }
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Valethi CRUD Operation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">
    <img src="valethi.webp " width="50" height="50" alt="">
  </a>
  
<a class="navbar-brand" href="#">Valethi Technologies</a>
</nav>

<div class="container mt-4">
  <h2>Employee Details</h2>
  <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']);?>" method="POST">
    <div class="form-group">
      <label for="Name">Name</label>
      <input type="text" class="form-control" id="Name" name="Name" required>
      <?php if($NameErr){
            echo $NameErr;
      }
      ?>
    </div>
    <div class="form-group">
      <label for="Email">Email</label>
      <input type="text" class="form-control" id="Email" name="Email"  required>
      <?php if($EmailErr){
            echo $EmailErr;
      }
      ?>
    </div>
    <div class="form-group">
      <label for="mobile_number">Mobile Number</label>
      <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
       <?php if($mobile_numberErr){
            echo $mobile_numberErr;
      }
      ?>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<div class="container mt-4">
  <h2>All Employee Details</h2>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>Srno</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Address</th>
        <th>Time & Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM `notes` ORDER BY id desc";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <th scope='row'>{$row['id']}</th>
                  <td>{$row['Name']}</td>
                  <td>{$row['Email']}</td>
                  <td>{$row['mobile_number']}</td>
                  <td>{$row['address']}</td>
                  <td>{$row['tstamp']}</td>
                  <td>
                <a href='update.php?id={$row['id']}'  >Edit</a>
                    <a href='?delete={$row['id']}' class='btn btn-primary btn-sm' onclick=\"return confirm('Are you sure you want to delete this note?');\">Delete</a>
                  </td>
              
              
                  
                 </tr>";
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
