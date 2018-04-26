$(function() {
    $(".acceptButton").click(function() {
      // validate and process form here
      var rideid = $("#rideid").val();
      var driverid = $("#driverid").val();
      var dataString = 'rideid=' + rideid + '&driverid=' + driverid;
      console.log("fasdf");
      $.ajax({
        type: "POST",
        url: "http://localhost/cab_allocation/actions/rideaccept.php",
        //data: dataString,
        data: {rideid: rideid, driverid: driverid},
        dataType: "json",
        success: function(data) {
          //display message back to user here
          alert(data);

          //window.location.href = 'http://localhost/cab_allocation/driverapp.php?id=' + driverid;
         // $(".result1").html(data);
        }
      });
      return false;
    });
  });



// $(function() {
//     $(".refresh").click(function() {
//       // validate and process form here
//       var id = $("#id").val();
//       console.log(id);
//       $.ajax({
//         type: "POST",
//         url: "http://localhost/cab_allocation/actions/rides.php",
//         //data: dataString,
//         data: {id: id},
//         //dataType: "json",
//         success: function(data) {
//           alert("refresh");
//         }
//       });
//       return false;
//     });
//   });

