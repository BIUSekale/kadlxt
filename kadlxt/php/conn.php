<?php
	header("Content-type: text/html; charset=utf-8"); 
 	$servername = "localhost";
 	$username = "emerynhv_dbdb1";
 	$password = "shijijinbang*";
	$database ="emerynhv_db1";

	//创建链接
	$conn = new mysqli($servername,$username,$password,$database);
	
	mysqli_query($conn,"set names 'utf8' ");   
	mysqli_query($conn,"set character_set_client=utf8");   
	mysqli_query($conn,"set character_set_results=utf8");   
	//检测连接是否成功
	if(mysqli_connect_error()){
		die("连接失败:".$conn->connect_error);
	}
?>