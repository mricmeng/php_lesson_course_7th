<?php
    $cn = new mysqli("localhost","root","ServBay.dev","php23");
    $cn->set_charset("utf8");
    $lang = 'eng';
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    }
    $myLang = array(
        "eng"=>array(
            "id"=>"ID",
            "name"=>"Name",
            "photo"=>"Photo",
            "status"=>"Status",
            "lang"=>"Lang",
        ),
        "kh"=>array(
            "id"=>"លេខរៀង",
            "name"=>"ឈ្មោះ",
            "photo"=>"រូបភាព",
            "status"=>"ស្ថានភាព",
            "lang"=>"ភាសា",
        ),
    );
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
    <a href="index.php?lang=kh">Khmer</a>|<a href="index.php?lang=eng">English</a>
    <div class="frm">
        <form class='upl'>
            <div class="frm-2">
                <input type="text" name="txt-edit-id" id="txt-edit-id" value="0">
                <label for=""><?php echo $myLang[$lang]['id']; ?></label>
                <input value="<?php echo $id; ?>" type="text" name="txt-id" id="txt-id" class="frm-control" readonly>
                <label for=""><?php echo $myLang[$lang]['lang']; ?></label>
                <select name="txt-lang" id="txt-lang" class="frm-control">
                    <option value="eng">eng</option>
                    <option value="kh">kh</option>
                </select>
                <label for=""><?php echo $myLang[$lang]['name']; ?></label>
                <input type="text" name="txt-name" id="txt-name" class="frm-control">
                <label for=""><?php echo $myLang[$lang]['status']; ?></label>
                <select name="txt-status" id="txt-status" class="frm-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <label for=""><?php echo $myLang[$lang]['photo']; ?></label>
                <div class="img-box">
                    <input type="file" name="txt-file" id="txt-file" class="txt-file">
                    <input type="hidden" name="txt-photo" id="txt-photo" class="txt-photo">
                </div>
                <a class="btn btn-post" id="btn-post"> <i class='fas fa-save'></i>Save</a>

            </div>
            <div class="frm-3">
                <label for="">Description</label>
                <textarea name="txt-des" id="txt-des" cols="30" rows="10" class="frm-control"></textarea>
            </div>

        </form>
    </div>
    <table id="tblData">
        <tr>
            <th width="50">ID</th>
            <th>Name</th>
            <th width="50">Photo</th>
            <th width="50">Lang</th>
            <th width="50">Status</th>
            <th width="50">Action</th>
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
            <td align='center'><?php echo $row[5]; ?></td>
            <td>
                <input type="button" value="Edit" class="btn-edit">
            </td>
            <td class="hidden">
                <?php echo $row[4]; ?>
            </td>
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
    var trInd = 0;
    var btnEdit = '<input type="button" value="Edit" class="btn-edit">';
    var loading = "<div class='loading'></div>";
    var imgBox = $('.img-box');
    //get edit data
    tbl.on('click', 'tr td .btn-edit', function() {
        var tr = $(this).parents('tr');
        var id = tr.find('td:eq(0)').text().trim();
        var name = tr.find('td:eq(1)').text().trim();
        var photo = tr.find('td:eq(2) img').attr("src");
        var lang = tr.find('td:eq(3)').text().trim();
        var status = tr.find('td:eq(4)').text().trim();
        var des = tr.find('td:eq(6)').text().trim();
        $('#txt-id').val(id);
        $('#txt-lang').val(lang);
        $('#txt-name').val(name);
        $('#txt-status').val(status);
        $('.img-box').css({
            "background-image": "url(" + photo + ")"
        });
        $('#txt-photo').val(photo);
        $('#txt-edit-id').val(id);
        $('#txt-des').val(des);
        trInd = tr.index();
    });
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
                imgBox.append(loading);
            },
            success: function(data) {
                //work after success
                imgBox.find('.loading').remove();

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
        var lang = Parent.find('#txt-lang');
        var status = Parent.find('#txt-status');
        var photo = Parent.find('#txt-photo');
        var img = '<img src=' + photo.val() + ' alt=' + photo.val() + '>';
        var des = Parent.find('#txt-des');
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
                    if (data.edit == true) {
                        // alert('Your data is updated!')
                        tbl.find('tr:eq(' + trInd + ') td:eq(1)').text(name.val());
                        tbl.find('tr:eq(' + trInd + ') td:eq(2) img').attr('src', photo
                            .val());
                        tbl.find('tr:eq(' + trInd + ') td:eq(3)').text(lang.val());
                        tbl.find('tr:eq(' + trInd + ') td:eq(4)').text(status.val());
                        tbl.find('tr:eq(' + trInd + ') td:eq(6)').text(des.val());
                    } else {
                        //add data to toble list
                        var tr = "<tr> <td align='center'>" + data.id + "</td>" +
                            " <td>" + name.val() + "</td>" +
                            " <td>" + img + "</td>" +
                            " <td>" + lang.val() + "</td>" +
                            " <td>" + status.val() + "</td> <td>" + btnEdit + "</td>" +
                            "<td class='hidden'>" + des.val() + "</td>" +
                            "</tr>";
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