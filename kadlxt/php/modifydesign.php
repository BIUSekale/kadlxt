<?php
	include('./conn.php');
	$signafic = $_GET['signafic'];
	$openid=$_GET['openid'];
	$sql = "UPDATE `userinfo` SET `signafic` = '".$_GET['signafic']."' WHERE `userinfo`.`openid` = '".$_GET['openid']."'";
	echo $signafic;
	$conn->query($sql);
	$conn->close();
?>
