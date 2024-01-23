<?php
 ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        
$id = $_REQUEST['id'];
include_once('conn.php');
$sql = "update demo set deleted = 1 where id = $id";
mysqli_query($conn, $sql);
?>

<table cellspacing=4 cellpadding=4 align="center" style="margin-top: 50px;" border="1" id="mytable">
    <tr>
        <th>name</th>
        <th>image</th>
        <th>action</th>
    </tr>

    <?php

    $sql = "select * from demo where deleted = 0";
    $res = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($res)) {
    ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['img'] ?></td>
            <td><button type="button" onclick="del(<?php echo $row['id'] ?>)">delete</button></td>
        </tr>
    <?php
    }
    ?>
</table>