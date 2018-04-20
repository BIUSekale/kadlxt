<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script> 
</head>
<body>
    
</body>
</html>
<?php
// $getaskt = "https://api.uni.qq.com/cgi-bin/token_v2?appid=test_835056957&secret=Q9Yc5yj70Jcnnsj4";

    
//     $json = file_get_contents($getaskt);
//     $array = json_decode($json,true);
//     $access_token = $array['access_token'];

    // //写入文件
    // $myfile = fopen("data/access.txt", "w") or die("Unable to open file!");
    // fwrite($myfile, date("Y-m-d h:i:sa"));
    // fclose($myfile);
    $data = array("tousername" => "6A155256B9C94888CA48C076325E64C8", "templateid" => "45a737cac92c11e7939854520092e2e4", 
    "data" => array("first"=>array("value"=>"你好"),"keynote1"=>array("value"=>"123456")),
    "button"=> array("button1"=>array("value"=>"https://api.uni.qq.com/connect/oauth2/authorize?appid=test_835056957&redirect_uri=https://www.kadlxt.com/kkk/login.php&response_type=code&state=111")));
    //     "tousername":"6A155256B9C94888CA48C076325E64C8",
    //     "templateid":"45a737cac92c11e7939854520092e2e4",
    //     "data":{ 
    //         "first":{ 
    //             "value":"您好，这是您本日的待办事项提醒（按紧急程度排序）。" 
    //         },
    //         "keynote1":{ 
    //             "value":"ffff" 
    //         }
    //     }
    //     "button":{
    //         "button1":{ 
    //             "value":"https://api.uni.qq.com/connect/oauth2/authorize?appid=test_835056957&redirect_uri=https://www.kadlxt.com/kkk/login.php&response_type=code&state=111"
    //         } 
    //     }
    // }
    $datatopass = json_encode($data);
    echo $datatopass;
    $ch = curl_init('https://api.uni.qq.com/cgi-bin/message/template/send?access_token=5bf73453df2b8cafe613cea6d3bc09ac');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$datatopass);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($datatopass))
    );
     
    $result = curl_exec($ch);
    curl_close($ch); 
    echo $result;
?>
<script>
    

// $.post("https://api.uni.qq.com/cgi-bin/message/template/send?access_token=5bf73453df2b8cafe613cea6d3bc09ac",
//     {
//         "tousername":"6A155256B9C94888CA48C076325E64C8",
//         "templateid":"45a737cac92c11e7939854520092e2e4",
//         "data":{ 
//             "first":{ 
//                 "value":"您好，这是您本日的待办事项提醒（按紧急程度排序）。" 
//             },
//             "keynote1":{ 
//                 "value":"ffff" 
//             }
//         }
//     },
//         function(data,status){
//         alert("数据: \n" + data + "\n状态: " + status);
//     },"jsonp");
    
    

        // $.ajax({
        //     type: "POST",
        //     url:  "https://api.uni.qq.com/cgi-bin/message/template/send?access_token=2d7652c013489c728ba3148fde00c211",
        //     data: {
        //         "tousername":"6A155256B9C94888CA48C076325E64C8",
        //         "templateid":"45a737cac92c11e7939854520092e2e4",
        //         "data":{ 
        //             "first":{ 
        //                 "value":"您好，这是您本日的待办事项提醒（按紧急程度排序）。" 
        //             },
        //             "keynote1":{ 
        //                 "value":"ffff" 
        //             }
        //         }
        //         // "button":{
        //         //     "button1":{ 
        //         //         "value":"https://api.uni.qq.com/connect/oauth2/authorize?appid=test_835056957&redirect_uri=https://www.kadlxt.com/kkk/login.php&response_type=code&state=111"
        //         //     } 
        //         // }
        //     },
        //     dataType: "jsonp",
        //     success: function(){
        //         alert("消息推送成功");
        //     },
        //     error: function(XMLHttpRequest, textStatus, errorThrown) {
        //             alert("error");
		// 			alert(XMLHttpRequest.status);
		// 			alert(XMLHttpRequest.readyState);
		// 			alert(textStatus);
		// 		}
           
        // });

</script>