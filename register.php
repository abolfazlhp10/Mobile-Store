<?php require_once "files/head/header.php" ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "files/email/PHPMailer/src/Exception.php";
require "files/email/PHPMailer/src/PHPMailer.php";
require "files/email/PHPMailer/src/SMTP.php";
?>

<?php
if (isset($_SESSION["username"])) {
    header("location:index.php");
}
?>


<?php
//captcha
if (isset($_POST['btn-register'])) :
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
$action = new action("store of me", "root", "");

$errors = [];

if (isset($_POST["btn-register"])) {

    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pswd = $_POST["pswd"];
    $mpswd = $_POST["mpswd"];

    if (empty($name)) {
        $errors['errname'] = 'لطفا نام خود را وارد كنيد';
    }
    if (empty($username)) {
        $errors['errusername'] = 'لطفا نام كاربري خود را وارد كنيد';
    }

    if (empty($email)) {
        $errors['erremail'] = 'لطفا ايميل خود را وارد كنيد';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['erremail'] = 'لطفا یک ايميل معتبر وارد كنيد';
    }

    if (empty($pswd)) {
        $errors['errpswd'] = 'لطفا پسورد خود را وارد كنيد';
    }
    if (empty($mpswd)) {
        $errors['errmpswd'] = 'لطفا تكرار پسورد خود را وارد كنيد';
    }

    if ($pswd != $mpswd) {
        $errors["errmpswd"] = "رمز وارد شده يكسان نيست";
    }

    //check if username exists or not

    $query = "SELECT * FROM users WHERE username=?";
    $row = [$username];
    $selectusername = $action->select($query, $row, "fetchall");
    if ($selectusername == true) {
        $errors['errusername'] = "نام كاربري  قبلا انتخاب شده است";
    }

    //check if email exists or not
    $query = "SELECT * FROM users WHERE email=?";
    $row = [$email];
    $selectemail = $action->select($query, $row, "fetchall");
    if ($selectemail == true) {
        $errors['erremail'] = "ایمیل  قبلا انتخاب شده است";
    }



    if (empty($errors) and isset($succMsg)) {

        $query = "INSERT INTO users SET name=?,username=?,email=?,password=?,ip=?";
        $row = [$name, $username, $email, md5(sha1($pswd)), $_SERVER["REMOTE_ADDR"]];
        $action->inud($query, $row);
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->Subject = "ثبت نام در سايت موبایل شاپ";
        $mail->Username = "abolfazl.hadipour810@gmail.com";
        $mail->Password = "";
        $mail->setFrom("", "amuzeshtak");
        $mail->addAddress($email);
        $mail->msgHTML("ثبت نام شما با موفقيت انجام گرديد");
        $mail->send();
        $_SESSION['success'] = "ثبت نام شما با موفقيت انجام شد";
        header("location:login.php");
    }
}





?>

<!------------ start login form ------------>

<div class="sighn">

    <div class="login-top">
        <span> فرم ثبت نام در سایت </span>
    </div>


    <?php if (isset($usrrepeat)) { ?>
        <div class="alert-danger">
            <p><?php echo $usrrepeat ?></p>
        </div>
    <?php } ?>

    <?php if (isset($success)) { ?>
        <div class="alert-success">
            <p><?php echo $success ?></p>
        </div>
    <?php } ?>

    <div class="login-bot">
        <form method="post">

            <div class="form-group">
                <input type="text" placeholder="نام خود را وارد کنید" name="name" value="<?php echo @$_POST['name'] ?>" class="form-control<?php if (isset($errors['errname'])) : ?> is-invalid <?php endif; ?>">
                <span class="invalid-feedback text-danger">
                    <?php echo @$errors["errname"] ?>
                </span>
            </div>

            <div class="form-group">
                <input type="text" placeholder="نام کاربری خود را وارد کنید" name="username" value="<?php echo @$_POST['username'] ?>" class="form-control<?php if (isset($errors['errusername'])) : ?> is-invalid <?php endif; ?>">
                <span class="invalid-feedback text-danger">
                    <?php echo @$errors["errusername"] ?>
                </span>
            </div>

            <div class="form-group">
                <input type="text" placeholder="ايميل خود را وارد کنید" name="email" value="<?php echo @$_POST['email'] ?>" class="form-control<?php if (isset($errors['erremail'])) : ?> is-invalid <?php endif; ?>">
                <span class="invalid-feedback text-danger">
                    <?php echo @$errors["erremail"] ?>
                </span>
            </div>

            <div class="form-group">
                <input type="password" placeholder="رمزعبور خود را وارد کنید" name="pswd" value="<?php echo @$_POST['pswd'] ?>" class="form-control<?php if (isset($errors['errpswd'])) : ?> is-invalid <?php endif; ?>">
                <span class="text-danger">
                    <?php echo @$errors["errpswd"] ?>
                </span>
            </div>

            <div class="form-group">
                <input type="password" placeholder="رمزعبور خود را وارد کنید" name="mpswd" value="<?php echo @$_POST['mpswd'] ?>" class="form-control<?php if (isset($errors['errmpswd'])) : ?> is-invalid <?php endif; ?>">
                <span class="invalid-feedback text-danger">
                    <?php echo @$errors["errmpswd"] ?>
                </span>
            </div>

            <div class="g-recaptcha" data-sitekey="6LcUT30kAAAAAOkNBB9hAiHcsg4f1iLejkxPS2yF">

            </div>
            <?php if (isset($errMsg)) : ?>
                <span class="text-danger">
                    <?php echo $errMsg ?>
                </span>
            <?php endif; ?>


            <button type="submit" name="btn-register"> ثبت نام در سایت </button>
        </form>
    </div>
</div>
<!------------ end login form ------------>
<?php require_once "files/head/footer.php" ?>