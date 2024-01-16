function sum() {
    let a = $("#first").val();
    let b = $("#second").val();

    if (!isNaN(a) && !isNaN(b))
        $('#answer').val((a * 1) + (b * 1));
    else
        $('#answer').val(a + b);
}
let c = 0;
$(document).ready(function () {
    $('#addMoreBoxes').click(function () {
        c++;
        var newTextBox = '<div id="box">' + '<input type="text"/>' +
            '<br>' + '<button class="remove">Remove</button>' + '</div>';
        $('#addMore1').append(newTextBox);

        $("body").on("click", ".remove", function () {
            $(this).parents("#box").remove();
        })
    });
    $('#clickMe').click(function () {
        $('#filter').fadeIn();
        $('#close').fadeIn();
    })
    $('#close').click(function () {
        $('#filter').fadeOut();
        $('#close').fadeOut();
    })
});

$(document).ready(function () {
    $('#nvalue').keyup(function () {
        $('#pattern').html('');
        var n = $('#nvalue').val();
        for (let i = 0; i < n; i++) {
            for (let j = 0; j <= i; j++) {
                $('#pattern').append('*');
            }
            $('#pattern').append('<br>');
        }
        $('#pattern').append('<pre>');
        for (let i = 1; i <= n; i++) {
            for (let j = 0; j < n - i; j++)
                $('#pattern').append(" ");
            for (let j = 1; j <= i; j++) {
                $('#pattern').append('*');
            }
            $('#pattern').append('<br>');
        }
        $('#pattern').append('</pre>');
    })
})