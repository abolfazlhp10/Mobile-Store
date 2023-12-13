<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>

<?php
$action = new action("store of me", "root", "");
$query = "SELECT * FROM bascket";
$row = [];
$select = $action->select($query, $row, "fetchall");
?>

<?php
if (isset($_GET["deletebas"])) {
    $query = "DELETE FROM bascket WHERE id=?";
    $row = [$_GET["deletebas"]];
    $action->inud($query, $row);
    if ($action == true) {
        header("location:listbasc.php?delete=success");
    }
}
?>
<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="alert alert-secondary" style="font-size:18px;font-weight: bold;">
                        لیست سفارشات
                    </div>
                    <?php if (isset($_GET["delete"])) { ?>
                        <div class="alert alert-success">
                            حذف سفارش با موفقیت انجام شد
                        </div>
                    <?php } ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام مشتري</th>
                                <th>نام محصول</th>
                                <th>وضعیت</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($select as $value) { ?>
                                <?php
                                //convert product id to product title
                                $query = "SELECT * FROM product WHERE id=?";
                                $row = [$value->proid];
                                $selectedpro = $action->select($query, $row);

                                ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->userid ?></td>
                                    <td><?php echo mb_substr($selectedpro->title, "0", "60") ?></td>
                                    <?php if ($value->status == "0") { ?>
                                        <td><span class="btn btn-secondary" style="padding: 7px;font-size:14px;">پرداخت نشده</span></td>
                                    <?php } else { ?>
                                        <td><span class="btn btn-success" style="padding: 7px;font-size:14px;">پرداخت شده</span></td>
                                    <?php } ?>
                                    <td><a href="<?php echo "listbasc.php?deletebas=" . $value->id ?>" class="btn btn-danger" style="padding: 7px;font-size:14px;">حذف</a></td>
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