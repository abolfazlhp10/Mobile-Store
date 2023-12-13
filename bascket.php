<?php require_once "files/head/header.php" ?>
<?php $action = new action("store of me", "root", "") ?>
<!-------------- start Table ------------->
<?php if (!isset($_SESSION["username"])) {
    header("location:login.php?ebteda=vorod");
} ?>
<div class="container">
    <?php if (isset($_GET["add"])) { ?>
        <div class="alertComment1">
            <p>
                محصول مورد نظر با موفقیت به سبد خرید افزوده شد
            </p>
        </div>
    <?php } ?>
    <?php if (isset($_GET["price"])) { ?>
        <div class="alertComment1">
            <p>
                خرید شما با موفقیت انجام شد
            </p>
        </div>
    <?php } ?>
    <?php
    //delete from bascket
    if (isset($_GET["delete"])) {
        $query = "DELETE FROM bascket WHERE id=?";
        $row = [$_GET["delete"]];
        $action->inud($query, $row);
        if ($action == true) {
            header("location:bascket.php");
        }
    }
    ?>
    <?php
    if (isset($_SESSION["username"])) {
        $query = "SELECT * FROM bascket WHERE userid=? AND status=?";
        $row = [$_SESSION["username"], "0"];
        $bascket = $action->select($query, $row, "fetchall");
        $count = count($bascket);
    }
    ?>
    <table style="border: 1px solid #dddddd;">
        <thead>
            <tr>
                <th> آیدی محصول </th>
                <th> نام محصول </th>
                <th> قیمت محصول </th>
                <th> حذف از سبد </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $z = 1;
            $sum = 0;
            ?>
            <?php foreach ($bascket as $value) { ?>
                <?php
                $query = "SELECT * FROM product WHERE id=?";
                $row = [$value->proid];
                $selectpro = $action->select($query, $row);
                ?>
                <tr>
                    <td><?php echo $z; ?></td>
                    <td><?php echo $selectpro->title ?></td>
                    <td>
                        <?php
                        echo number_format($selectpro->price);
                        $sum = $sum + $selectpro->price;
                        ?>
                    </td>
                    <td> <a href="<?php echo "bascket.php?delete=" . $value->id ?>" class="text-danger"> حذف </a> </td>
                </tr>
            <?php $z++;
            } ?>

        </tbody>
    </table>
    <br>
    <table style="border: 1px solid #dddddd;">
        <tr>
            <td colspan="2">
                <p style="font-weight: bold;">تعداد محصول خريداري شده : <?php echo $count ?> عدد </p>
                <?php $_SESSION["count"] = $count ?>
            </td>
            <td colspan="1">
                <p style="font-weight: bold;">مجموع قيمت : <?php echo number_format($sum);
                                                            $_SESSION["sum"] = $sum ?></p>
            </td>

        </tr>
    </table>
    <br>
    <?php if ($sum != 0) { ?>
        <a href="address.php" class="nahayi">نهایی کردن خرید</a>
    <?php } ?>
</div>
<!-------------- end Table ------------->
<?php require_once "files/head/footer.php" ?>