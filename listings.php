<?php
$where = '';
?>

<html>
<title>Listing Page</title>

<head>
    <link rel="stylesheet" href=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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

        #modal {
            background-color: goldenrod;
            position: fixed;
            /* display: none; */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
        }

        #details {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            letter-spacing: 2px;
            line-height: 1.5;
            /* text-transform: uppercase; */
            font-size: 18px;
            font-weight: bold;
            font-family: "Arial", sans-serif;
            color: #333;
            text-align: left;
        }

        #modalButton {
            background-color: bisque;
            font-size: 25px;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        //master function for ajax calls
        function deleteBtn(id, md) {
            $(document).ready(function() {
                $.ajax({
                        type: 'GET',
                        url: "ajaxData.php",
                        data: {
                            id: id,
                            mode: md
                        }
                    })
                    .done(function(msg) {
                        alert('ajax success');
                        $('#listingTable').html(msg);
                    })
            });
        }
    </script>

    <script>
        // to clear the search field 
        function callClear()
        {
            $(document).ready(function(){
                $('#searchbar').val('');
                $('#selectNumber').val('Choose a number');
                $('#startDate').val('');
                $('#endDate').val('');
                callSearch();
            });
        }

        //to search based on the given user preferences
        function callSearch()
        {
            $(document).ready(function(){

                var searchbar = $('#searchbar').val();
                var selectNumber = $('#selectNumber').val();
                let start = $('#startDate').val();
                let end = $('#endDate').val();

                $(document).ready(function() {
                $.ajax({
                        type: 'GET',
                        url: "ajaxData.php",
                        data: {
                            searchbar: searchbar,
                            mode: 'searchAll',
                            selectNumber:selectNumber,
                            start:start,
                            end:end
                        }
                    })
                    .done(function(msg) {
                        $('#listingTable').html(msg);
                    })
                });

            });
        }

        //to delete single records
        function validateDelete(id, mode) {
            if (confirm("are you sure you want to delete"))
                deleteBtn(id, mode);
            else
                return false;
        }

        //to select all checkboxes
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

        //to delete multiple records
        function validateDeleteAll() {
            var delId = [];
            let check = document.getElementsByName("all");
            let c = 0;
            for (let i = 0; i < check.length; i++) {
                if (check[i].checked == true) {
                    delId[c] = check[i].value;
                    c++;
                }
            }
            
            if (c == 0) {
                alert("please select atleast one record to delete");
                return false;
            } else if (c > 0) {
                if (confirm("are you sure you want to delete")) {
                    delId = delId.toString();
                    deleteBtn(delId, "deleteAll");
                }
            }
            return true;
        }

        $(document).ready(function(){
        var myArray = ['Today' , 'Yesterday', 'Last 7 days', 'Last 1 month', 'Last 3 months'];
        for (let i = 0; i < myArray.length; i++) {
        $("#selectNumber").append("<option value='" + myArray[i] + "'>" + myArray[i] + "</option>");
        }

        });
        
    </script>

    <div id='header'>
        <input type="text" name="searchbar" id="searchbar" placeholder="Search" value=""/>&nbsp;

            <select id="selectNumber">
            <option>Choose a number</option>
            </select>   

        <a href="index.php"><button>+New</button></a>

        <h3>To search between given dates</h3>
        <input type="date" id="startDate" value=""/>
        <input type="date" id="endDate" value=""/>
        <button onclick="callSearch()">Search</button>

        <button onclick="callClear()" >clear</button>

    </div>

    <?php

    include 'login_credentials.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conn = new mysqli($hostname, $username, $password, 'adarsh');


    $query = "select * from customer where deleted=0" . " " . $where;
    $queryResult = mysqli_query($conn, $query);
    $c = 0;

    echo "<table border='1' bordercolor='orange' align='center' id='listingTable' class='table table-striped'>";
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
        <td> <a href="#" class="view" ><button onclick="deleteBtn(<?php echo $queryRow['id'] ?> , 'view')"> View </button></a> |
                <a href="index.php?id=<?php echo $queryRow['id'] ?> &mode=edit"> <button> Edit </button> </a> |
                <a href="#" class='Delete'> <button onclick="validateDelete(<?php echo $queryRow['id'] ?> , 'delete')"> Delete </button> </a>
            </td>
        </tr>

    <?php
        $c++;
    }
    ?>
    </div>
    </table>
    <h3 id="noRecord" style="text-align: center;" ></h3>
    <button id="deleteAll" onclick="validateDeleteAll()">Delete All</button>
</body>

</html>
<?php
 if($c == 0)
 {
     echo("<script>
     $('#deleteAll').hide();
     $('#noRecord').html('No records found');
     </script>
     ");
 }
?>