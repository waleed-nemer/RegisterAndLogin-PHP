<?php 
// هذه هو كود التحقق من الكود المرسل 
if(isset($_GET['code'])){ 
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=اسم قاعدة البيانات;", $username,$password);

$checkCode = $database->prepare("SELECT SECURITY_CODE FROM users WHERE SECURITY_CODE = :SECURITY_CODE");
$checkCode->bindParam("SECURITY_CODE",$_GET['code']);
$checkCode->execute();

if($checkCode->rowCount()>0){
   $update = $database->prepare("UPDATE users SET SECURITY_CODE = :NEWSECURITY_CODE, 
    ACTIVATED=true WHERE SECURITY_CODE = :SECURITY_CODE");
   $securityCode = md5(date("h:i:s"));
   $update->bindParam("NEWSECURITY_CODE", $securityCode); 
   $update->bindParam("SECURITY_CODE", $_GET['code']);
  
if($update->execute()){
   echo '<div class="alert alert-danger p-5">
    تم التحقق من حسابك بنجاح
    </div>';
   echo '<a class="btn btn-success" href="login.php">تسجيل دخول</a>';
}
}    
}
?>