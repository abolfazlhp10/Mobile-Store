<?php require_once "files/head/header.php" ?>

<?php
if (isset($_SESSION["username"])) {
    header("location:index.php");
}
?>


<?php
//captcha
if (isset($_POST['btn-log'])) :
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) :
        //your site secret key
        $secret = '6LcUT30kAAAAAHXINuxcKzcvOvzR9U-Qdt555Yn8';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if ($responseData->success) :
            $succMsg = 'Your contact request have submitted successfully.';
        else :
            $errMsg = 'Robot verification failed, please try again';
        endif;
    else :
        $errMsg = 'Please click on the reCAPTCHA box';
    endif;
// else :
//     $errMsg = '';
//     $succMsg = '';
endif;
?>
<?php
if (isset($_POST["btn-log"])) {
    $username = $_POST["username"];
    $pswd = $_POST["password"];

    if (empty($username)) {
        $errusername = "لطفا نام کاربری یاایمیل خود را وارد کنید";
    } elseif (!empty($username)) {

        //check that $username is username or email

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {

            $query1 = "SELECT * FROM users WHERE email=?";
            $row1 = [$username];
            $natije1 = $action->select($query1, $row1);
            if ($natije1 != true) {
                $errusername = "کاربری با این ایمیل یافت نشد !";
            }
        }
        else{
            $query1 = "SELECT * FROM users WHERE username=?";
            $row1 = [$username];
            $natije1 = $action->select($query1, $row1);
            if ($natije1 != true) {
                $errusername = "کاربری با این نام کاربری یافت نشد !";
            }
        }
    }

    if (empty($pswd)) {
        $errpswd = "لطفا پسورد خود را وارد کنید";
    }

    if (empty($errusername) and empty($errpswd) and isset($succMsg)) {
        $action = new action("store of me", "root", "");

        if (filter_var($username,FILTER_VALIDATE_EMAIL)) {
            $query2 = "SELECT * FROM users WHERE email=? AND password=?";

        }else{
            $query2 = "SELECT * FROM users WHERE username=? AND password=?";
        }

        $row2 = [$username, md5(sha1($pswd))];

        //set cookie that expired after one month 
        if (isset($_POST["checkbox"])) {
            setcookie("username", $username, time() + (30 * 24 * 60 * 60));
            setcookie("password", $pswd, time() + (30 * 24 * 60 * 60));
        } else {
            setcookie("username", "");
            setcookie("password", "");
        }
        $natije = $action->select($query2, $row2);
        if ($natije == true) {
            session_start();
            session_regenerate_id();
            $_SESSION["username"] = $natije->username;
            header("location:index.php");
        } else {
            $errpswd = "رمز عبور وارد شده اشتباه است";
        }
    }
}



?>
<!------------ start login form ------------>
<div class="login">

    <!-- alert for successfull register -->
    <?php if (isset($_SESSION["success"])) : ?>
        <div class="alert alert-success">
            <?php echo $_SESSION["success"] ?>
            <?php unset($_SESSION["success"]) ?>
        </div>
    <?php endif; ?>


    <div class="login-top">
        <span> فرم ورود به سایت </span>
    </div>
    <?php if (isset($_GET["ebteda"])) { ?>
        <div class="alertComment1">
            <p>لطفا ابتدا به حساب کاربری خود وارد شوید</p>
        </div>
    <?php } ?>

    <?php if (isset($err)) { ?>
        <div class="alert-danger">
            <p><?php echo $err; ?></p>
        </div>
    <?php } ?>

    <div class="login-bot">


        <form method="post">
            <input type="text" placeholder="نام کاربری یا ایمیل خود را وارد کنید" name="username" value="<?php if (isset($_COOKIE["username"])) {
                                                                                                                echo $_COOKIE["username"];
                                                                                                            } ?>">
            <?php if (isset($errusername)) { ?>
                <span class="text-danger">
                    <?php echo $errusername ?>
                </span>
            <?php } ?>
            <input type="password" placeholder="رمز عبور خود را وارد کنید" name="password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                                        echo $_COOKIE["password"];
                                                                                                    } ?>">
            <?php if (isset($errpswd)) { ?>
                <span class="text-danger">
                    <?php echo $errpswd ?>
                </span>
            <?php } ?>
            <br>
            <input type="checkbox" name="checkbox" class="check" id="check" <?php if (isset($_COOKIE["username"]) or isset($_COOKIE["password"])) {
                                                                                echo "checked";
                                                                            } ?>><label for="check"> مرا به خاطر بسپار ! </label>
            <div class="g-recaptcha" data-sitekey="6LcUT30kAAAAAOkNBB9hAiHcsg4f1iLejkxPS2yF">
            </div>
            <?php if (isset($errMsg)) { ?>
                <span class="text-danger">
                    <?php echo $errMsg ?>
                </span>
            <?php } ?>
            <button type="submit" name="btn-log"> ورود به سایت </button>
        </form>
    </div>
</div>
<!------------ end login form ------------>
<?php require_once "files/head/footer.php" ?>