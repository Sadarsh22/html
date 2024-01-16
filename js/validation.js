function callHideFirstName() {
  document.getElementById("SFirst_Name").innerHTML = "";
  return true;
}

function callHideLastName() {
  document.getElementById("SLast_Name").innerHTML = "";
  return true;
}

function callHideEmail() {
  document.getElementById("SEmail").innerHTML = "";
  return true;
}

function callHidePhone() {
  document.getElementById("SPhone").innerHTML = "";
  return true;
}

function callHideAddress() {
  document.getElementById("SAddress").innerHTML = "";
  return true;
}

function callHideGender() {
  document.getElementById("SGender").innerHTML = "";
  return true;
}

function callHideDateOfBirth() {
  document.getElementById("SDob").innerHTML = "";
  return true;
}

function callHideLanguage() {
  document.getElementById("SLanguage").innerHTML = "";
  return true;
}

function callHideCountry() {
  document.getElementById("SCountry").innerHTML = "";
  return true;
}

function callHideFile() {
  document.getElementById("SFile").innerHTML = "";
  return true;
}

function callHidePassword() {
  document.getElementById("SPassword").innerHTML = "";
  return true;
}

function callHideConfirmPassword() {
  document.getElementById("SConfirmpassword").innerHTML = "";
  return true;
}

function validateForm() {
  let fname = document.applicationForm.First_Name.value;
  if (fname == null || fname == "") {
    // alert("First Name cannot be null");
    document.getElementById("SFirst_Name").innerHTML =
      "First Name is required";
    document.applicationForm.First_Name.focus();
    return false;
  }

  for (let i = 0; i < fname.length; i++) {
    let val = fname.charAt(i);
    if (!isNaN(val)) {
      // alert("First Name should not contain any numeric value");
      document.getElementById("SFirst_Name").innerHTML =
        "No numeric values allowed here";
      document.applicationForm.First_Name.focus();
      return false;
    }
  }

  let lname = document.applicationForm.Last_Name.value;
  if (lname == null || lname == "") {
    // alert("Last Name cannot be null");
    document.getElementById("SLast_Name").innerHTML =
      "Last Name is required";
    document.applicationForm.Last_Name.focus();
    return false;
  }

  for (let i = 0; i < lname.length; i++) {
    let val = lname.charAt(i);
    if (!isNaN(val)) {
      // alert("Last Name should not contain any numeric value");
      document.getElementById("SLast_Name").innerHTML =
        "No numeric values allowed here";
      document.applicationForm.Last_Name.focus();
      return false;
    }
  }

  let addr = document.applicationForm.address.value;
  if (addr.length == 0) {
    // alert("Please Enter your Address");
    document.getElementById("SAddress").innerHTML =
      "Please Enter Your Address";
    document.applicationForm.address.focus();
    return false;
  }

  let emailID = document.applicationForm.email.value;
  if (emailID == "") {
    // alert("Email field cannot be empty");
    document.getElementById("SEmail").innerHTML =
      "Email field should not be empty";
    document.applicationForm.email.focus();
    return false;
  }

  let PhoneNo = document.applicationForm.Phone.value;
  if (PhoneNo == "") {
    //alert("Phone number field cannot be empty");
    document.getElementById("SPhone").innerHTML =
      "Phone number cannot be empty";
    document.applicationForm.Phone.focus();
    return false;
  }
  for (let i = 0; i < PhoneNo.length; i++) {
    let val = PhoneNo.charAt(i);
    if (isNaN(val)) {
      //alert("phone number field should contain only digits");
      document.getElementById("SPhone").innerHTML =
        "phone number field should contain only digits";
      document.applicationForm.Phone.focus();
      return false;
    }
  }
  if (PhoneNo.length != 10) {
    // alert("Phone number must be of 10 digits");
    document.getElementById("SPhone").innerHTML =
      "Phone number must be of 10 digits";
    document.applicationForm.Phone.focus();
    return false;
  }

  function valButton(btn) {
    var cnt = -1;
    for (var i = btn.length - 1; i > -1; i--) {
      if (btn[i].checked) {
        cnt = i;
        i = -1;
      }
    }
    if (cnt > -1) return btn[cnt].value;
    else return null;
  }

  let xyz = document.applicationForm.Gender.value;
  if (xyz == "") {
    // alert("Please select your gender");
    document.getElementById("SGender").innerHTML =
      "Please select your gender";
    return false;
  }

  let dateOfBirth = document.applicationForm.dob.value;
  if (dateOfBirth == "") {
    // alert("please enter your Date Of Birth");
    document.getElementById("SDob").innerHTML =
      "please enter your Date Of Birth";
    document.applicationForm.dob.focus();
    return false;
  }

  let lng = valButton(document.applicationForm.Language);
  if (lng == null) {
    // alert("please select your language");
    document.getElementById("SLanguage").innerHTML =
      "please select your language";
    return false;
  }

  let cnt = document.applicationForm.Country.value;
  if (cnt == 0) {
    // alert("please select your country");
    document.getElementById("SCountry").innerHTML =
      "please select your country";
    return false;
  }

  let inputFile = document.applicationForm.File.value;
  if (inputFile.length == 0) {
    // alert("please upload the image");
    document.getElementById("SFile").innerHTML =
      "Please upload the image";
    return false;
  }
  let selectedFile = document.getElementById("File").files[0];
  let allowedTypes = ["image/jpeg", "image/png"];

  if (!allowedTypes.includes(selectedFile.type)) {
    // alert("Invalid file type. Please upload a JPEG or PNG file");
    document.getElementById("SFile").innerHTML =
      "Only JPEG or PNG file accepted";
    document.getElementById("File").value = "";
    return false;
  }

  if ((selectedFile.size / 1000) > 40) {
    document.getElementById("SFile").innerHTML = "file limit is 40KB only";
    document.getElementById("SFile").focus();
    return false;
  }


  let passwd = document.applicationForm.password.value;
  if (passwd.length == 0) {
    // alert("Please Enter the Password");
    document.getElementById("SPassword").innerHTML =
      "Please Enter the Password";
    document.applicationForm.password.focus();
    return false;
  }
  if (passwd.length < 8) {
    // alert("Password must be of atleast 8 digits");
    document.getElementById("SPassword").innerHTML =
      "Password must be of atleast 8 digits";
    document.applicationForm.password.focus();
    return false;
  }
  let cnfPasswd = document.applicationForm.confirmPassword.value;
  if (cnfPasswd.length == 0) {
    // alert("Please confirm your password");
    document.getElementById("SConfirmpassword").innerHTML =
      "Please confirm your password";
    document.applicationForm.confirmPassword.focus();
    return false;
  }
  if (passwd != cnfPasswd) {
    // alert("Both passwords must be the same");
    document.getElementById("SConfirmpassword").innerHTML =
      "Both passwords must be the same";
    document.applicationForm.confirmPassword.focus();
    return false;
  }

  return true;
}