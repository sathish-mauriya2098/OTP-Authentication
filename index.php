<html>
<head>
  <title>SEND OTP</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style>
        body{
            background-color: aqua;
        }
        .frm{
            margin-top:50px;
            border: 2px solid;
            background-color: white;
        }
        p{
            color: red;
        }
    </style>
    </head>
    <body>
    
 <div class="container">
     
     <div class="col-md-6 offset-sm-3 frm">
        <?php
         if(isset($_POST['sendotp'])){
require('textlocal.class.php');

$textlocal = new Textlocal(false,false,'your API');

$numbers = array($_POST['mobile']);
$sender = 'TXTLCL';
$otp=mt_rand(1000,9999);
$message = "Your OTP is:".$otp;

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
    setcookie('otp',$otp);
   echo "OTP successfully sent to your mobile";
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
 }
         if(isset($_POST['verifyotp'])){
             $otp=$_POST['otp'];
             if($_COOKIE['otp']==$otp){
                 header("Location:success.php");
             }
             else{
                 echo "<p>Please enter valid OTP</p>";
             }
         }
?>
         <h1 class="text-center">Send OTP</h1>
        <form action="" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
        </div>
            
           
            <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile Number" required>
        </div>
            <button type="submit" name="sendotp" class="btn btn-lg btn-success btn-block">SEND OTP</button>
        </form>
        <form action="" method="post">
        <div class="form-group">
            <label>OTP</label>
            <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required>
        </div>
            
            <button type="submit" name="verifyotp" class="btn btn-lg btn-primary btn-block">Verify</button>
        </form>
        </div>
  </div>
    </body>
</html>
