<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>


<?php 
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=database;", $username,$password);

if (isset($_POST['register'])){
    $checkEmail = $database->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
    $email = $_POST['email'];
    $checkEmail->bindParam("EMAIL", $email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo '<div class="alert alert-danger p-5">
          هذا الحساب سابقا استخدامه
        </div>';
    }else{
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $addUser = $database->prepare("INSERT INTO users(NAME,AGE,PASSWORD,EMAIL,SECURITY_CODE) 
        VALUES(:NAME,:AGE,:PASSWORD,:EMAIL,:SECURITY_CODE)");
        $addUser->bindParam("NAME",$name);
        $addUser->bindParam("AGE",$age);
        $addUser->bindParam("PASSWORD",$password);
        $addUser->bindParam("EMAIL",$email);
        $securityCode = md5(date("h:i:s"));
        $addUser->bindParam("SECURITY_CODE", $securityCode);
        if($addUser->execute()){
            echo '<div class="alert alert-danger p-5">
            تم انشاء حساببنجاح
          </div>';

          require_once 'mail.php';
          $mail->addAddress($email);
          $mail->Subject = "رمز تحقق من بريد الكتروني";
          $mail->Body    =  '<h2>شكرلتسجيل في موقعنا</h2>'
          ."<div>رابط تحقق من حساب". "</div>".
          "<a href='http://localhost/suingup/active.php?code=".$securityCode."'>".
          "http://localhost/suingup/active.php"."؟code=" . $securityCode ."</a>";
          ;
          $mail->setFrom("email@example.com","name");
          $mail->send();

       }else{
        echo '<div class="alert alert-danger p-5" role="alert">
        حدث خطا غير متوقع
      </div>';

       }
    }

}
?>


<div class="container p-5" dir="rtl">
<form class="bg-light p-5" method="POST" >
<h2 style="color:blue;font-weigth:800;text-align:center;">تسجيل </h2>
    <lable>الاسم</lable>
    <input type="text" class="form-control" name="name" required/>
    <br>
    <lable>العمر</lable>
    <input type="date" class="form-control" name="age" required/>
    <br>
    <lable>الايميل</lable>
    <input type="email" class="form-control" name="email" required/>
    <br>
    <lable>كلمة المرور</lable>
    <input type="pass" class="form-control" name="password" required/>
    <br>
    <button type="submit" class="btn btn-primary" name="register">تسجيل</button>
</form>
</div>


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

