<?php require_once "files/head/header.php" ?>
<?php $action = new action("store of me", "root", "") ?>

<?php
if (isset($_GET["catid"])) {
    $query = "SELECT * FROM product WHERE catid=?";
    $row = [$_GET["catid"]];
    $selectpro = $action->select($query, $row, "fetchall");
}
?>
<!------------ start slider ------------>

<div class="slideshow-container">
    <?php
    $query = "SELECT * FROM slider";
    $row = [];
    $select = $action->select($query, $row, "fetchall");
    ?>
    <?php foreach ($select as $value) { ?>
        <div class="mySlides fade">
            <img src="<?php echo "admin/fileadmin/slider/" . $value->picture ?>" style="width:100%">
        </div>
    <?php } ?>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<!------------ end slider ------------>

<!------------ start body ------------>
<div class="onvan">
    <p>نتیجه : </p>
</div>
<div class="section">
    <?php foreach ($selectpro as $value) { ?>
        <!------------ start box ------------>
        <div class="div div1">
            <a href="<?php echo "page.php?pro=" . $value->id; ?>">
                <div class="image-box">
                    <img src="<?php echo "admin/fileadmin/product/" . $value->picture ?>">
                </div>
            </a>
            <div class="text-box">
                <p> <?php echo mb_substr($value->title, "0", "55") ?></p>
            </div>
            <div class="price-box">
                <p style="display: inline-block;"> <?php echo number_format($value->price) ?> تومان</p>
                <sapn style="background-color: #12a1ee;width: 50px;padding: 2px 5px;"><?php echo number_format($value->pricem) ?></sapn>
            </div>
        </div>
        <!------------ end box ------------>
    <?php } ?>
</div>
<!------------ end body ------------>
<?php require_once "files/head/footer.php" ?>