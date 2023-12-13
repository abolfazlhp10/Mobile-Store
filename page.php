<?php require_once "files/head/header.php" ?>
<?php
if (isset($_GET["pro"])) {
    $action = new action("store of me", "root", "");
    $query = "SELECT * FROM product WHERE id=?";
    $row = [$_GET["pro"]];
    $select = $action->select($query, $row);
    $time = $action->timetofarsi($select->date);
}
?>
<?php
if (isset($_POST["add-to-bascket"])) {
    if (isset($_SESSION["username"])) {
        $query = "INSERT INTO bascket SET proid=?,userid=?";
        $row = [$_GET["pro"], $_SESSION["username"]];
        $action->inud($query, $row);
        if ($action == true) {
            header("location:bascket.php?add=true");
        }
    } else {
        header("location:login.php?ebteda=vorod");
    }
}
?>

<div class="det-product">
    <p><?php echo $select->title ?></p>
</div>

<div class="pic-box">
    <div class="pic-product">
        <img src="<?php echo "admin/fileadmin/product/$select->picture" ?>">
    </div>
    <div class="desc-product">
        <p> تاریخ ثبت محصول : <?php echo $time ?> </p>
        <p> فروشنده این محصول : <?php echo $select->seller ?> </p>
        <p> گارانتی : <?php echo $select->warranty ?> </p>
        <p> دسته بندی محصول : <?php echo $action->catidtocatname($select->catid) ?> </p>
        <p> برند : <?php echo $select->brand ?> </p>
        <span> قیمت نهایی محصول <?php echo number_format($select->price) ?> تومان </span>

        <form method="post">
            <button type="submit" name="add-to-bascket"> افزودن محصول به سبد خرید </button>
        </form>
    </div>
</div>
<div class="descrip-pro">

    <h4 style="color: #6b6b6b"> بررسی تخصصی محصول </h4>
    <p>
        <?php echo $select->content ?>
    </p>
    <?php
    $ex = explode("-", $select->tags);
    ?>
    <?php foreach ($ex as $value) { ?>
        <span style="background-color:#12a1ee;padding:5px 15px;border-radius: 4px;color:#ffffff;font-size:14px;margin-right:10px;"><?php echo $value ?></span>
    <?php } ?>
</div>
<div class="tabligh"> </div>
<div class="onvan1">
    <h4>کالای مشابه</h4>
</div>
<div class="dop-pro">
    <!------------ start box ------------>
    <?php
    $query = "SELECT * FROM product WHERE brand=?";
    $row = [$select->brand];
    $s = $action->select($query, $row, "fetchall");
    ?>
    <?php foreach ($s as $value) { ?>
        <div class="div div1">
            <div class="image-box">
                <img src="<?php echo "admin/fileadmin/product/$value->picture" ?>">
            </div>
            <div class="text-box">
                <p> <?php echo mb_substr($value->title, "0", "55") ?></p>
            </div>
            <div class="price-box">
                <p> <?php echo number_format($value->price) ?> </p>
            </div>
        </div>
    <?php } ?>
    <!------------ end box ------------>
</div>
<!------------ end box ------------>
<div class="onvan1">
    <h4>نظرات کاربران در مورد این محصول</h4>
</div>
<?php
$query = "SELECT * FROM comment_table WHERE postid=? AND status=? AND reply=?";
$row = [$_GET["pro"], "1", "0"];
$selectcom = $action->select($query, $row, "fetchall");

?>
<?php foreach ($selectcom as $value) { ?>
    <div class="comment">
        <span style="color: #ffffff;font-size: 13px;margin: 20px"><?php echo $value->name ?> </span>
        <span style="color: #ffffff;font-size: 12px;margin: 20px"> در تاریخ : <?php echo $action->timetofarsi($value->time) ?> </span>
        <div class="box">
            <span> <?php echo $value->comment ?></span>
        </div>
        <?php
        $query = "SELECT * FROM comment_table WHERE reply=?";
        $row = [$value->id];
        $seladcom = $action->select($query, $row, "fetchall");
        ?>
        <?php foreach ($seladcom as $item) { ?>
            <span style="color: #ffffff;font-size: 13px;margin: 10px"> <?php echo $item->name ?></span>
            <span style="color: #ffffff;font-size: 12px;margin: 5px">در تاریخ : <?php echo $action->timetofarsi($item->time) ?></span>
            <div class="boxcom">
                <span><?php echo $item->comment ?></span>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?php
if (isset($_POST["add-comment"])) {
    if (!empty($_POST["name"]) and !empty($_POST["email"]) and !empty($_POST["comment"])) {
        $query = "INSERT INTO comment_table SET postid=?,name=?,email=?,comment=?";
        $row = [$_GET["pro"], $_POST["name"], $_POST["email"], $_POST["comment"]];
        $action->inud($query, $row);
        if ($action == true) {
            $succ = "نظر شما با موفقیت ثبت گردید";
        }
    } else {
        $empty = "لطفا ابتدا تمام فیلدها را پر کنید";
    }
}

?>
<?php if (isset($succ)) { ?>
    <div class="alertComment">
        <p><?php echo $succ ?></p>
    </div>
<?php } ?>
<?php if (isset($empty)) { ?>
    <div class="alertComment3">
        <p><?php echo $empty ?></p>
    </div>
<?php } ?>
<div class="sendComment">
    <div class="right">
        <form method="post">
            <input type="text" placeholder="نام خود را وارد کنید" name="name"><br>
            <input type="email" placeholder="ایمیل خود را وارد کنید" name="email" style="margin-top: 10px"><br>
            <textarea placeholder="نظر خود را بنویسید" cols="10" rows="3" size="none" name="comment"></textarea>
            <button type="submit" name="add-comment"> ثبت نظر </button>
        </form>
    </div>
    <div class="left">
        <li>کامنت های حاوی توهین نمایش داده نخواهد شد</li>
        <li>از ارسال کامنت بصورت فینگلیش خودداری فرمایید</li>
        <li>لطفا نظر خود در مورد محصول خریداری شده را بصورت کامل و واضح بیان کنید</li>
        <li>در صورت وجود مشکل در بخش ثبت یا پرداخت مبالغ محصول از قسمت تماس با ما بصورت مستقیم تماس حاصل فرمایید</li>
        <li>نظرات بعد از تایید مدیریت نمایش داده خواهد شد،شکیبا باشید</li>
    </div>
</div>


<!------------ end box ------------>
<?php require_once "files/head/footer.php" ?>