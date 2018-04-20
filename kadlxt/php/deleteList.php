<?php
    include("conn.php");

    $id = $_GET["id"];
    
    $sql = 'DELETE FROM `'.$_GET['openid'].'` WHERE id="'.$id.'"';

    if ($conn->query($sql) === TRUE) {
    	echo "删除成功";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();