<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>

<?php if (isset($_POST["add-cat"])) {
    if (!empty($_POST["catname"])) {
        $query = "SELECT * FROM cat WHERE catname=?";
        $row = [$_POST["catname"]];
        $natije = $action->select($query, $row, "fetchall");
        if ($natije == true) {
            $existcat = "دسته بندی مورد نظر هم اکنون وجود دارد";
        } else {
            $query = "INSERT INTO cat SET catname=?,chid=?";
            $row = [$_POST["catname"], $_POST["chid"]];
            $action->inud($query, $row);
            if ($action == true) {
                $success = "دسته بندی مورد نظر با موفقیت اضافه گردید";
            } else {
                $err = "خطا در افزودن دسته بندی";
            }
        }
    } else {
        $empty="لطفا نام دسته بندی خود را وارد کنید";
    }
} ?>
<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="alert alert-secondary" style="font-size:18px;font-weight: bold;">
                        افزودن دسته بندي
                    </div>

                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"><?php echo $success ?></div>
                    <?php } ?>

                    <?php if (isset($err)) { ?>
                        <div class="alert alert-danger"><?php echo $err ?></div>
                    <?php } ?>

                    <?php if (isset($existcat)) { ?>
                        <div class="alert alert-info"><?php echo $existcat ?></div>
                    <?php } ?>

                    <?php if (isset($empty)) { ?>
                        <div class="alert alert-info"><?php echo $empty ?></div>
                    <?php } ?>

                        <form method="post">

                            <div class="form-group">
                                <input type="text" class="form-control" name="catname" placeholder="افزودن دسته بندي">
                            </div>
                            <?php
                            $query = "SELECT * FROM cat";
                            $row = [];
                            $select = $action->select($query, $row, "fetchall");
                            ?>
                            <select name="chid" class="form-control">
                                <option value="0" class="active">دسته بندی اصلی</option>
                                <?php foreach ($select as $item) { ?>
                                    <option value="<?php echo $item->id ?>"><?php echo $item->catname ?></option>
                                <?php } ?>
                            </select>

                            <br>
                            <button name="add-cat" type="submit" class="btn btn-primary btn-block">افزودن</button>
                        </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>