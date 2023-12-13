<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>
<?php
if (isset($_GET["id"])) {
    $query = "SELECT * FROM comment_table WHERE id=?";
    $row = [$_GET["id"]];
    $selectcom = $action->select($query, $row);
}
?>
<?php
if (isset($_POST["send-rep"])) {
    if (!empty($_POST["reply"])) {
        $query = "INSERT INTO comment_table SET postid=?,name=?,email=?,comment=?,status=?,reply=?";
        $row = [$selectcom->postid, $_POST["name"], $_POST["email"], $_POST["reply"], "1", $_GET["id"]];
        $action->inud($query, $row);
        if ($action == true) {
            header("location:listcom.php?sendrep=success");
        }
    } else {
        $empty = "لطفا ابتدا فیلدهای خالی را پر کنید";
    }
}
?>

<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="alert alert-warning" style="font-size:18px;font-weight: bold;">
                        ارسال پاسخ
                    </div>
                    <?php if (isset($empty)) { ?>
                        <div class="alert alert-info"><?php echo $empty ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $selectcom->name ?>" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo $selectcom->comment ?>" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="نام شما">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="ايميل شما">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="reply" placeholder="پاسخ شما">
                        </div>
                        <button name="send-rep" type="submit" class="btn btn-primary btn-block">ارسال</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>