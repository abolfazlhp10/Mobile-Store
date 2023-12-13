<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
$query = "SELECT * FROM users";
$row = [];
$select = $action->select($query, $row, "fetchall");
?>
<?php
//delete users
if (isset($_GET["deluser"])) {

    $query = "DELETE FROM users WHERE id=?";
    $row = [$_GET["deluser"]];
    $action->inud($query, $row);
    if ($action == true) {
        header("location:showusers.php?delete=success");
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
                        لیست کاربران
                    </div>
                    <?php if (isset($_GET["delete"])) { ?>
                        <div class="alert alert-success">
                            حذف کاربر با موفقیت انجام شد
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET["edit"])) { ?>
                        <div class="alert alert-success">
                            ویرایش کاربر با موفقیت انجام شد
                        </div>
                    <?php } ?>
                    <table class="table table-hover small">
                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام </th>
                                <th>نام كاربري </th>
                                <th>ايميل </th>
                                <th>آیپی</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($select as $value) { ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->name ?></td>
                                    <td><?php echo $value->username ?></td>
                                    <td><?php echo $value->email ?></td>
                                    <td><?php echo $value->ip ?></td>
                                    <td><a href="<?php echo "editusers.php?edituser=" . $value->id ?>" class="btn btn-warning" style="padding: 7px;font-size:14px;">ویرایش</a></td>
                                    <td><a href="<?php echo "showusers.php?deluser=" . $value->id ?>" class="btn btn-danger" style="padding: 7px;font-size:14px;">حذف</a></td>
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