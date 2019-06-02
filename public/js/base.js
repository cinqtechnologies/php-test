$(function () {
    $("#product_email").click(function () {
        $("#input_email").val('');
        $("#email_form").show();
        $("#email_sent").hide();
    });

    $("#send_email").click(function () {
        if($("#input_email").val() !== '')
        {
            $("#email_form").hide();
            $("#email_sent").show();
        }
    });
});
