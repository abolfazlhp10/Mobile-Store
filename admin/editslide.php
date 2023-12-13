<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>
<?php if (isset($_POST["edit-slide"])) {
    $file = $_FILES["file"];
    $query = "SELECT * FROM slider WHERE id=?";
    $row = [$_GET["editslide"]];
    $select = $action->select($query, $row);
    if (!empty($file["name"])) {
        $ghesmate1 = explode(".", $file["name"]);
        $ghesmate2 = end($ghesmate1);
        $newname = "img-" . rand(1000, 9999) . "." . $ghesmate2;
        $query = "UPDATE slider SET picture=? WHERE id=?";
        $row = [$newname,$_GET["editslide"]];
        $action->inud($query, $row);
        if ($action == true) {
            unlink("fileadmin/slider/" . $select->picture);
            move_uploaded_file($file["tmp_name"], "fileadmin/slider/" . $newname);
            header("location:listslide.php?edit=success");
        }
    } else {
        move_uploaded_file($file["tmp_name"], "fileadmin/slider/" . $select->picture);
        header("location:listslide.php?edit=success");
    }
} ?>
<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="alert alert-warning" style="font-size:18px;font-weight: bold;">
                        ويرايش تصوير اسلايدر
                    </div>

                    <?php if (isset($err)) { ?>
                        <div class="alert alert-danger"><?php echo $err ?></div>
                    <?php } ?>

                    <?php if (isset($existcat)) { ?>
                        <div class="alert alert-info"><?php echo $existcat ?></div>
                    <?php } ?>

                    <?php if (isset($empty)) { ?>
                        <div class="alert alert-info"><?php echo $empty ?></div>
                    <?php } ?>

                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" class="form-control" name="file">
                        </div>
                        <br>
                        <button name="edit-slide" type="submit" class="btn btn-primary btn-block">ويرايش</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>