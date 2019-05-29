<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>分页</title>
    <link href="tmp/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="tmp/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="tmp/login-2.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="login">
    <div class="content">

        <?php 

            //获取当前页码
            $page=$_GET['page'];
            if($page==0){
                $page=1;
            }
            //设置每页最大能显示的数量
            $pagesize=3;

            //连接数据库
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
            
            //获取结果集的记录数

            $result = mysqli_query($conn,"SELECT username,password,pin from userinfo;");
            $row=mysqli_fetch_row($result);
            $recordcount=mysqli_num_rows($result); 



            //计算总页数
            if($recordcount==0)
                $pagecount=0;
            else if($recordcount<$pagesize ||$recordcount==$pagesize){
                    $pagecount=1;
                }
            else if($recordcount%$pagesize==0){
                    $pagecount=$recordcount/$pagesize;
                }
            else 
                    $pagecount=(int)($recordcount/$pagesize)+1;

            echo("当前页码：".$page."/".$pagecount."<br />");

        ?>

        <table width="449" border="1"> 
            <tr>
                <td>username</td>
                <td>password</td>
                <td>pin</td>
            </tr>

        <?php 
        //循环显示当前页面的记录
        header("content-type:text/html;charset=utf-8");


        $sql=($page-1)*$pagesize;
        $result=mysqli_query($conn,"SELECT * from userinfo limit {$sql},{$pagesize}");
        while($row=mysqli_fetch_row($result))
        {   

            echo("<tr />");
            echo("<td>$row[0]</td>");
            echo("<td>$row[1]</td>");
            echo("<td>$row[2]</td>");
            echo("<tr />");
        }
        mysqli_close($conn);


        //显示分页链接
        if($page==1){
            echo("第一页");
        }
        else
            echo("<a href=fy.php?page=1>第一页</a>");


        if($page==1){
             echo("上一页");
        }
        else 
            echo("<a href=fy.php?page=".($page-1).">上一页</a>");


        if($page==$pagecount){
            echo("下一页");
        }
        else 
            echo("<a href=fy.php?page=".($page+1).">下一页</a>");

        if($page==$pagecount){
            echo("最后一页");
        }
        else 
            echo("<a href=fy.php?page=".$pagecount.">最后一页</a>");
        ?>
        </table>
        
        <div class="form-actions">
            <button type="button" class="btn btn-default" onclick="location='login.html'">Back</button>
        </div>
    </div>
</body>
</html>