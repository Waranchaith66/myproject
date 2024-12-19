<?php session_start();
include("include/config.php");
error_reporting(0);

if(isset($_POST['Login'])){

    echo $username = $_POST['username'];
    $loginpassword = $_POST['loginpassword'];
    echo $hasedpassword = hash(algo:'sha256',data: $loginpassword);

   $ret = "SELECT * FROM userdata WHERE (username=:uname && loginpassword=:loginpassword)";
   $queryt = $dbh -> prepare($ret);
   $queryt->bindParam(':uname',$username,PDO::PARAM_STR);
   $queryt->bindParam(':loginpassword',$hasedpassword,PDO::PARAM_STR);
   $queryt-> execute();
   $results = $queryt -> fetchAll(PDO::FETCH_OBJ);

   if($queryt-> rowCount() > 0){
        echo "<script type='text/javascript'>";
        echo "alert('เข้าสู่ระบบเเล้ว');";
        echo "document.location= 'welcome.php';";
        echo "</script>";
   }
   else{
    echo "<script type='text/javascript'>";
    echo "alert('ไม่ถูกต้อง');";
    echo "document.location= 'login.php';";
    echo "</script>";
}
}
?>