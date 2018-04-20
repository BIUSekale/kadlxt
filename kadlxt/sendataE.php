

<?php 
    include('php/conn.php');

    //获取access_token
    $myfile = fopen("./data/accessToken.txt", "r") or exit("Unable to open file!");
    $oldas = fgets($myfile);
    fclose($myfile);
    if ($oldas == "") {
        // echo("first time");
        $oldas = getAccessToken();
    }
    $astokon = $oldas;

    function getAccessToken(){
        $getaskt = "https://api.uni.qq.com/cgi-bin/token_v2?appid=test_835056957&secret=Q9Yc5yj70Jcnnsj4";
        $json = file_get_contents($getaskt);
        $array = json_decode($json,true);
        $access_token = $array['access_token'];

        return $access_token;
    }

    $quadrants = array('jinzhong','jinji','important','inconsequential');
    //将所有table名放入数组
    function list_tables($database)
    {  
        $rs = $GLOBALS['conn']->query("SHOW TABLES FROM $database");  
        
        $tables = array(); 
        $i=0;
        while ($row =$rs->fetch_assoc()){  
            $tables[$i] = $row['Tables_in_emerynhv_db1'];
            $i++;
        }  
     
        $rs->free_result();  
        
        return $tables;  
    }

    $tablearr = array();
    $tablearr += list_tables("emerynhv_db1");

    
    $count = count($tablearr);

    //对每个table名（即openid）进行推送
    for($i=0;$i<$count;$i++){
        
        $openid = $tablearr[$i];
        if ($openid == 'userinfo'){
            continue;
        }
        $content = '';
        $num = 0;
        echo $openid.'<br>';

        for ($j=0; $j < 4; $j++) { 

            //按预设象限顺序将记录加入content
            $sql1 = 'SELECT * FROM '.$openid.' WHERE quadrant="'.$quadrants[$j].'" ORDER BY idin';
            
            $result1= $conn->query($sql1);
            $k = 1;
            while($row1 =  $result1->fetch_assoc()){
                $index = $num + $k++;
                $content .= $index.'. '.$row1['name'].' ';
            }
            
            //统计当前的总记录数
            $sql2 = 'SELECT count(*) as counts FROM '.$openid.' WHERE quadrant="'.$quadrants[$j].'"';
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $num += $row2["counts"];
           
        }
        echo $content;
        if ($content == "")
            continue;
        $data = array("tousername" => $openid, "templateid" => "45a737cac92c11e7939854520092e2e4", 
        "data" => array("first"=>array("value"=>"您好，这是您明日的待办事项整理。"),"keynote1"=>array("value"=>$content)),
        "button"=> array("button1"=>array("value"=>"https://api.uni.qq.com/connect/oauth2/authorize?appid=test_835056957&redirect_uri=https://www.kadlxt.com/kadlxt/login.php&response_type=code&state=111")));
        $datatopass = json_encode($data);
        echo $datatopass;
        $ch = curl_init('https://api.uni.qq.com/cgi-bin/message/template/send?access_token='.$astokon);
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
    }
    $conn->close();

    ?>
