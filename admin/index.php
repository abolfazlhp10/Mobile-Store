<?php include_once 'fileadmin/page/header.php'; ?>
<?php
if (isset($_POST["btnlog"])) {
    $action = new action("store of me", "root", "");
    if (!empty($_POST["username"]) and !empty($_POST["password"])) {
        $query = "SELECT * FROM admin WHERE username=? AND password=?";
        $row = [$_POST["username"], $_POST["password"]];
        $natije = $action->select($query, $row);
        if ($natije == true) {
            session_regenerate_id();
            $_SESSION["adminusername"] = $natije->username;
            header("location:dashbord.php");
        } else {
            $errlog = "نام کاربری یا رمز عبور اشتباه است";
        }
    } else {
        $empty = "لطفا ابتدا تمام فیلدها را پر کنید";
    }
} ?>

<div class="boxfader">
    <div class="ADDmininputLOG">
        <h3 style="text-align: center">فرم ورود مدیریت</h3><br>
        <?php if (isset($errlog)) { ?>
            <div class="alert alert-danger">
                <?php echo $errlog ?>
            </div>
        <?php } ?>

        <?php if (isset($empty)) { ?>
            <div class="alert alert-danger">
                <?php echo $empty ?>
            </div>
        <?php } ?>

        <?php if (isset($_GET["ebteda"])) { ?>
            <div class="alert alert-info">
                لطفا ابتدا وارد شوید
            </div>
        <?php } ?>

        <form method="post">
            <input type="text" placeholder="نام کاربری" name="username" value="<?php @$_POST['username'] ?>"><br>
            <input type="password" placeholder="پسورد" name="password" <?php @$_POST['password'] ?>><br>
            <button type="submit" name="btnlog">ورود به داشبورد</button>
        </form>
    </div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>