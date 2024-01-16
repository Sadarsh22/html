// function validateDelete() {
//     let del = document.getElementById("delete");
//     let cnf = confirm("are you sure you want to delete");
//     alert(del);
// }

$(document).ready(function () {
    $('#Delete').click(function () {
        confirm("are you sure you want to delete");
    });
})

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
    let check = document.getElementsByName("all");
    let c = 0;
    for (let i = 0; i < check.length; i++) {
        if (check[i].checked == true) c++;
    }
    if (c == 0) {
        alert("please select atleast one record to delete");
        return false;
    } else if (c > 0) {
        confirm("are you sure you want to delete");
    }
    return true;
}

$(document).ready(function () {
    $(".view").click(function () {
        $('#modal').fadeIn();
    });
    $('#modalButton').click(function () {
        $('#modal').fadeOut();
    });
});
