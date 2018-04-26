$(function() {
    $(".button").click(function() {
      // validate and process form here
      var customer = $("#identifier").val();
      // var xcord = $("#xcord").val();
      // var ycord = $("#ycord").val();
      $.ajax({
        type: "POST",
        url: "http://localhost/cab_allocation/actions/riderequest.php",
        //data: {identifier : customer, xcord: xcord, ycord: ycord},
        data: {identifier : customer},
        dataType: "json",
        success: function(data) {
          //display message back to user here
          $(".result").html(data);
        }
      });
      return false;
    });
  });