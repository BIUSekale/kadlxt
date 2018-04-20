<?php
// ignore_user_abort(true); // 后台运行
// set_time_limit(0); // 取消脚本运行时间的超时上限
// set_time_limit(0);
$getaskt = "https://api.uni.qq.com/cgi-bin/token_v2?appid=test_835056957&secret=Q9Yc5yj70Jcnnsj4";

// do{
    
    $json = file_get_contents($getaskt);
    $array = json_decode($json,true);
    $access_token = $array['access_token'];

    //写入文件
    $myfile = fopen("../data/accessToken.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $access_token);
    fclose($myfile);

//     sleep(60); // 休眠1小时
// } while(true);
?>