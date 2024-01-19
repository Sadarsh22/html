<?php 

    include 'login_credentials.php';
    $conn = new mysqli($hostname, $username, $password, 'adarsh');

    $id=$_GET['id'];
    $mode=$_GET['mode'];
    $where = '';

//  for implementing the all search field logic together

    if($mode == "searchAll")
    {
        $searchVal = $_GET['searchbar'];
        $searchBetween = $_GET['selectNumber'];
        $start = $_GET['start'];
        $end = $_GET['end'];

        if($searchVal)
        {
            $where .= "And (first_name like '%".$searchVal."%'"
            ." or last_name like '%".$searchVal."%'"
            ." or email like '%".$searchVal."%'"
            ." or phone like '%".$searchVal."%')".' ';
        }
        if($searchBetween != 'Choose a number')
        {
            if($searchBetween == "Today")
            $where .= "AND (date(created_on_date) = CURRENT_DATE)";
            else if($searchBetween == 'Yesterday')
            $where .= "AND (date(created_on_date) = (CURRENT_DATE - INTERVAL 1 day))";
            else if($searchBetween == 'Last 7 days')
            $where .= "AND (date(created_on_date) >= (CURRENT_DATE - INTERVAL 7 day))";
            else if($searchBetween == 'Last 1 month')
            $where .= "AND (date(created_on_date) >= (CURRENT_DATE - INTERVAL 1 month))";
            else if($searchBetween == 'Last 3 month')
            $where .= "AND (date(created_on_date) >= (CURRENT_DATE - INTERVAL 3 month))";
        }
        else
        {
            if($start && $end)
            {
                $where.="AND (date(created_on_date) between '$start' and '$end')";
            }
            else
            {
                if($start)
                {
                    $where.="AND (date(created_on_date) >= '$start' and CURRENT_DATE )";
                }
                if($end)
                {
                    $where.="AND (date(created_on_date) >= '01-01-2023' and '$end' )";
                }
            }
        }
    }

// for deleing multiple rows at once

if($mode == 'deleteAll')
{
    $arr = $_REQUEST['id'];
    $arr=explode(',',$arr);
    foreach($arr as $item)
    {
        $id = $item;
        $sql = "update customer set deleted = 1 where id = $id";
        mysqli_query($conn,$sql);
    }
}



// for deleting a single row 
    if($mode == 'delete')
    {
        $curr_id = $_REQUEST['id'];
        $delQuery =  "UPDATE customer SET deleted=1 WHERE id=$curr_id";
        mysqli_query($conn, $delQuery);
        // $("").load("";)
    }
    

// for displaying the selected data
    $query = "select * from customer where deleted=0"." ".$where;
    $queryResult = mysqli_query($conn, $query);
    $c = 0;
    if($mode != 'deleteAll')
    {
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
          <th>created on date</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Image</th>
          <th>Action</th>
        </tr><div id='listing_display'>";
    }
    while ($queryRow = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
    ?>
    <tr id='$c'>
        <td><input type='checkbox' id='all' name='all' value='<?php echo $queryRow['id'] ?>' onclick='singleCheckbox()''/></td>
        <td><?php echo $queryRow['created_on_date'];?></td>
        <td><?php echo $queryRow['first_name']; ?></td>
        <td><?php echo $queryRow['last_name']; ?></td>
        <td><?php echo $queryRow['email']; ?></td>
        <td><?php echo $queryRow['phone']; ?></td>
        <td> <img src="uploads/<?php echo $queryRow['file_name']; ?>" height="100px" width="100px"> </td>
        <td> <a href="#" > <button onclick="deleteBtn(<?php echo $queryRow['id'] ?> , 'view')"> View </button> </a> | 
        <a href="index.php?id=<?php echo $queryRow['id']?> &mode=edit"> <button> Edit </button> </a> | 
        <a href="#" class='Delete'> <button onclick="validateDelete(<?php echo $queryRow['id'] ?> , 'delete')" > Delete </button> </a></td></tr>
<?php
        $c++;
    }

?>

<?php 

// to view the entire data(modal)
if($mode == 'view')
{
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