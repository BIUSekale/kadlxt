
<?php
    include("conn.php");

    
    /**
     * 输出单个list
     * 
     * $row: 数据库的一行
     */
    function displayList($row){
        echo '<div class="list" '.'id="'.$row['id'].'" data-idin="'.$row["idin"].'" onclick = "checkOrKnock()">';
        echo '<span class="glyphicon glyphicon-option-vertical"></span>';
        echo '<input type="checkbox" id="input'.$row['id'].'">';
        echo '<label for="input'.$row['id'].'"></label>';
        echo '<span class="title">';
        echo $row["name"];
        echo '</span>';
        echo '</div>';
    }

    /**
     * 获取数据
     */
    function getData(){

        $sql = 'SELECT * FROM `'.$_GET['openid'].'` WHERE quadrant= "'.$_GET['quadrant'].'" ORDER BY `idin`';
        $rsimportant= $GLOBALS['conn']->query($sql);
        if($rsimportant->num_rows>0){
            while($row = $rsimportant->fetch_assoc()){
                displayList($row);
            }
        }
        $rsimportant->free();
        $GLOBALS['conn']->close();
    }

    getData();

?>