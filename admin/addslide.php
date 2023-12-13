<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>
<?php
if (isset($_POST["add-slide"])) {
    $file = $_FILES["file"];
    if (!empty($file["name"])) {
        if ($file["type"] == "image/png" or $file["type"] == "image/jpeg" or $file["type"] == "image/jpg") {
            $ghesmate1 = explode(".", $file["name"]);
            $ghesmate2 = end($ghesmate1);
            $newname = "img-" . rand(1000, 9999) . "." . $ghesmate2;
            $query = "INSERT INTO slider SET picture=?";
            $row = [$newname];
            $action->inud($query, $row);
            if ($action == true) {
                move_uploaded_file($file["tmp_name"], "fileadmin/slider/" . $newname);
                $success = "عکس مورد نظر با موفقیت اضافه گردید";
            } else {
                $err = "خطا در ثبت عکس";
            }
        } else {
            $errformat = "فرمت فایل مورد نظر غیر قابل پشتیبانی است";
        }
    } else {
    }
}
?>
<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="alert alert-secondary" style="font-size:18px;font-weight: bold;">
                        افزودن تصویر به اسلایدر
                    </div>

                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"><?php echo $success ?></div>
                    <?php } ?>

                    <?php if (isset($errformat)) { ?>
                        <div class="alert alert-danger"><?php echo $errformat ?></div>
                    <?php } ?>

                    <?php if (isset($err)) { ?>
                        <div class="alert alert-danger"><?php echo $err ?></div>
                    <?php } ?>

                    <?php if (isset($empty)) { ?>
                        <div class="alert alert-info"><?php echo $empty ?></div>
                    <?php } ?>

                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <input type="file" class="form-control" name="file">
                        </div>
                        <br>
                        <button name="add-slide" type="submit" class="btn btn-primary btn-block">افزودن</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>