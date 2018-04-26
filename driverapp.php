<!DOCTYPE html>
<?php
require 'actions/db_connect.php';

$con = connect_2_db();

if(isset($_GET["id"])) {
  $driver = $_GET["id"];
}
else {
  ?>
  <script type="text/javascript">
  var id = prompt("Driver id missing. Please enter");
  if(id == null || id == "") {
    window.location.href = "driverapp.php?id=1";
  }
  else{
    window.location.href = "driverapp.php?id=" + id;
  }
  
  </script>  
  <?php
}
?>
<html>
<head>
	<title>Customer - Cab Allocation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
<link rel="stylesheet" type="text/css" href="assets/css/table.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/js/sort.js"></script>

<script type="text/javascript">
    $(function() {
    $(".refresh").click(function() {
      // validate and process form here
      var driver = "<?php echo $driver ?>";
      console.log(driver)
      $.ajax({
        type: "POST",
        url: "actions/rides.php",
        //data: dataString,
        data: {id: driver},
        dataType: "json",
        success: function(data) {
          var trHTML = '';
          for(var f=0;f<data.length;f++) {
            if(data[f].status == -1) {
              trHTML += '<tr><td>' +data[f].cname + '</td><td>Waiting</td><td><form method="POST" action="actions/rideaccept.php" id="acceptForm"><input type="hidden" id="rideid" name="rideid" value=' + data[f].id + '><input type="hidden" id="driverid" name="driverid" value="<?php echo $driver ?>"><input type="submit" class="acceptButton1" value="Accept"></form></td></tr>';
            }
            else if(data[f].status == 0) {
              trHTML += '<tr><td>' +data[f].cname + '</td><td>On Going</td><td>On Going</td></tr>';
            }
            else {
              trHTML += '<tr><td>' +data[f].cname + '</td><td>Done</td><td>Ride Finished</td></tr>';
            }
          }
          $('#body').html(trHTML);
        }
      });
      return false;
    });
  });
  </script>
</head>
<body onLoad="document.getElementById('refresh').click();">
<div class="header">
  <a href="#" class="logo">CompanyLogo</a>
  <div class="header-right">
    <a class="active" href="#">Driver App</a>
    <a href="customerapp.html">Customer</a>
    <a href="admin.html">Admin</a>
  </div>
</div>

<div class="container">

    <form method="POST" id="regreshForm">
      <input type="hidden" id="id" name="id" value='<?php echo $driver ?>'>
      <input type="submit" id="refresh" name="refresh" class="refresh" value="Refresh">
    </form>
    <!-- <div class="result1" style="background-color: grey;color: white"></div> -->
    <table id="tablelist">
      <thead>
    	  <tr>
    	    <th>Customer</th>
    	    <th onclick="sortTable(1)">Status <span ><img style="width: 15px;" src="assets/images/sort.png"></span></th>
          <th>Accept</th>
    	  </tr>
    </thead>
   
      <tbody id="body">
    	  
      </tbody>   
    
	</table>
</div>

<!-- <script src="assets/js/driver.js"></script> -->
</body>
</html>