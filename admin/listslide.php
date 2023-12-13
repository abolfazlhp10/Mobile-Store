<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php $action = new action("store of me", "root", ""); ?>
<?php
$query = "SELECT * FROM slider";
$row = [];
$select = $action->select($query, $row, "fetchall")
?>
<?php
//delete slide
if (isset($_GET["deleteslide"])) {
    $query = "SELECT * FROM slider WHERE id=?";
    $row = [$_GET["deleteslide"]];
    $selectpic = $action->select($query, $row);
    unlink("fileadmin/slider/" . $selectpic->picture);
    $query = "DELETE FROM slider WHERE id=?";
    $row = [$_GET["deleteslide"]];
    $action->inud($query, $row);
    if ($action == true) {
        header("location:listslide.php?delete=success");
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
                        لیست اسلایدها
                    </div>
                    <?php if (isset($_GET["delete"])) { ?>
                        <div class="alert alert-success">
                            عکس مورد نظر با موفقیت حذف گردید
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET["edit"])) { ?>
                        <div class="alert alert-success">
                            عکس مورد نظر با موفقیت ويرايش گردید
                        </div>
                    <?php } ?>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام عکس</th>
                                <th> عکس</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($select as $value) { ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->picture ?></td>
                                    <td><img src="<?php echo "fileadmin/slider/" . $value->picture ?>" width="80px"></td>
                                    <td><a href="<?php echo "editslide.php?editslide=" . $value->id ?>" class="btn btn-warning" style="padding: 7px;font-size:14px;">ویرایش</a></td>
                                    <td><a href="<?php echo "listslide.php?deleteslide=" . $value->id ?>" class="btn btn-danger" style="padding: 7px;font-size:14px;">حذف</a></td>
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