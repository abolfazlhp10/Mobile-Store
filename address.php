<?php require_once "files/head/header.php" ?>
<?php $action = new action("store of me", "root", "") ?>
<!-------------- start Table ------------->
<?php if (!isset($_SESSION["username"])) {
    header("location:login.php?ebteda=vorod");
} ?>
<?php
if (isset($_POST["btn-continue"])) {
    if (!empty($_POST["address"]) and !empty($_POST["plaque"]) and !empty($_POST["phone"])) {

        $query = "UPDATE bascket SET address=?,plaque=?,phone=? WHERE userid=?";
        $row = [$_POST["address"], $_POST["plaque"], $_POST["phone"], $_SESSION["username"]];
        $action->inud($query, $row);
        if ($action == true) {
            header("location:request.php");
        }
    } else {
        header("location:address.php?empty=true");
    }
}
?>
<div class="container">
    <?php if (isset($_GET["empty"])) { ?>
        <div class="alertComment1">
            <p>لطفا ابتدا تمام فیلدها را پر کنید</p>
        </div>
    <?php } ?>
    <form method="post">
        <div>
            <input type="text" placeholder="آدرس" class="form-control" name="address">
        </div>
        <div>
            <input type="text" placeholder="پلاک" name="plaque" class="form-control">
        </div>
        <div>
            <input type="text" placeholder="شماره تلفن" name="phone" class="form-control">
        </div>
        <button name="btn-continue">ادامه خرید</button>

    </form>
</div>
<!-------------- end Table ------------->
<?php require_once "files/head/footer.php" ?>