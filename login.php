<?php

include ("connection.php");
$Email1 ="";
$EmailErr="";






function clean_inputs($field)
{
  $field = trim($field);
  $field = stripslashes($field);
  $field = htmlspecialchars($field);
  return $field;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $Email = clean_inputs($_POST["Email"]);

 $isValid = true;

 
  if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/", $Email)) {
    $EmailErr = "Invalid Email format";
    $isValid = false;
    $Email1= $_POST["Email"];
  }




 if ($isValid){

 
 header("location:http://localhost/vivek/todo.php");
 }}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

</head>
<body>

<section class=" text-center text-lg-start">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }

     body {
    background-image: url('background_img.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    color: white;
}

  </style>
  <div class="container mt-4 bg-dark" >
  <div class="card mb-3 bg-dark">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="val.jfif" alt="valethi Technologies"
          class="w-70 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

          <form method='POST'>
         <div class="form-group">
        <label for="Email">Email <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($Email1) ?>" required>
        <?php if ($EmailErr) {
          echo $EmailErr;
        }
        ?>
      </div>
     
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="form2Example2" class="form-control" required/>
              <label class="form-label" for="form2Example2">Password</label>
            </div>

     
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
          
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>

              <div class="col">
            
                <a href="#!">Forgot password?</a>
              </div>
            </div>
<a href="todo.php">
    <button type="submit" class="btn btn-primary">Submit</button>
    </a>     

          </form>

        </div>
      </div>
    </div>
  </div>
  </div>
</section>

    
</body>
</html>