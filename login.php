<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>login</title>
</head>
<body>



<div class="container p-5" dir="rtl">
<form class="bg-light p-5" method="POST">
  <div class="mb-3">
    <h2 style="color:blue;font-weigth:800;text-align:center;">تسجيل الدخول </h2>
    <label class="form-label">الايميل</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="mb-3">
    <label class="form-label">كلمة المرور</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary" style="text-align:center;" name="login">login</button>
</form>
</div>

<?php 
//هذه صفحة تسجيل الدخول 
if(isset($_POST['login'])){
// الكود هنا للاتصال بقاعدة البيانات  
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=database;", $username,$password);

$login = $database->prepare("SELECT * FROM users WHERE EMAIL = :email AND PASSWORD = :password");
$login->bindParam("email", $_POST['email']); 
$login->bindParam("password", $_POST['password']); 
$login->execute();

if($login->rowCount() === 1){
$user = $login->fetchObject();

if($user->ACTIVATED === "1"){
    echo "مرحبا بك".$user->NAME;
}else{
    echo '<div class="alert alert-danger" role="alert">
    يرجى تفعيل حسابك في البداية ولقد ارسلنا رمز التحقق من حسابك الى البريد الكتروني الخاص بك
  </div>';
}
    
}
}else{
    echo '<div class="alert alert-danger" role="alert">
        كلمة المرور او الايميل غير صحيح
      </div>';
}
// }
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

