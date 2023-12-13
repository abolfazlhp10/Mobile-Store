<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
$query = "SELECT * FROM cat";
$row = [];
$select = $action->select($query, $row, "fetchall");
?>

<?php
if (isset($_GET["deletecat"])) {
    $query = "DELETE FROM cat WHERE id=?";
    $row = [$_GET["deletecat"]];
    $action->inud($query, $row);
    if ($action == true) {
        header("location:listcat.php?delete=success");
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
                        لیست دسته بندي
                    </div>
                    <?php if (isset($_GET["delete"])) { ?>
                        <div class="alert alert-success">
                            حذف دسته بندی با موفقیت انجام شد
                        </div>
                    <?php } ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام دسته بندي</th>
                                <th>نوع دسته بندي</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($select as $value) { ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->catname ?></td>
                                    <td><?php if ($value->chid == "0") {
                                            echo "دسته بندی اصلی";
                                        } else {
                                            $query = "SELECT * FROM cat WHERE id=?";
                                            $row = [$value->chid];
                                            $natije = $action->select($query, $row);
                                            echo $natije->catname;
                                        } ?></td>
                                    <td><a href="<?php echo "editcat.php?editcat=" . $value->id ?>" class="btn btn-warning" style="padding: 7px;font-size:14px;">ویرایش</a></td>
                                    <td><a href="<?php echo "listcat.php?deletecat=" . $value->id ?>" class="btn btn-danger" style="padding: 7px;font-size:14px;">حذف</a></td>
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