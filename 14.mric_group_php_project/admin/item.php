<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php26_1");
    $autoId=1;
    $sql = "SELECT id FROM tbl_item ORDER BY id DESC";
    $rs = $cn->query($sql);
    if($rs->num_rows>0){
        $row = $rs->fetch_array();
        $autoId = $row[0]+1;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-4.0.0.js"
        integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="frm">
        <form class="upl">
            <div class="box">
                <input type="hidden" name="txt-edit-id" id="txt-edit-id" value="0">
                <label for="">ID</label>
                <input value="<?php echo $autoId; ?>" type="text" name="txt-id" id="txt-id" class="frm-control"
                    readonly>

                <label for="">Category</label>
                <select name="txt-cate" id="txt-cate" class="frm-control">
                    <option value="0">Select Category</option>
                    <?php
                        $sql = "SELECT id, title FROM tbl_category WHERE status =1";
                        $rs = $cn->query($sql);
                        while($row = $rs->fetch_array()){
                    ?>
                    <option value="<?php echo $row[0]; ?>">
                        <?php echo $row[1]; ?>
                    </option>
                    <?php
                        }
                    ?>

                </select>

                <label for="">Title</label>
                <input type="text" name="txt-title" id="txt-title" class="frm-control">
                <label for="">Lang(1=en, 2=kh)</label>
                <select name="txt-lang" id="txt-lang" class="frm-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <label for="">Status(1=Enable, 2=Disable)</label>
                <select name="txt-status" id="txt-status" class="frm-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <label for="">Photo</label>
                <div class="img-box">
                    <input type="file" name="txt-file" id="txt-file" class="txt-file">
                    <input type="text" name="txt-photo" id="txt-photo" class="txt-photo">
                </div>
            </div>
            <div class="box">
                <label for="">Description</label>
                <textarea style="height: 400px;" name="txt-des" id="txt-des" class="frm-control"></textarea>
            </div>
            <div class="btn-post">Post</div>
        </form>
    </div>

    <table id="tblData">
        <tr>
            <th width="50">ID</th>
            <th width="250">Category</th>
            <th width="250">Title</th>
            <th>Description</th>
            <th width="50">Photo</th>
            <th width="50">Lang</th>
            <th width="50">Status</th>
            <th width="50">Action</th>
        </tr>
        <?php
            // $sql = "SELECT * FROM tbl_item ORDER BY id DESC";
            $sql = "SELECT 
            tbl_item.id, tbl_category.title, 
            tbl_item.title, tbl_item.des, 
            tbl_item.img, tbl_item.lang, 
            tbl_item.status, tbl_category.id 
            FROM tbl_item INNER JOIN tbl_category ON tbl_item.cate_id = tbl_category.id
            ";
            $rs = $cn->query($sql);
            while($row = $rs->fetch_array()){
        ?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td> <span class="hide"><?php echo $row[7]; ?></span> <?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td>
                <img src="img/<?php echo $row[4]; ?>" alt="<?php echo $row[4]; ?>">
            </td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
            <td>
                <i class="fas fa-edit btnEdit"></i>
            </td>
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
        var cate = tr.find("td:eq(1) span").text();
        var name = tr.find("td:eq(2)").text();
        var des = tr.find('td:eq(3)').text();
        var img = tr.find('td:eq(4) img').attr('alt');
        var lang = tr.find('td:eq(5)').text();
        var status = tr.find('td:eq(6)').text();
        $('#txt-id').val(id);
        $('#txt-cate').val(cate);
        $('#txt-title').val(name);
        $('#txt-des').val(des)
        $('#txt-lang').val(lang);
        $('#txt-status').val(status);
        $('#txt-photo').val(img);
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
        var name = Parent.find('#txt-title');
        var des = Parent.find('#txt-des');
        var imgBox = Parent.find('.img-box');
        var file = Parent.find('txt-file');
        var photo = Parent.find('#txt-photo');
        var status = Parent.find('#txt-status');
        var lang = Parent.find('#txt-lang');
        var category = Parent.find('#txt-cate')
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
            url: 'action/save-item.php',
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
                    tbl.find('tr:eq(' + ind + ') td:eq(1)').html("<span class ='hide'>" +
                        category.val() + "</span>" + category.find("option:selected")
                        .text() + "");
                    tbl.find('tr:eq(' + ind + ') td:eq(2)').text(name.val());
                    tbl.find('tr:eq(' + ind + ') td:eq(3)').text(des.val());
                    tbl.find('tr:eq(' + ind + ') td:eq(4) img').attr("src", "img/" + photo
                        .val() + "");
                    tbl.find('tr:eq(' + ind + ') td:eq(4) img').attr("alt", "" + photo
                        .val() + "");
                    tbl.find('tr:eq(' + ind + ') td:eq(5)').text(lang.val());
                    tbl.find('tr:eq(' + ind + ') td:eq(6)').text(status.val());
                } else {
                    var tr = "<tr> <td>" + id.val() + "</td> " +
                        "<td><span class ='hide'>" + category.val() + "</span>" + category
                        .find("option:selected").text() + "</td>" +
                        " <td>" + name.val() + "</td> " +
                        "<td>" + des.val() + "</td> " +
                        "<td> <img src='img/" + photo.val() + "' alt=" + photo.val() +
                        " ></td>" +
                        "<td>" + lang.val() + "</td> " +
                        "<td>" + status.val() + "</td> " +
                        "<td> <i class='fas fa-edit btnEdit'></i> </td>" +
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
        var photo = Parent.find('#txt-photo');
        var frm = eThis.closest('form.upl');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/upl-img.php',
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