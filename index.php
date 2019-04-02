<?php
  include "lib/connection.php";

  $result = "";

  if(isset($_POST['submit_btn']))
  {
    $name = $_POST['student_name'];
    $email = $_POST['student_email'];
    $gender = $_POST['student_gender'];
    $age = $_POST['student_age'];
    $pass = md5($_POST['student_pass']);
    $conf_pass = md5($_POST['student_cpass']);
    
    if($pass==$conf_pass)
    {
      $insertSQL = "INSERT INTO student_info(name,email,gender,age,pass)
       VALUES('$name','$email',$gender,$age,'$pass')";

       if($conn->query($insertSQL))
       {
        $result = "Added to Database";
       }
       else
      {
        die($conn->error);
      }

    }    
    else{
      $result = "not matched";
  }

  }

    $selectSQL = "SELECT * FROM student_info";
    $result_student = $conn->query($selectSQL);
    echo $result_student->num_rows;

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>CRUD</title>
  </head>
  <body>
    <h1 align="center">PHP CRUD</h1>
    <!-- form start -->
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="">name</label><br>
            <input type="text" name="student_name" placeholder="enter name" required=""><br>
            <label for="">email</label><br>
            <input type="email" name="student_email" placeholder="enter email" required=""><br>
            <label for="">gender</label><br>
            <select name="student_gender" id=""><br>
              <option value="0">Male</option>
              <option value="1">Female</option>
            </select><br>
            <label for="">age</label><br>
            <input type="number" name="student_age" placeholder="student age" required=""><br>
            <label for="">password</label><br>
            <input type="password" name="student_pass" placeholder="password" required=""><br>
            <label for="">confirm password</label><br>
            <input type="password" name="student_cpass" placeholder="confirm_password" required=""><br/><br><br>
            <input type="submit" name="submit_btn" value="Submit" style="background-color: skyblue;"><br/>
            
          </form>
        </div>  
      </div>
    </div>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php echo $result; ?>
        </div>
      </div>
    </div> 
    <br>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <table border="1" cellpadding="10">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Age</th>
            </tr>
            <?php if($result_student->num_rows>0){?>
            <?php while($student_row=$result_student->fetch_assoc()) {?>
            <tr>
              <td><?php echo $student_row['name']; ?></td>
              <td><?php echo $student_row['email']; ?></td>
              <td><?php if($student_row['gender']==0){
                echo "male";
              }else{
              echo "female";
            
              } ?></td>
              <td><?php echo $student_row['age']; ?></td>
            </tr> 
            <?php } ?>
            <?php }else{ ?>
            <tr>
              <td colspan="4">No Student Data found!</td>
            </tr>
            <?php } ?>
           
            
          </table>
        </div>
      </div>
    </div> 

    <!-- form end -->

    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
