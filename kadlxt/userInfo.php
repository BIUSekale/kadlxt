<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=0">

	<title>有关于我</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
	 
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>	 
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- qq分享组件 -->
	<script type="text/javascript" src="https://qzonestyle.gtimg.cn/qzone/qzact/common/share/share.js"></script>
</head>
<body>
<?php
    $openid = $_GET['openid'];
    include('./php/conn.php');
    $sql = "select * from userinfo  where `openid` = '".$openid."'";
    $rs=$conn->query($sql);
    while($row = $rs->fetch_assoc()){
            $design=$row['signafic'];
        }
    $conn->close();
    $myfile = fopen("data/accessToken.txt", "r") or exit("Unable to open file!");
    $oldas = fgets($myfile);
    fclose($myfile);
    if ($oldas == "") {
        // echo("first time");
        $oldas = getAccessToken();
    }
    $astokon = $oldas;
    // echo $astokon;

    
    $curl = "https://api.uni.qq.com/cgi-bin/user/info?access_token=".$astokon."&openid=".$openid."&lang=zh_CN";
    $json = file_get_contents($curl);  
    $arr = json_decode($json,true);
    if($arr['subscribe']==0) {
       echo '<script>alert("请先关注公众号“QQ智慧校园测试号2”再进入个人主页查看个人信息！"); window.location.href="index.php?='.$openid.'";</script>';
    }
    if($arr['sex']==1){
        $sex = '男';
    }
    else if($arr['sex']==2){
        $sex = '女';
    }
    else{
        $sex = ' ';
    }
    $str = "s=40";
    $imgurl = $arr['headimgurl'];
    $strtoreplacement = "s=0";
    $pos = strpos($imgurl,$str);
    $imgurl = substr_replace($imgurl,$strtoreplacement,$pos);
    

    function getAccessToken(){
        $getaskt = "https://api.uni.qq.com/cgi-bin/token_v2?appid=test_835056957&secret=Q9Yc5yj70Jcnnsj4";
        $json = file_get_contents($getaskt);
        $array = json_decode($json,true);
        $access_token = $array['access_token'];

        return $access_token;
    }
?>
<script type="text/javascript">
    window.onload=function(){
    // alert('<?php echo $json; ?>');
}
</script>
    <div class="container scroll" style="overflow:scroll;">
        <div class="head">
            <img id="head-icon" src="<?php echo $imgurl; ?>" alt="X" style="">
             <h1 id="username"><? echo $arr['nickname']; ?></h1>
             <h5 ><?php echo $sex; ?>&emsp;&emsp;<? echo $arr['province'] ?>&nbsp;&nbsp;<?$arr['city']?></h5>             
        </div>

        <hr>
        
        <div class="sign" style="text-align:center;">
            <h5>个性签名</h5>
            <div>
                <textarea id="usersignature" onchange="onTextChange()" rows="4" cols="25" maxlength="48"><?php echo $design; ?></textarea>
                <span class="glyphicon glyphicon-pencil" id="modifySig"></span>
            </div>
            <!-- <div id="editable">
                
            </div> -->
            
        </div>
        <hr style="margin-top: 0px;">

        <div class="identity">
             <h5 >专属身份标识符</h5>             
             <p id="identity-code"><?php echo $openid; ?></p>
        </div>
        <br><br>

        <div class="btn-back">
            <a id="btn-back" href="index.php?openid=<?php echo $openid; ?>">
                <span>BACK</span><br>
                <span class="glyphicon glyphicon-arrow-left"></span>
            </a>
        </div>
        <br><br>
        


    </div>
    <script>
        setShareInfo({
			title:   '象记',
			summary: '——最好用的象限管理法',
			pic:     'https://www.kadlxt.com/kadlxt/img/img4.png',
			url:     "https://www.kadlxt.com/kadlxt/loginByShare.php"
		});


        function onTextChange(){
            var signafic = document.getElementById('usersignature').value;
            $.ajax({  
                type: "POST",  
                url:"./php/modifydesign.php?openid=<?php echo $openid; ?>&signafic="+signafic,    
                async: true,  
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status);
                    alert(XMLHttpRequest.readyState);
                    alert(textStatus);
                },  
                success: function(data) {  
                    document.getElementById('usersignature').value = data;
                    //接收后台返回的结果 
                    // alert(data);
                }  
            }); 
        }
        
    </script>
</body>
</html>