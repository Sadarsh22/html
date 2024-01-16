let c = 1;
function addMoreRow() {
    var itemRow =
        '<tr id="row' + c + '">' +
        '<td ><input type="text" class="item"></td>' +
        '<td ><input type="number" id="quantity' + c + '" onkeyup="calQty(' + c + ')"></td>' +
        '<td ><input type="number" id="unitPrice' + c + '" onkeyup="calPrice(' + c + ')"></td>' +
        '<td ><input type="number" id="total' + c + '" disabled="disabled onkeyup="calTotal(' + c + ')"></td>' +
        '<td> <button id="btn' + c + '" onclick="del('+c+')" >remove</button>'+
        '</tr>'
    $("#itemsTable").append(itemRow);
    c++;
}
var pn=0;
function calQty(n) {
    let total=0;
    if(pn<n) pn=n;
    let ans = 0;
    var qty = 0;
    var price = 0;
    let qid = "#quantity" + n;
    let pid = "#unitPrice" + n;
    $(document).ready(function () {
        qty = (($(qid).val()));
        price = ($(pid).val());
        var tid = "#total" + n;
        ans = qty * price;
        $(tid).val(ans);

        for(var i=0; i<=pn; i++)
        {
            var tid='#total'+i;
            let ans=Number($(tid).val())
            total=total+ans;
        }
        $('#total').val(total);
    });
}

function calPrice(n) {
    let total=0;
    if(pn<n) pn=n;
    var qty = 0;
    var price = 0;
    let qid = "#quantity" + n;
    let pid = "#unitPrice" + n;
    $(document).ready(function () {
        qty = (($(qid).val()));
        price = ($(pid).val());
        var tid = "#total" + n;
        ans = qty * price;
        $(tid).val(ans);

        for(var i=0; i<=pn; i++)
        {
            var tid='#total'+i;
            let ans=Number($(tid).val())
            total=total+ans;
        }
        $('#total').val(total);
    });
}

var sgst=0;
var sgst_amt=0;
var cgst_amt=0;
var cgst=0;

$(document).ready(function(){
    $('#sgst').keyup(function(){
        var total=Number($('#total').val());
        sgst = Number($('#sgst').val());
        sgst_amt=total+((sgst/100)*total)
        $('#sgstAmt').val(sgst_amt);
        $('#grandTotal').val(sgst_amt+cgst_amt);
    })
    $('#cgst').keyup(function(){
        var total=Number($('#sgstAmt').val());
        sgst = Number($('#cgst').val());
        sgst_amt=total+((sgst/100)*total)
        $('#cgstAmt').val(sgst_amt);
        $('#grandTotal').val(sgst_amt+cgst_amt);
    })
})

let k=0; 
function del(n)
{
    k=n;
    var total=Number($('#total').val());
    alert("sum total = "+total);
    total=total-Number($('#total'+n).val());
    var rid="#row"+n;
    $(rid).remove();
    alert(typeof(total));
    $('#total').val(total);
    
}