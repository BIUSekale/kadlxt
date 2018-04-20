
<?php

	include("conn.php");

	
	$today = strtotime(date("y-m-d"));
	
	//到截止日期的剩余天数
	$totoday = (strtotime($_POST["pretime"])-$today)/3600/24;
	
	//再减去事情预计完成需要的时间，即剩下可挥霍的时间
	$p = $totoday-$_POST["preday"]-$_POST["prehour"]/24;

	//若可挥霍的时间越短，则紧急程度越高
	if($p<=0) {
		$Emergency=0;
	}
	else {
		$Emergency = ($p+$_POST["importance"])*(1/$p);
	}

	
	if ( $_POST['importance'] >3 && $Emergency < 5){
		$quadrant = 'important';
	} elseif ($_POST['importance'] >3 && $Emergency >= 5) {
		$quadrant = 'jinzhong';
	} elseif ($_POST['importance'] <= 3 && $Emergency < 3) {
		$quadrant = 'inconsequential';
	} else {
		$quadrant = 'jinji';
	}

	//将当前象限的列表个数给$idin
	$sql1 = 'SELECT count(*) as counts FROM `'.$_GET['openid'].'` WHERE quadrant="'.$quadrant.'"';
	$result = $conn->query($sql1);
    if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$idin = $row["counts"];
	}
 
	if($_GET["id"] == ""){
		$sql2 = "INSERT INTO `".$_GET['openid']."`(name,detail,pretime,preday,prehour,importance,quadrant,idin)
		VALUES
		('$_POST[name]','$_POST[detail]','$_POST[pretime]','$_POST[preday]',
		'$_POST[prehour]','$_POST[importance]','".$quadrant."',$idin)";
	} else {
		$sql2 = "INSERT INTO `".$_GET['openid']."`(id,name,detail,pretime,preday,prehour,importance,quadrant,idin)
	VALUES
	('$_GET[id]','$_POST[name]','$_POST[detail]','$_POST[pretime]','$_POST[preday]',
	'$_POST[prehour]','$_POST[importance]','".$quadrant."',$idin)";
	}
	
	if ($conn->query($sql2) === TRUE) {
		echo "新记录插入成功";
	} else {
    	echo "Error: " . $sql2 . "<br>" . $conn->error;
	}

	$conn->close();

?>
