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
$pin = $_POST["pin"];
$password = md5($_POST["password"]);

 
$sql = "SELECT * FROM userinfo where username='$username';";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {

    $sql = "SELECT pin FROM userinfo where username='$username';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_fetch_assoc($result)['pin']==$pin)
    {
        $sql = "UPDATE userinfo SET password='$password' WHERE username='$username';";
        if (mysqli_query($conn, $sql)) 
        {
            echo "<script>alert(\"密码修改成功！\");parent.location.href='login.html'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }else{
        echo "<script>alert(\"Pin错误！\");parent.location.href='resetPassword.html'</script>";
    }

} else {
    echo "<script>alert(\"此用户不存在！\");parent.location.href='resetPassword.html'</script>";
}

mysqli_close($conn);
?>