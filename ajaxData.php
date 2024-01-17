<?php 
    $id=$_GET['id'];
    $mode=$_GET['mode'];

// for searching the desired value

$where = '';
if($mode == 'search')
{
    $searchVal = $id; 
    $where = "And first_name like '%".$searchVal."%'"
    ." or last_name like '%".$searchVal."%'"
    ." or email like '%".$searchVal."%'"
    ." or phone like '%".$searchVal."%'";

}

// for deleing multiple rows at once

if($mode == 'deleteAll')
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
}



// for deleting a single row 
    if($mode == 'delete')
    {
        error_reporting(E_ALL);
        include 'login_credentials.php';
        $conn = new mysqli($hostname, $username, $password, 'adarsh');
        $curr_id = $_REQUEST['id'];
        $delQuery =  "UPDATE customer SET deleted=1 WHERE id=$curr_id";
        mysqli_query($conn, $delQuery);
    }
    
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
    </tr><div id='listing_display'>";
    while ($queryRow = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
    ?>
    <tr id='$c'>
        <td><input type='checkbox' id='all' name='all' value='<?php echo $queryRow['id'] ?>' onclick='singleCheckbox()''/></td>
        <td><?php echo $queryRow['first_name']; ?></td>
        <td><?php echo $queryRow['last_name']; ?></td>
        <td><?php echo $queryRow['email']; ?></td>
        <td><?php echo $queryRow['phone']; ?></td>
        <td> <img src="uploads/<?php echo $queryRow['file_name']; ?>" height="100px" width="100px"> </td>
        <td> <a href="#" > <button onclick="deleteBtn(<?php echo $queryRow['id'] ?> , 'view')"> View </button> </a> | 
        <a href="index.php?id=<?php echo $queryRow['id']?> &mode=edit"> <button> Edit </button> </a> | 
        <a href="#" class='Delete'> <button onclick="deleteBtn(<?php echo $queryRow['id'] ?> , 'delete')" > Delete </button> </a></td></tr>
<?php
        $c++;
    }

?>

<?php 

// to view the entire data(modal)
if($mode == 'view')
{
    include 'login_credentials.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conn = new mysqli($hostname, $username, $password, 'adarsh');


    $query = "select * from customer where deleted=0 and id=$id";
    $queryResult = mysqli_query($conn, $query);
    while ($queryRow = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
?>

    <div id="modal">
      <h1>User Details</h1>
      <p id="details">First Name: <?php echo $queryRow['first_name'] ?></p>
      <p id="details">Last Name: <?php echo $queryRow['last_name']?></p>
      <p id="details">Address: <?php echo $queryRow['address']?> </p>
      <p id="details">Email: <?php echo $queryRow['email']?> </p>
      <p id="details">Phone: <?php echo $queryRow['phone']?> </p>
      <p id="details">Gender: <?php echo $queryRow['gender']?> </p>
      <p id="details">Date Of Birth: <?php echo $queryRow['date_of_birth']?></p>
      <p id="details">Language: <?php echo $queryRow['language']?></p>
      <p id="details">Country: <?php echo $queryRow['country']?></p>
      <p id="details" style="display: grid;">Profile Picture: <img src="uploads/<?php echo $queryRow['file_name']; ?>" height="100px" width="100px"></p>
      <button id="modalButton">Close</button>
    </div>

        <script>
    $(document).ready(function () {
            $(".view").click(function () {
                $('#modal').fadeIn();
            });
            $('#modalButton').click(function () {
                $('#modal').fadeOut();
            });
        });
        </script>

<?php 
    }
}
?>
