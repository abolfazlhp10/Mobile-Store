<div class="rightbox shadow">
    <p>دسته بندی</p>
    <li><a href="addcat.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">افزودن دسته بندی</a></li>
    <li><a href="listcat.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">لیست دسته بندی</a></li>
    <p>مدیریت اسلایدر</p>
    <li><a href="addslide.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">افزودن اسلایدها</a></li>
    <li><a href="listslide.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">لیست اسلایدها</a></li>
    <p>مدیریت کاربران</p>
    <li><a href="showusers.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">لیست کاربران</a></li>
    <p>مدیریت پست</p>
    <li><a href="addproduct.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">افزودن پست</a></li>
    <li><a href="listproduct.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">لیست پست</a></li>
    <p>نظرات کاربران</p>
    <li><a href="listcom.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">لیست نظرات</a></li>
    <p>سفارش کاربران</p>
    <li><a href="costumers.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">لیست مشتري ها</a></li>
    <li><a href="listbasc.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">لیست سفارشات</a></li>
    <li><a href="showadmininfo.php" class="btn btn-dark text-light shadow d-block" style="color: #ffffff">مدیریت</a></li>
    <li><a href="exit.php" class="btn btn-danger shadow d-block">خروج از داشبورد</a></li>
    <li><a href="../index.php" class="btn btn-danger shadow d-block">نمایش سایت</a></li>
    <li><a href="#" class="btn btn-danger shadow d-block"><?php if (isset($_SESSION['adminusername'])) {
                                                                echo $_SESSION['adminusername'];
                                                            } ?></a></li>
</div>