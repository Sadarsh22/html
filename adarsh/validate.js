$(document).ready(function () {
    $('#form').submit(function () {
        alert("js working");
        var name = $('#name');
        if (name.val() == '') {
            name.focus();
            name.val("please enter your name");
            name.click(function () {
                name.val('');
            })
            return false;
        }

        var file=$('#myfile');
        var fileExtension=file.val().split('.').pop().toLowerCase();
        if(file[0].files.length == 0)
        {
            alert('file not uploaded');
            return false;
        }
        if(fileExtension != 'jpeg')
        {
            file.val('');
            alert('only jpeg files allowed');
            return false;
        }
        return true;
    });
});