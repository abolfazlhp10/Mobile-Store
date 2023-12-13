<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>
<?php
if (isset($_POST["add-pro"])) {

    $file = $_FILES["file"];

    if (!empty($_POST["catid"]) and !empty($_POST["chid"]) and !empty($_POST["title"]) and !empty($_POST["seller"]) and !empty($_POST["warranty"]) and !empty($_POST["brand"]) and !empty($_POST["price"]) and !empty($_POST["pricem"]) and !empty($_POST["content"]) and !empty($_POST["tags"]) and !empty($file["name"])) {
        if ($file["type"] == "image/png" or $file["type"] == "image/jpg" or $file["type"] == "image/jpeg") {
            $ghesmate1 = explode(".", $file["name"]);
            $ghesmate2 = end($ghesmate1);
            $newname = "img-" . rand(1000, 9999) . "." . $ghesmate2;

            $query = "INSERT INTO product SET catid=?,chid=?,title=?,seller=?,warranty=?,brand=?,price=?,pricem=?,content=?,tags=?,picture=?";

            $row = [$_POST["catid"],$_POST["chid"], $_POST["title"], $_POST["seller"], $_POST["warranty"], $_POST["brand"], $_POST["price"], $_POST["pricem"], $_POST["content"], $_POST["tags"], $newname];

            $action->inud($query, $row);

            if ($action == true) {
                move_uploaded_file($file["tmp_name"], "fileadmin/product/" . $newname);
                $success = "محصول شما با موفقيت اضافه گرديد";
            }
        } else {
            $errformat = "فرمت فايل پشتيباني نميشود";
        }
    } else {
        $empty = "لطفا ابتدا تمام فيلدها را پر كنيد";
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
                        افزودن محصول
                    </div>

                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"><?php echo $success ?></div>
                    <?php } ?>

                    <?php if (isset($empty)) { ?>
                        <div class="alert alert-info"><?php echo $empty ?></div>
                    <?php } ?>

                    <?php if (isset($errformat)) { ?>
                        <div class="alert alert-danger"><?php echo $errformat ?></div>
                    <?php } ?>

                    <form method="post" enctype="multipart/form-data">
                        <?php
                        $query = "SELECT * FROM cat WHERE chid=?";
                        $row = ["0"];
                        $select = $action->select($query, $row, "fetchall");
                        ?>
                        <div class="form-group">

                            <select name="chid" class="form-control">
                                <?php foreach ($select as $value) { ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->catname ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php
                        $query = "SELECT * FROM cat WHERE NOT chid=?";
                        $row = ["0"];
                        $select2 = $action->select($query, $row, "fetchall");
                        ?>
                        <div class="form-group">

                            <select name="catid" class="form-control">
                                <?php foreach ($select2 as $value) { ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->catname ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="عنوان محصول">
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" name="seller" placeholder="فروشنده محصول">
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" name="warranty" placeholder="گارانتی">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="brand" placeholder="برند">
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" name="price" placeholder="قیمت فروش">
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" name="pricem" placeholder="قیمت اصلی">
                        </div>

                        <div class="form-group">
                            <textarea type="text" class="form-control" name="content" placeholder="توضیحات محصول"></textarea>
                            <script>
                                CKEDITOR.replace("content", {
                                    language: "fa"
                                });
                            </script>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="tags" placeholder="لطفا تگ ها را با خط فاصله از هم جدا كيند">
                        </div>

                        <div class="form-group">
                            <input type="file" class="form-control" name="file">
                        </div>

                        <button name="add-pro" type="submit" class="btn btn-primary btn-block">افزودن</button>
                        <br>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>