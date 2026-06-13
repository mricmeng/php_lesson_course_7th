<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php23");
    $id =1;
    //auto id
    $sql = "SELECT id FROM tbl_category ORDER BY id DESC";
    $res = $cn->query($sql);
    $num = $res->num_rows;
    if($num > 0){
       $row = $res->fetch_array();
       $id = $row[0]+1;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-4.0.0.js"
        integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="test.css">
</head>

<body>
    <div class="frm">
        <form class='upl'>
            <label for="">ID</label>
            <input value="<?php echo $id; ?>" type="text" name="txt-id" id="txt-id" class="frm-control" readonly>
            <label for="">Name</label>
            <input type="text" name="txt-name" id="txt-name" class="frm-control">
            <label for="">Status</label>
            <select name="txt-status" id="txt-status" class="frm-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <label for="">Photo</label>
            <div class="img-box">
                <input type="file" name="txt-file" id="txt-file" class="txt-file">
                <input type="hidden" name="txt-photo" id="txt-photo" class="txt-photo">
            </div>
            <a class="btn btn-post" id="btn-post"> <i class='fas fa-save'></i>Save</a>
        </form>
    </div>
    <table id="tblData">
        <tr>
            <th width="50">ID</th>
            <th>Name</th>
            <th width="50">Photo</th>
            <th width="50">Status</th>
        </tr>
        <?php
        $sql = "SELECT * FROM tbl_category ORDER BY id DESC";
        $res = $cn->query($sql);
        if($res->num_rows > 0){
            while($row = $res->fetch_array()){
                ?>
        <tr>
            <td align='center'><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td>
                <img src="<?php echo $row[2]; ?>" alt="<?php echo $row[2]; ?>">
            </td>
            <td align='center'><?php echo $row[3]; ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>

</body>
<script>
$(document).ready(function() {
    var tbl = $('#tblData');
    //upload photo to server
    $('.txt-file').change(function() {
        var eThis = $(this);
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'upl-img.php',
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

                $('.img-box').css({
                    "background-image": "url(" + data.imgPath + ")"
                });
                $('.txt-photo').val(data.imgPath);
            }
        });
    });
    //save data to database
    $('#btn-post').click(function() {
        var eThis = $(this);
        var Parent = eThis.parents('.frm');
        var id = Parent.find('#txt-id');
        var name = Parent.find('#txt-name');
        var status = Parent.find('#txt-status');
        var photo = Parent.find('#txt-photo');
        var img = '<img src=' + photo.val() + ' alt=' + photo.val() + '>';
        if (name.val() == '') {
            alert('Please input name');
            name.focus();
            return;
        }
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
                eThis.html("<i class='fa fa-spinner fa-spin'></i>Wait...");
                eThis.css({
                    "pointer-events": "none"
                });
            },
            success: function(data) {
                //work after success
                if (data.dpl == true) {
                    alert('Duplicate name');
                    name.focus();
                } else {
                    //add data to toble list
                    var tr = "<tr> <td align='center'>" + data.id + "</td>" +
                        " <td>" + name.val() + "</td>" +
                        " <td>" + img + "</td>" +
                        " <td>" + status.val() + "</td> </tr>";
                    tbl.find('tr:eq(0)').after(tr);
                    // tbl.append(tr);
                    $('#txt-file').val('');
                    name.val('');
                    photo.val('');
                    $('.img-box').css({
                        "background-image": "url(bg-img.png)"
                    });
                    name.focus();
                    id.val(data.id + 1);
                }
                eThis.html("<i class='fas fa-save'></i>Save");
                eThis.css({
                    "pointer-events": "auto"
                });

            }
        });

    });
});
</script>

</html>