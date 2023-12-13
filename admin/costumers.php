<?php include_once "fileadmin/page/header.php" ?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
} ?>
<?php
$action = new action("store of me", "root", "");
$query = "SELECT * FROM bascket WHERE status=?";
$row = ["1"];
$select = $action->select($query, $row, "fetchall");
?>

<div class="boxfather">
    <?php include_once 'fileadmin/page/sidebar.php' ?>
    <div class="leftbox" style="margin-top: 15px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="alert alert-secondary" style="font-size:18px;font-weight: bold;">
                        لیست مشتری ها
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>آیدی</th>
                                <th>نام مشتري</th>
                                <th>آدرس</th>
                                <th>پلاک</th>
                                <th>شماره همراه</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $z = 1; ?>
                            <?php foreach ($select as $value) { ?>
                                <tr>
                                    <td><?php echo $z ?></td>
                                    <td><?php echo $value->userid ?></td>
                                    <td><?php echo $value->address ?></td>
                                    <td><?php echo $value->plaque ?></td>
                                    <td><?php echo $value->phone ?></td>

                                </tr>
                            <?php $z++;
                            } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'fileadmin/page/footer.php' ?>