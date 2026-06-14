<?php
    $cn = new mysqli ('localhost', 'root', 'ServBay.dev', 'php26');
    $id = 1;
    //get auto id
    $sql = "SELECT id FROM tbl_city ORDER BY id DESC";
    $rs = $cn->query($sql);
    if ($rs->num_rows > 0) {
        $row = $rs->fetch_array();
        $id = $row[0] + 1;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-4.0.0.js"
        integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="city.css">
</head>

<body>
    <div class="frm">
        <form class="upl">
            <input type="text" name="txt-edit-id" id="txt-edit-id" value="0">
            <label for="">ID</label>
            <input type="text" name="txt-id" id="txt-id" class="frm-control" value="<?php echo $id; ?>">
            <label for="">City Name</label>
            <input type="text" name="txt-name" id="txt-name" class="frm-control">
            <label for="">Description</label>
            <textarea name="txt-des" id="txt-des" cols="30" rows="10" class="frm-control"></textarea>
            <label for="">Status</label>
            <select name="txt-status" id="txt-status" class="frm-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <label for="">Photo</label>
            <div class="img-box">
                <input type="file" name="txt-file" id="txt-file" class="txt-file">
                <input type="text" id="txt-img-name" name="txt-img-name">
            </div>
            <a class="btn-post">
                Post
            </a>
        </form>
    </div>
    <table id='tblData'>
        <tr>
            <th width="70">ID</th>
            <th width="200">City Name</th>
            <th>Description</th>
            <th width="100">Photo</th>
            <th width="100">Status</th>
            <th width="100">Action</th>
        </tr>
        <?php
            $sql = "SELECT * FROM tbl_city ORDER BY id DESC";
            $rs = $cn->query($sql);
            while($row = $rs->fetch_array()){
            ?>
        <tr>
            <td class="center"><?php echo $row[0] ?></td>
            <td><?php echo $row[1] ?></td>
            <td><?php echo $row[2] ?></td>
            <td class="center">
                <img src="img/<?php echo $row[3] ?>" alt="<?php echo $row[3] ?>">
            </td>
            <td class="center"><?php echo $row[4] ?></td>
            <td> <input type="button" value="Edit" class="btnEdit"> </td>
        </tr>
        <?php
            }
        ?>
    </table>

</body>
<script>
$(document).ready(function() {
    var tbl = $('#tblData');
    var loading = "<div class='loading'></div>";
    var ind;
    //get edit data
    tbl.on('click', '.btnEdit', function() {
        var eThis = $(this);
        var tr = eThis.parents("tr");
        var id = tr.find("td:eq(0)").text();
        var name = tr.find("td:eq(1)").text();
        var des = tr.find('td:eq(2)').text();
        var status = tr.find('td:eq(4)').text();
        var img = tr.find('td:eq(3) img').attr('alt');
        $('#txt-id').val(id);
        $('#txt-name').val(name);
        $('#txt-des').val(des)
        $('#txt-status').val(status);
        $('#txt-img-name').val(img);
        $('.img-box').css({
            "background-image": "url(img/" + img + ")"
        });
        $('#txt-edit-id').val(id);
        ind = tr.index();

    });
    $('.btn-post').click(function() {
        var eThis = $(this);
        var Parent = eThis.parents('.frm');
        var id = Parent.find('#txt-id');
        var name = Parent.find('#txt-name');
        var des = Parent.find('#txt-des');
        var imgBox = Parent.find('.img-box');
        var file = Parent.find('txt-file');
        var photo = Parent.find('#txt-img-name');
        var status = Parent.find('#txt-status');
        if (name.val() == '') {
            alert('Please enter city name');
            name.focus();
            return;
        } else if (des.val() == '') {
            alert('Please enter description');
            des.focus();
            return;
        }
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'save-city.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                eThis.html("<i class='fa fa-spinner fa-spin'></i>wait...");
                eThis.css({
                    "pointer-events": "none"
                });
            },
            success: function(data) {
                if (data.dpl == true) {
                    alert('Duplicate City Name');
                    name.focus();
                    eThis.html("Post");
                    eThis.css({
                        "pointer-events": "auto"
                    });
                    return;
                }
                if (data.edit == true) {
                    tbl.find('tr:eq(' + ind + ') td:eq(1)').text(name.val());
                    tbl.find('tr:eq(' + ind + ') td:eq(2)').text(des.val());
                    tbl.find('tr:eq(' + ind + ') td:eq(3) img').attr("src", "img/" + photo
                        .val() + "");
                    tbl.find('tr:eq(' + ind + ') td:eq(3) img').attr("alt", "" + photo
                        .val() + "");
                    tbl.find('tr:eq(' + ind + ') td:eq(4)').text(status.val());
                } else {
                    var tr = "<tr> <td>" + id.val() + "</td> " +
                        " <td>" + name.val() + "</td> " +
                        "<td>" + des.val() + "</td> " +
                        "<td> <img src='img/" + photo.val() + "' alt=" + photo.val() +
                        " ></td>" +
                        "<td>" + status.val() + "</td> " +
                        "<td> <input type='button' value='Edit' class='btnEdit'> </td>" +
                        " </tr>"
                    tbl.find("tr:eq(0)").after(tr);
                    name.val('');
                    des.val('');
                    name.focus();
                    photo.val('');
                    file.val('');
                    imgBox.css({
                        "background-image": "url(img/bg-img.png)"
                    });
                    id.val(data.id + 1);
                }
                eThis.html("Post");
                eThis.css({
                    "pointer-events": "auto"
                });

            }
        }); //ajax
    }); //upload image
    $('.txt-file').change(function() {
        var eThis = $(this);
        var Parent = eThis.parents('.frm');
        var imgBox = Parent.find('.img-box');
        var photo = Parent.find('#txt-img-name');
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
                imgBox.append(loading);
            },
            success: function(data) {
                imgBox.css({
                    "background-image": "url('img/" + data.imgName + "')"
                });
                imgBox.find('.loading').remove();
                photo.val(data.imgName);
            }
        }); //ajax

    });


}); //document
</script>


</html>