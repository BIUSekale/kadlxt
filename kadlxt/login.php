<?php 
    $getcode = $_GET['code'];
    $time = date("h:i:s:u");
    // echo "测试页面，看见请无视并且稍后再进入";
    // $geturl = "https://api.uni.qq.com/sns/oauth2/access_token?appid=test_835056957&secret=Q9Yc5yj70Jcnnsj4&code=".$getcode."&grant_type=authorization_code";
    // $jsn = file_get_contents($geturl); 
    // $array1 = json_decode($jsn,true);
    // $openid = $array1['openid'];
    // echo $openid;

    function curl_get_contents($url,$timeout=2) { 
        $curlHandle = curl_init(); 
        curl_setopt( $curlHandle , CURLOPT_URL, $url ); 
        curl_setopt( $curlHandle , CURLOPT_RETURNTRANSFER, 1 ); 
        curl_setopt( $curlHandle , CURLOPT_TIMEOUT, $timeout ); 
        $result = curl_exec( $curlHandle ); 
        curl_close( $curlHandle ); 
        return $result; 
    } 
    $re = curl_get_contents("https://api.uni.qq.com/sns/oauth2/access_token?appid=test_835056957&secret=Q9Yc5yj70Jcnnsj4&code=".$getcode."&grant_type=authorization_code");
    // echo $re;
    $array1 = json_decode($re,true);
    $openid = $array1['openid'];
    // echo $openid;

    $myfile = fopen("./log.txt", "a") or die("Unable to open file!");
    fwrite($myfile, $jsn.$time.'server1='.$_SERVER['REMOTE_ADDR'].'server2='.$_SERVER['HTTP_X_FORWARDED_FOR']);
    fclose($myfile);

    if(strlen($openid)!=32){
        die("未检测到openid,请在QQ中打开或者检查网络连接并重试");
    }
?>
<script>
    var openid = "<?php echo $openid; ?>"
    window.location.href = "index.php?openid="+openid;
</script>