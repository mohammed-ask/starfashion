<?php
include "../session.php";
if (false && $_POST['wopo'] == "WO") {
    $data = "
        <div class='form-group row'>
    <label class='col-md-12'>Search</label>
    <div class='col-md-12'><input type='button' class='btn btn-warning' onclick='additem(" . $_POST["my_gst_code"] . "," . $_POST["gst_state_code"] . "," . $_POST["state_code"] . ")' value='Add Item'/></div>
    </div>
<script>
</script>
    ";
} else {
    $data = "
    <div class='form-group row'>
    <label class='col-md-12'>Search</label>
    <div class='col-md-12'><input class='form-control' id='search1'/></div>
    </div>
<script>

vendor = $('#business').val();
currency = $('#currency').val();
wopo = $('#wopo').val();
$('#search1').autocomplete({
    minLength: 3,
    source: function(request, response) {
        $.ajax({
            type: 'post',
            url: '../main/admin/searchitemforpurchase.php',
            data: {
                vendor : vendor,
                currency : currency,
                wopo : wopo,
                my_gst_code: " . $_POST["my_gst_code"] . ",
                gst_state_code: " . $_POST["gst_state_code"] . ",
                state_code: " . $_POST["state_code"] . ",
                search: request.term
            },
            dataType: 'json',
            success: function(data) {
                response(data)
            }
        });
    },
    select: function(event, ui) {
        event.preventDefault();

        $('tbody#result').append(ui.item.data).each(function() {
            var j = 1;
            a = $(this).children().last().find('#subid').val();
            $('.s_no').each(function() {
                $(this).html(j)
                j = j + 1;
            })
            $('.item-class').not(':last').each(function() {
                if ($(this).find('#subid').val() == a) {
                    $('.item-class').last().remove();
                    alert('Instrument Already Added');
                }
            });
            $('#search1').val('');
        });
    },
})";
}
$customerdata = [0 => $data];
// $return['data'] = $data;
echo json_encode($customerdata);
