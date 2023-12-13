<?php require_once "files/connect/database.php" ?>
<?php include_once "admin/fileadmin/jdf/jdf.php" ?>
<?php $action = new action("store of me", "root", ""); ?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <link rel="stylesheet" href="files/css/style.css">
    <title> عنوان صفحه </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<?php if (isset($_SESSION["username"])) {
    $query = "SELECT * FROM bascket WHERE userid=? AND status=?";
    $row = [$_SESSION["username"], "0"];
    $count = $action->select($query, $row, "fetchall");
    $count = count($count);
} ?>

<body>
    <!------------ start header ------------>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="index.php" style="font-size: 20px;">موبایل شاپ</a>
                </li>
                <li> <a href="index.php">خانه</a> </li>
                <?php
                $action = new action("store of me", "root", "");
                $query = "SELECT * FROM cat WHERE chid=?";
                $row = ["0"];
                $select = $action->select($query, $row, "fetchall");
                ?>
                <?php foreach ($select as $value) { ?>
                    <li><a href="#"><?php echo $value->catname ?></a>
                        <!------ start dropDown ------>
                        <?php
                        $query = "SELECT * FROM cat WHERE chid=?";
                        $row = [$value->id];
                        $zirmenu = $action->select($query, $row, "fetchall");
                        ?>
                        <ul class="dropdown">
                            <?php foreach ($zirmenu as $item) { ?>
                                <li><a href="<?php echo "category.php?catid=" . $item->id ?>"><?php echo $item->catname ?></a>
                                <?php } ?>
                        </ul>
                        <!------ end dropDown ------>
                    </li>
                <?php } ?>
            
                <?php if (isset($_SESSION["username"])) { ?>
                    <li style="background-color: #12a1ee;text-align:center;margin-right:5px;padding-left:15px;color: #ffffff;font-size: 12px"><?php echo $_SESSION["username"] ?>
                        <ul class="dropdown">
                            <li> <a href="#">ویرایش اطلاعات</a> </li>
                            <li> <a href="exit.php">خروج</a> </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li> <a href="login.php">ورود</a> </li>
                    <li> <a href="register.php">عضویت</a> </li>
                <?php } ?>
                <?php if(isset($_SESSION["username"])):?>
                <li> <a href="bascket.php" style="background-color: #12a1ee;padding: 5px 15px;border-radius: 3px;color: #ffffff;font-size: 12px"> سبد خرید <span><?php echo $count?></span> </a> </li>
                                                                                                                                                                    <?php endif;?>
                <li>
                    <div class="wrap">
                        <div class="search">
                            <?php
                            if (isset($_POST["search-btn"])) {
                                $search = $_POST["search"];
                                if (!empty($search)) {
                                    $query10 = "SELECT * FROM product WHERE tags LIKE ?";
                                    $row10 = ["%$search%"];
                                    $searchpro = $action->select($query10, $row10, "fetchall");
                                }
                            }
                            ?>
                            <form method="post" action="search.php">
                                <input type="text" name="search" class="searchTerm" placeholder="دنبال چی میگردی؟">
                                <button type="submit" name="search-btn" class="searchButton">جستوجو</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <!------------ end header ------------>