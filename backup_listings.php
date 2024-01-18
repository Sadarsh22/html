<?php
$where = '';
?>

<html>
<title>Listing Page</title>

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
                        $('#listingTable').html(msg);
                    })
            });
        }
    </script>

    <script>

        function searchBetween()
        {
            $(document).ready(function(){

            let start = $('#startDate').val();
            let end = $('#endDate').val();
            console.log(start);

            if(start && end)
            {
                if(start <= end)
                deleteBtn(start+' '+end,"searchBetween");
                else
                alert("please enter the valid date");
            }
            else
            {
                alert("please select the date");
            }
            });
        }


        function searchPeriod(){
            var val = $('#selectNumber').val();
            alert(val);
            deleteBtn(val,'searchPeriod');
        }



        function validateDelete(id, mode) {
            if (confirm("are you sure you want to delete"))
                deleteBtn(id, mode);
            else
                return false;
        }

        $(document).ready(function(){
                $('#search').click(function() {
                var val = $('#searchbar').val();
                deleteBtn(val, "search");
            });
        });


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
        <input type="text" name="searchbar" id="searchbar" placeholder="Search" />&nbsp;
        <input type="button" name="search" id="search" value="Search" />&nbsp;

            <select id="selectNumber">
            <option>Choose a number</option>
            </select>   
            <button onclick="searchPeriod()">Search </button>

        <a href="index.php"><button>+New</button></a>

        <h3>To search between given dates</h3>
        <input type="date" id="startDate" value=""/>
        <input type="date" id="endDate" value=""/>
        <button onclick="searchBetween()">Search</button>

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
    <button id="deleteAll" onclick="validateDeleteAll()">Delete All</button>

</body>

</html>