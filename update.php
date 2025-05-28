<?php


include ("connection.php");
// print_r($_GET);exit;





$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $name=  $_POST['Name'];
  $Email=  $_POST['Email'];

 
  $mobile_number=  $_POST['mobile_number'];


  $address=  $_POST['address'];


  // $new_id = $_GET['id'] ;

 
  $sql = "UPDATE notes SET Name='$name', Email='$Email', mobile_number='$mobile_number', address='$address' where id='$id' ";



   $result = mysqli_query($conn, $sql);
  //  var_dump($result);

  //  $row= mysqli_fetch_assoc($result);
   


   if($result){
    echo "<script> alert('record updated') </script>";
   header("location:http://localhost/vivek/todo.php");
   
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
<style>
   body {
    background-image: url('background_img.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    color: green;
}

tr,td,th{
  color: green;
}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">
    <img src="valethi.webp " width="50" height="50" alt="">
  </a>
 
<a class="navbar-brand" href="#">Valethi Technologies</a>
</nav>

<div class="container mt-4">
  <h2>Update Details</h2>
  <form action="" method="POST">
     <div class="form-group">
      <label for="srno  ">Srno</label>
      <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($row['id']) ?>" required readonly >
     
    </div>
    <div class="form-group">
      <label for="Name">Name <span style="color:red">*</span></label>
      <input type="text" class="form-control" id="Name" name="Name" value="<?php echo htmlspecialchars($row['Name']) ?>" required>
     
    </div>
    <div class="form-group">
      <label for="Email">Email <span style="color:red">*</span></label>
      <input type="text" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($row['Email'])  ?>" required>
     
    </div>
    <div class="form-group">
      <label for="mobile_number">Mobile Number <span style="color:red">*</span></label>
      <input type="text" class="form-control" id="mobile_number" name="mobile_number"  value="<?php echo htmlspecialchars($row['mobile_number']) ?>">
     
    </div>
    <div class="form-group">
      <label for="address">Address <span style="color:red">*</span></label>
      <input type="textarea" class="form-control" id="address" name="address" rows="3" value="<?php echo htmlspecialchars($row['address'])  ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" id = 'submit' name="submit">Update</button>
  </form>
</div>
    </body>
    </html>