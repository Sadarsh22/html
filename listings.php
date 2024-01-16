<?php 

$where = '';
if($_REQUEST['mode'] == 'search')
{
    $searchVal = $_REQUEST['val']; 
    $where = "And first_name like '%".$searchVal."%'"
    ." or last_name like '%".$searchVal."%'"
    ." or email like '%".$searchVal."%'"
    ." or phone like '%".$searchVal."%'";

}


if($_REQUEST['mode'] == 'delete')
{
    error_reporting(E_ALL);
    include 'login_credentials.php';
    $conn = new mysqli($hostname, $username, $password, 'adarsh');
    $curr_id = $_REQUEST['id'];
    $delQuery =  "UPDATE customer SET deleted=1 WHERE id=$curr_id";
    mysqli_query($conn, $delQuery);

    header("Location:http://10.10.10.17/listings.php#");
}

if($_REQUEST['id'] && $_REQUEST['mode'] == 'deleteAll')
{
    $arr = $_REQUEST['id'];
    $arr=explode(',',$arr);
    foreach($arr as $item)
    {
        include 'login_credentials.php';
        $conn = new mysqli($hostname, $username, $password, 'adarsh');
        $id = $item;
        $sql = "update customer set deleted = 1 where id = $id";
        mysqli_query($conn,$sql);
    }
    header("Location:http://10.10.10.17/listings.php#");
}
?>



<html>
<title>Index Page</title>

<head>
</head>

<body>

    <style>
        #header {
            margin: auto;
            width: 50%;
            padding: 30px;
            text-align: center;
        }

        #deleteAll {
            margin-left: 17%;
            margin-top: 1%;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>


        $(document).ready(function() {
            $('.Delete').click(function() {
                if(confirm("are you sure you want to delete"))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });

            $('#search').click(function(){
                var val = $('#searchbar').val();
                window.location.href="http://10.10.10.17/listings.php?val="+val+"&mode=search";
            });
        })


        function selectAllCheckboxes() {
            let val = document.getElementsByName("all");

            if (val[0].checked == true) {
                for (let i = 0; i < val.length; i++) {
                    val[i].checked = true;
                }
            } else if (val[0].checked == false) {
                for (let i = 0; i < val.length; i++) {
                    val[i].checked = false;
                }
            }
        }

        function singleCheckbox() {
            let val = document.getElementsByName("all");
            if (val[0].checked == true) {
                let c = 0;
                for (let i = 1; i < val.length; i++) {
                    if (val[i].checked == false) c++;
                }
                if (c == val.length - 1) val[0].checked = false;
                else val[0].checked = false;
            } else {
                let c = 0;
                for (let i = 1; i < val.length; i++) {
                    if (val[i].checked == true) c++;
                }
                if (c == val.length - 1) val[0].checked = true;
            }
        }

        function validateDeleteAll() {
            var delId=[];
            let check = document.getElementsByName("all");
            let c = 0;
            for (let i = 0; i < check.length; i++) 
            {
                if (check[i].checked == true) {
                console.log(check[i].value);
               
                delId[c]=check[i].value;
                c++;
                
            }
            }
            if (c == 0) {
                alert("please select atleast one record to delete");
                return false;
            } else if (c > 0) {
                 if(confirm("are you sure you want to delete"))
                    window.location.href="http://10.10.10.17/listings.php?id="+delId+"&mode=deleteAll";
                else
                    window.location.href="http://10.10.10.17/listings.php";
            }
            return true;
        }

    </script>

    <div id='header'>
        <input type="text" name="searchbar" id="searchbar" placeholder="Search" />&nbsp;
        <input type="button" name="search" id="search" value="Search" />&nbsp;
        <a href="index.php"><button>+New</button></a>
    </div>

    <?php

    include 'login_credentials.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conn = new mysqli($hostname, $username, $password, 'adarsh');
    

    $query = "select id, first_name,last_name,email,phone,file_name  from customer where deleted=0"." ".$where;
    $queryResult = mysqli_query($conn, $query);
    $c = 0;
    echo "<table border='1' bordercolor='orange' align='center' id='listingTable'>";
    echo "<tr>
      <th>
        <input
          type='checkbox'
          id='all'
          name='all'
          value='0'
          onclick='selectAllCheckboxes()'
        />
      </th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Image</th>
      <th>Action</th>
    </tr>";
    while ($queryRow = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
    ?>
        <tr id='$c'>
            <td><input type='checkbox' id='all' name='all' value='<?php echo $queryRow['id'] ?>' onclick='singleCheckbox()''/></td>
        <td><?php echo $queryRow['first_name']; ?></td>
        <td><?php echo $queryRow['last_name']; ?></td>
        <td><?php echo $queryRow['email']; ?></td>
        <td><?php echo $queryRow['phone']; ?></td>
        <td> <img src="uploads/<?php echo $queryRow['file_name']; ?>" height="100px" width="100px"> </td>
        <td> <a href="view.php?id=<?php echo $queryRow['id']; ?>">View</a> | 
        <a href="index.php?id=<?php echo $queryRow['id']?> &mode=edit"> <button> Edit </button> </a> | 
        <a href="listings.php?id=<?php echo $queryRow['id'] ?> &mode=delete " class='Delete'> <button > Delete </button> </a></td></tr>
<?php
        $c++;
    }
?>
</table>
    <button id="deleteAll" onclick="validateDeleteAll()">Delete All</button>
</body>

</html>