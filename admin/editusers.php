<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>
<?php
if (isset($_GET["edituser"])) {
    $query = "SELECT * FROM users WHERE id=?";
    $row = [$_GET["edituser"]];
    $select = $action->select($query, $row);
}
?>
<?php
if (isset($_POST["edit-user"])) {
    if (!empty($_POST["name"]) and !empty($_POST["username"]) and !empty($_POST["email"]) and !empty($_POST["pswd"])) {
        $query = "SELECT * FROM users WHERE username=? AND NOT id=?";
        $row = [$_POST["username"], $_GET["edituser"]];
        $natije = $action->select($query, $row);
        if ($natije == true) {
            $existusername = "نام کاربری انتخاب شده از قبل وجود دارد";
        } else {
            $query = "UPDATE users SET name=?,username=?,email=?,password=? WHERE id=?";
            $row = [$_POST["name"], $_POST["username"], $_POST["email"], $_POST["pswd"], $_GET["edituser"]];
            $action->inud($query, $row);
            if ($action == true) {
                header("location:showusers.php?edit=success");
            }
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
                        ويرايش کاربر
                    </div>


                    <?php if (isset($existusername)) { ?>
                        <div class="alert alert-danger"><?php echo $existusername ?></div>
                    <?php } ?>

                    <?php if (isset($empty)) { ?>
                        <div class="alert alert-info"><?php echo $empty ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="<?php echo $select->name ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" value="<?php echo $select->username ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" value="<?php echo $select->email ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pswd" value="<?php echo $select->password ?>">
                        </div>
                        <button name="edit-user" type="submit" class="btn btn-primary btn-block">ويرايش</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>