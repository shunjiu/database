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

 
$sql = "SELECT * FROM userinfo where username='$username';";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // echo "<script>alert(\"此用户存在\");</script>";
    $sql = "SELECT password,admin FROM userinfo where username='$username';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row['password']==$password)
    {
    	// echo ("mysqli_fetch_assoc($result)['admin']");
    	if($row['admin']==1)
        	echo "<script>alert(\"管理员登陆成功！\");parent.location.href='fy.php'</script>";
        else
        	echo "<script>alert(\"普通用户登陆成功！\");parent.location.href='login.html'</script>";
    }else
    {
        echo "<script>alert(\"密码错误！\");parent.location.href='login.html'</script>";
    }

} else {
    echo "<script>alert(\"此用户不存在！\");parent.location.href='login.html'</script>";
}

mysqli_close($conn);
?>