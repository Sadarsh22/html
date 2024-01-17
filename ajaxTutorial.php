

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>

    $(document).ready(function() {

      $('#btn').click(function() {

        $.ajax({
            type : 'GET',
            url: "arko.php",
            data: {
              name: "John",
              location: "Boston12"
            }
            })
          .done(function(msg) { 
            alert("hello");
            $('#heading').html(msg);
            })
          .fail(function(){
            alert("ajax failed");
            });
        });
    });
  </script>


  <h1 id="heading" >hello! Welcome to my website</h1>
  <button type="button" id='btn'>click Me</button>
</body>

</html>