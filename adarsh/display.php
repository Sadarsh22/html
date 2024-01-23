<?php
include_once('conn.php');
$sql = 'select * from demo where deleted = 0';
$res = mysqli_query($conn, $sql);
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    

function del(id)
{
    alert(id);
    $(document).ready(function(){
        $.ajax({
        type:'POST',
        url:'abc.php',
        data:{
            id:id
        }
    })
    .done(function(msg){
        $('#mytable').html(msg);
    });
    });
}

</script>
<a href="registration.php" ><button style="margin-left: 60%;" type="button">new</button></a>

<table cellspacing=4 cellpadding=4 align="center" style="margin-top: 50px;" border="1" id="mytable">
    <tr>
        <th>name</th>
        <th>image</th>
        <th>action</th>
    </tr>
    <?php

    while ($row = mysqli_fetch_assoc($res)) {
    ?>
        <tr>
            <td><?php echo ($row['name']) ?></td>
            <td><?php echo ($row['img']) ?></td>
            <td><button type="button" onclick="del(<?php echo $row['id'] ?>)">delete</button></td>
        </tr>
    <?php
    }

    ?>
</table>