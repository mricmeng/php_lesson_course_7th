<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax form</title>
</head>
<body>
    
</body>
<script>
        var eThis = $(this);
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'save-category.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                //work before success
            },
            success: function(data) {
                //work after success
            }
        });

</script>
</html>