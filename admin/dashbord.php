<?php include_once "fileadmin/page/header.php"?>
<?php if (!isset($_SESSION["adminusername"])) {
    header("location:index.php?ebteda=vorod");
}?>
    <div class="boxfather">
        <?php include_once 'fileadmin/page/sidebar.php' ?>
        <div class="leftbox">
        </div>
    </div>
<?php include_once 'fileadmin/page/footer.php' ?>