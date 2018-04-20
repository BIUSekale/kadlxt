<?php
    include("conn.php");

    $id = $_POST["id"];
    $idin = $_POST["idin"];
    $quadrant = $_POST["quadrant"];

    $sql = 'UPDATE `'.$_GET['openid'].'` SET idin="'.$idin.'", quadrant="'.$quadrant.'" WHERE id="'.$id.'"';

    if ($conn->query($sql) === TRUE) {
    	echo "修改成功".$sql;
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();