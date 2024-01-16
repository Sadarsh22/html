let c = 1;
function addMoreRow() {
    var itemRow =
        '<tr id="row' + c + '">' +
        '<td ><input type="text" class="item"></td>' +
        '<td ><input type="number" id="quantity' + c + '" onchange="calQty(' + c + ')"></td>' +
        '<td ><input type="number" id="unitPrice' + c + '" onchange="calPrice(' + c + ')"></td>' +
        '<td ><input type="number" id="total' + c + '" disabled="disabled onchange="calTotal(' + c + ')"></td>' +
        '<td> <button id="btn' + c + '" onclick="del(' + c + ')" >remove</button>' +
        '</tr>'
    $("#itemsTable").append(itemRow);
    c++;
}
var pn = 0;
function calQty(n) {
    let total = 0;
    if (pn < n) pn = n;
    let ans = 0, qty = 0, price = 0;
    let qid = "#quantity" + n;
    let pid = "#unitPrice" + n;
    qty = (($(qid).val()));
    price = ($(pid).val());
    var tid = "#total" + n;
    ans = qty * price;
    $(tid).val(ans);
    totalSum.push(tid);
    var st = calculateTotalSum();
    $('#total').val(st);
    calDisc();
    calGst('#sgst');
    calGst('#cgst');
}

function calPrice(n) {
    calQty(n);
}

var sgst = 0, sgst_amt = 0, cgst_amt = 0, cgst = 0;

$(document).ready(function () {
    $('#sgst').change(function () {
        calGst('#sgst');
        calGst('#cgst');
    })
    $('#cgst').change(function () {
        calGst('#sgst');
        calGst('#cgst');
    })
})

function calGst(n) {
    var amt = n + 'Amt';
    if (n == '#sgst')
        total = Number($('#discountPrice').val());
    else
        total = Number($('#sgstAmt').val());
    sgst = Number($(n).val());
    sgst_amt = total + ((sgst / 100) * total)
    $(amt).val(sgst_amt);
    $('#grandTotal').val(sgst_amt + cgst_amt);
    return;
}

let k = 0;
function del(n) {
    let del = '#total' + n;
    let set = new Set(totalSum);
    set.delete(del);
    totalSum = [...set];
    var rid = "#row" + n;
    $(rid).remove();
    var abc = calculateTotalSum();
    $('#total').val(abc);
    calGst('#sgst');
    calGst('#cgst');
    calDisc();
}

var totalSum = [];
function calculateTotalSum() {
    let set = new Set(totalSum);
    totalSum = [...set];
    console.log(totalSum)
    var ans = 0;
    for (let i = 0; i < totalSum.length; i++) {
        let find = totalSum[i];
        ans += Number($(find).val());
    }
    return ans;
}

function calDisc() {
    var total = $('#total').val();
    var disc = $('#discount').val();
    var discPrice = total - ((disc / 100) * total);
    $('#discountPrice').val(discPrice);
    calGst('#sgst');
    calGst('#cgst');
}
