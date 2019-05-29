<?php
$servername = "localhost:3306";
$username = "root";
$password = "shunjiu";
$dbname = "net";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST["username"];
$password = md5($_POST["password"]);
$repassword = md5($_POST["repassword"]);
$pin = $_POST["pin"];

$sql = "SELECT * FROM userinfo where username='$username';";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
	echo "<script>alert(\"注册失败！此用户已存在。\");parent.location.href='register.html';</script>";
}else
{
	if($password==$repassword)
	{
	    $sql = "INSERT INTO userinfo (username, password, pin) VALUES('$username','$password','$pin')";
	     
	    if (mysqli_query($conn, $sql)) {
	        echo "<script>alert(\"注册成功！\");parent.location.href='login.html';</script>";
	    } else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	}else{
		echo "<script>alert(\"注册失败！密码不一样。\");parent.location.href='register.html';</script>";
	}
}

mysqli_close($conn);
?>