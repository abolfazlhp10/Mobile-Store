<?php require_once "files/head/header.php" ?>
<?php $action = new action("store of me", "root", "") ?>

<?php if (!isset($_GET["page"])) {
    $_GET["page"]=1;
} ?>
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
    <p> جدیدترین محصولات </p>
</div>
<div class="section">
    <?php
    $query = "SELECT * FROM product";
    $row = [];
    $selectallpro = $action->select($query, $row, "fetchall");
    ?>
    <?php
    //pagination
    $tedad = count($selectallpro);
    $page = ceil($tedad / 8);
    if (!isset($_GET["page"])) {
        $cn = 0;
    } else {
        $cn = ($_GET["page"] - 1) * 8;
    }
    $query = "SELECT * FROM product LIMIT {$cn},8";
    $select2 = $action->select($query, $row, "fetchall");

    ?>
    <?php foreach ($select2 as $value) { ?>
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
                <?php if ($value->price == $value->pricem) { ?>
                <?php } else { ?>
                    <sapn style="background-color: #12a1ee;width: 50px;padding: 2px 5px;">
                        <del>
                            <?php echo number_format($value->pricem) ?>
                        </del>
                    </sapn>
                <?php } ?>
            </div>
        </div>
        <!------------ end box ------------>
    <?php } ?>
    <br>

    <div class="pagination">
        <?php if ($_GET["page"] == $page) {
        } else { ?>
            <a href="<?php echo "index.php?page=" . $_GET["page"] + 1 ?>">بعدی</a>
        <?php } ?>
        <?php for ($i = 0; $i < $page; $i++) { ?>

            <a href="<?php echo "index.php?page=" . $i + 1 ?>" class="<?php if (isset($_GET["page"]) and $_GET["page"] == $i + 1) {
                                                                            echo "active";
                                                                        } ?>"><?php echo $i + 1 ?></a>
        <?php } ?>
        <?php if ($_GET["page"] == 1) {
        } else { ?>
            <a href="<?php echo "index.php?page=" . $_GET["page"] - 1 ?>">قبلی</a>
        <?php } ?>

    </div>
</div>
<!------------ end body ------------>
<?php require_once "files/head/footer.php" ?>