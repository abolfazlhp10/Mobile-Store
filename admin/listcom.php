<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");

?>
<?php
//show all comments
$query = "SELECT * FROM comment_table";
$row = [];
$selectcom = $action->select($query, $row, "fetchall");
?>

<?php
//taeed ya rad nazar

if (isset($_GET["taeed"])) {
    $query = "UPDATE comment_table SET status=? WHERE id=?";
    $row = ["1", $_GET["taeed"]];
    $action->inud($query, $row);
    header("location:listcom.php");
}
if (isset($_GET["rad"])) {
    $query = "UPDATE comment_table SET status=? WHERE id=?";
    $row = ["0", $_GET["rad"]];
    $action->inud($query, $row);
    header("location:listcom.php");
}

?>

<?php
//delete nazar

if (isset($_GET["deletecom"])) {
    $query = "DELETE FROM comment_table WHERE id=?";
    $row = [$_GET["deletecom"]];
    $action->inud($query, $row);
    if ($action == true) {
        header("location:listcom.php?delete=success");
    }
}

?>

<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-12 ">
                    <div class="alert alert-secondary" style="font-size:18px;font-weight: bold;">
                        لیست نظرات
                    </div>
                    <br>
                    <?php if (isset($_GET["sendrep"])) { ?>
                        <div class="alert alert-success">
                            پاسخ شما با موفقيت ارسال گرديد
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET["delete"])) { ?>
                        <div class="alert alert-success">
                            حذف نظر با موفقیت انجام شد
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET["edit"])) { ?>
                        <div class="alert alert-success">
                            ويرايش نظر با موفقیت انجام شد
                        </div>
                    <?php } ?>
                    <table class="table table-hover table-sm small">
                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام پست</th>
                                <th>نام</th>
                                <th>نظر</th>
                                <th>ایمیل</th>
                                <th>وضعيت</th>
                                <th>پاسخ</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($selectcom as $value) { ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td>
                                        <?php
                                        $query = "SELECT * FROM product WHERE id=?";
                                        $row = [$value->postid];
                                        $res = $action->select($query, $row);
                                        echo mb_substr($res->title, "0", "40");
                                        ?>
                                    </td>
                                    <td><?php echo $value->name ?></td>
                                    <td><?php echo $value->comment ?></td>
                                    <td><?php echo $value->email ?></td>
                                    <td>
                                        <?php if ($value->status == 0) { ?>
                                            <a href="<?php echo "listcom.php?taeed=" . $value->id ?>" class="btn btn-success" style="padding: 7px;font-size:14px;">
                                                تاييد
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo "listcom.php?rad=" . $value->id ?>" class="btn btn-danger" style="padding: 7px;font-size:14px;">
                                                رد
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($value->reply == 0) { ?>
                                            <a href="<?php echo "repcom.php?id=" . $value->id ?>" class="btn btn-info" style="padding: 7px;font-size:14px;">پاسخ</a>
                                        <?php } else { ?>
                                            <span class="btn btn-dark" style="padding: 7px;font-size:14px;">پاسخ</span>
                                        <?php } ?>
                                    </td>
                                    <td><a href="<?php echo "editcom.php?editcom=" . $value->id ?>" class="btn btn-warning" style="padding: 7px;font-size:14px;">ویرایش</a></td>
                                    <td><a href="<?php echo "listcom.php?deletecom=" . $value->id ?>" class="btn btn-danger" style="padding: 7px;font-size:14px;">حذف</a></td>
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