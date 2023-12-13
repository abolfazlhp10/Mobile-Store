<?php require_once "files/head/header.php" ?>
<!------------ start slider ------------>
<?php $action = new action("store of me", "root", ""); ?>

<?php
$query = "SELECT * FROM slider";
$row = [];
$selectslide = $action->select($query, $row, "fetchall");
?>
<div class="slideshow-container">
    <?php foreach ($selectslide as $value) { ?>
        <div class="mySlides fade">
            <img src="<?php echo "admin/fileadmin/slider/" . $value->picture ?>" style="width:100%; ">
        </div>
    <?php } ?>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<!------------ end slider ------------>

<!------------ start body ------------>
<?php
global $searchpro;
global $search;
?>
<div class="onvan">
    <?php if (empty($searchpro)) { ?>
        <p>نتیجه ای یافت نشد !</p>
    <?php } else { ?>
        <p>نتایج جستجو : </p>
    <?php } ?>
</div>


<div class="section">

    <!------------ start box ------------>
    <?php if (!empty($searchpro)) { ?>
        <?php foreach ($searchpro as $value) { ?>
            <div class="div div1">
                <a href="<?php echo "page.php?pro=" . $value->id ?>">
                    <div class="image-box">
                        <img src="<?php echo "admin/fileadmin/product/" . $value->picture ?>">
                    </div>
                </a>
                <div class="text-box">
                    <p> <?php echo mb_substr($value->title, "0", "54") ?></p>
                </div>
                <div class="price-box">
                    <p style="display: inline-block;"> تومان <?php echo number_format($value->price) ?></p>
                    <sapn style="background-color: #12a1ee;width: 50px;padding: 2px 5px;"><?php echo number_format($value->pricem) ?></sapn>
                </div>
            </div>
            <!------------ end box ------------>
        <?php } ?>
    <?php } else {
    } ?>

</div>
<!------------ end body ------------>

<?php require_once "files/head/footer.php" ?>