<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>
<?php
if (isset($_GET["editcom"])) {
    $query = "SELECT * FROM comment_table WHERE id=?";
    $row = [$_GET["editcom"]];
    $selectcom = $action->select($query, $row);
}
?>
<?php
if (isset($_POST["edit-com"])) {
    if (!empty($_POST["name"]) and !empty($_POST["email"]) and !empty($_POST["comment"])) {
        $query = "UPDATE comment_table SET name=?,email=?,comment=? WHERE id=?";
        $row = [$_POST["name"], $_POST["email"], $_POST["comment"], $_GET["editcom"]];
        $action->inud($query, $row);
        if ($action == true) {
            header("location:listcom.php?edit=success");
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
                        ويرايش نظر
                    </div>


                    <?php if (isset($existusername)) { ?>
                        <div class="alert alert-danger"><?php echo $existusername ?></div>
                    <?php } ?>

                    <?php if (isset($empty)) { ?>
                        <div class="alert alert-info"><?php echo $empty ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="<?php echo $selectcom->name ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" value="<?php echo $selectcom->email ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="comment" value="<?php echo $selectcom->comment ?>">
                        </div>
                        <button name="edit-com" type="submit" class="btn btn-primary btn-block">ويرايش</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>