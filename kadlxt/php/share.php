<?php

	include("conn.php");

	
	$today = strtotime(date("y-m-d"));
	
	//到截止日期的剩余天数
	$totoday = (strtotime($_GET["pretime"])-$today)/3600/24;
	
	//再减去事情预计完成需要的时间，即剩下可挥霍的时间
	$p = $totoday-$_GET["preday"]-$_GET["prehour"]/24;
	$name = $_GET['name'];
	$pretime = $_GET['pretime'];
	$preday = $_GET['preday'];
	$prehour = $_GET['prehour'];
	$importance = $_GET['importance'];

	//若可挥霍的时间越短，则紧急程度越高
	if($p<=0) {
		$Emergency=0;
	}
	else {
		$Emergency = ($p+$_GET["importance"])*(1/$p);
	}

	
	if ( $_GET['importance'] >3 && $Emergency < 5){
		$quadrant = 'important';
	} elseif ($_GET['importance'] >3 && $Emergency >= 5) {
		$quadrant = 'jinzhong';
	} elseif ($_GET['importance'] <= 3 && $Emergency < 3) {
		$quadrant = 'inconsequential';
	} else {
		$quadrant = 'jinji';
	}
	$sql1 = 'SELECT count(*) as counts FROM `'.$_GET['openid'].'` WHERE quadrant="'.$quadrant.'"';
	$result = $conn->query($sql1);
    if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$idin = $row["counts"];
	}
	$sql2 = "INSERT INTO `".$_GET['openid']."`(name,detail,pretime,preday,prehour,importance,quadrant,idin)
		VALUES
		('".$name."','".$detail."','".$pretime."','".$preday."','".$prehour."','".$importance."','".$quadrant."','".$idin."')";
	if ($conn->query($sql2) === TRUE) {
		echo "新记录插入成功";
	} else {
    	echo "Error: " . $sql2 . "<br>" . $conn->error;
	}

	$conn->close();


	 	
?>
