<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
?>
<?php
//delete product
if (isset($_GET["deletepro"])) {
    $query = "SELECT * FROM product WHERE id=?";
    $row = [$_GET["deletepro"]];
    $selectedpro = $action->select($query, $row);
    unlink("fileadmin/product/" . $selectedpro->picture);
    $query = "DELETE FROM product WHERE id=?";
    $row = [$_GET["deletepro"]];
    $action->inud($query, $row);
    if ($action == true) {
        header("location:listproduct.php?delete=success");
    }
}

?>

<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-12 ">
                    <div class="alert alert-secondary" style="font-size:18px;font-weight: bold;margin-right: 40px;">
                        لیست محصولات سايت
                    </div>
                    <?php if (isset($_GET["delete"])) { ?>
                        <div class="alert alert-success">
                            محصول مورد نظر با موفقيت حذف گرديد
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET["edit"])) { ?>
                        <div class="alert alert-success">
                            محصول شما با موفقيت ويرايش گرديد
                        </div>
                    <?php } ?>

                    <table class="table table-hover small">

                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام دسته بندي</th>
                                <th>نام محصول</th>
                                <th>عكس</th>
                                <th>فروشنده</th>
                                <th>قيمت</th>
                                <th>تاريخ</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM product";
                            $row = [];
                            $select = $action->select($query, $row, "fetchall");
                            ?>

                            <?php foreach ($select as $value) { ?>
                                <?php
                                $query1 = "SELECT * FROM cat WHERE id=?";
                                $row1 = [$value->catid];
                                $res = $action->select($query1, $row1);
                                ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $res->catname ?></td>
                                    <td><?php echo mb_substr($value->title,"0","40") ?></td>
                                    <td><img src="<?php echo "fileadmin/product/" . $value->picture ?>" width="70px"></td>
                                    <td><?php echo $value->seller ?></td>
                                    <td><?php echo number_format($value->price) ?></td>
                                    <?php $time = explode("-", $value->date) ?>
                                    <td><?php echo gregorian_to_jalali($time[0], $time[1], $time[2], "/"); ?></td>
                                    <td><a href="<?php echo "editpro.php?editpro=" . $value->id ?>" class="btn btn-warning" style="padding: 7px;font-size:14px;">ویرایش</a></td>
                                    <td><a href="<?php echo "listproduct.php?deletepro=" . $value->id ?>" class="btn btn-danger" style="padding: 7px;font-size:14px;">حذف</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>