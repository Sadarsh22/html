$(function () {
  $("#applicationForm").submit(function () {
    var fname = $("#First_Name").val();
    var lname = $("#Last_Name").val();
    var addr = $("#address").val();
    var emailID = $("#email").val();
    var PhoneNo = $("#Phone").val();
    var gndr = $(".Gender:checked").val();
    var dateOfBirth = $("#dob").val();
    var lng = $(".Language:checked").val();
    // var cnt = $("#Country").val();
    var inputFile = $("#File")[0];
    var passwd = $("#password").val();
    var cnfPasswd = $("#confirmPassword").val();

    if (fname == null || fname == "") {
      $("#SFirst_Name").html("First Name is required");
      $("#First_Name").focus();
      $("#First_Name").keypress(function () {
        $("#SFirst_Name").hide();
      });
      return false;
    }

    // for (let i = 0; i < fname.length; i++) {
    //   let val = fname.charAt(i);
    //   if (!isNaN(val)) {
    //     $("#SFirst_Name").html("No numeric values allowed here");
    //     $("#First_Name").focus();
    //     $("#First_Name").keypress(function () {
    //       $("#SFirst_Name").hide();
    //     });
    //     return false;
    //   }
    // }

    if (lname == null || lname == "") {
      $("#SLast_Name").html("Last Name is required");
      $("#Last_Name").focus();
      $("#Last_Name").keypress(function () {
        $("#SLast_Name").hide();
      });
      return false;
    }

    // for (let i = 0; i < lname.length; i++) {
    //   let val = lname.charAt(i);
    //   if (!isNaN(val)) {
    //     $("#SLast_Name").html("No numeric values allowed here");
    //     $("#Last_Name").focus();
    //     $("#Last_Name").keypress(function () {
    //       $("#SLast_Name").hide();
    //     });
    //     return false;
    //   }
    // }

    if (addr.length == 0) {
      $("#SAddress").html("Please Enter Your Address");
      $("#address").focus();
      $("#address").keypress(function () {
        $("#SAddress").hide();
      });
      return false;
    }

    if (emailID == "") {
      $("#SEmail").html("Email field should not be empty");
      $("#email").focus();
      $("#email").mouseover(function () {
        $("#SEmail").hide();
      });
      return false;
    }

    if (PhoneNo == "") {
      $("#SPhone").html("Phone number cannot be empty");
      $("#Phone").focus();
      $("#Phone").keypress(function () {
        $("#SPhone").hide();
      });
      return false;
    }

    for (let i = 0; i < PhoneNo.length; i++) {
      let val = PhoneNo.charAt(i);
      if (isNaN(val)) {
        $("#SPhone").html("phone number field should contain only digits");
        $("#Phone").focus();
        $("#Phone").keypress(function () {
          $("#SPhone").hide();
        });
        return false;
      }
    }

    if (PhoneNo.length != 10) {
      $("#SPhone").html("Phone number must be of 10 digits");
      $("#Phone").focus();
      $("#Phone").keypress(function () {
        $("#SPhone").hide();
      });
      return false;
    }

    if (gndr === undefined) {
      $("#SGender").html("please select your gender");
      $(".Gender").mouseover(function () {
        $("#SGender").hide();
      });
      return false;
    }

    if (dateOfBirth == "") {
      $("#SDob").html("please enter your Date Of Birth");
      $("#dob").focus();
      $("#dob").click(function () {
        $("#SDob").hide();
      });
      return false;
    }

    if (lng === undefined) {
      $("#SLanguage").html("please select your language");
      $(".Language").mouseover(function () {
        $("#SLanguage").hide();
      });
      return false;
    }

    if ($("#Country").val() == '--Select--') {
      $("#SCountry").html("please select your country");
      $("#Country").mouseover(function () {
        $("#SCountry").hide();
      });
      return false;
    }

    if (inputFile.files.length == 0) {
      $("#SFile").html("Please upload the image");
      $("#File").click(function () {
        $("#SFile").hide();
      });
      return false;
    }
    let selectedFileExtension = $("#File").val().split(".").pop().toLowerCase();
    let allowedTypes = ["jpg", "jpeg", "png"];

    if (!allowedTypes.includes(selectedFileExtension)) {
      $("#SFile").html("Only JPEG or PNG file accepted");
      $("#File").val("");
      $("#File").click(function () {
        $("#SFile").hide();
      });
      return false;
    }

    if (inputFile.files[0].size / 1024 > 40) {
      $("#SFile").html("file limit is 40KB only");
      $("#SFile").focus();
      $("#File").click(function () {
        $("#SFile").hide();
      });
      return false;
    }

    if (passwd.length == 0) {
      $("#SPassword").html("Please Enter the Password");
      $("#password").focus();
      $("#password").keypress(function () {
        $("#SPassword").hide();
      });
      return false;
    }

    if (passwd.length < 8) {
      $("#SPassword").html("Password must be of atleast 8 digits");
      $("#password").focus();
      $("#password").keypress(function () {
        $("#SPassword").hide();
      });
      return false;
    }

    if (cnfPasswd.length == 0) {
      $("#SConfirmpassword").html("Please confirm your password");
      $("#confirmPassword").focus();
      $("#confirmPassword").keypress(function () {
        $("#SConfirmpassword").hide();
      });
      return false;
    }
    if (passwd != cnfPasswd) {
      $("#SConfirmpassword").html("Both passwords must be the same");
      $("#confirmPassword").focus();
      $("#confirmPassword").keypress(function () {
        $("#SConfirmpassword").hide();
      });
      return false;
    }
    return true;
  });
});



