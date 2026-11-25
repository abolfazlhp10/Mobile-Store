# Mobile Store

An online store for phones and accessories, written in plain PHP without a framework. It has a storefront for customers and a small CMS for the admin.

## Features

**Store**
- Home page slider and product categories
- Product pages with comments (shown after admin approval)
- Product search
- Shopping cart with item count and total price
- Delivery address and phone number at checkout
- Payment through the Zarinpal gateway (sandbox)

**Accounts**
- Register and log in with a username or email
- Welcome email after sign-up, sent with PHPMailer over Gmail SMTP
- Google reCAPTCHA on the login and register forms

**Admin panel (CMS)**
- Add, edit and delete products, categories and slider images
- View and edit users and customers
- Approve, edit and reply to comments
- View shopping baskets and orders

## Tech stack

- PHP, HTML, CSS, JavaScript, Bootstrap
- MySQL with PDO prepared statements
- PHPMailer, Google reCAPTCHA, Zarinpal

## Project structure

```
index.php, page.php, category.php, search.php   storefront
bascket.php, address.php, request.php, verify.php  cart and payment
login.php, register.php, exit.php            accounts
admin/                                        admin panel
files/connect/database.php                    PDO database class
files/email/PHPMailer/                        email library
store_of_me.sql                               database dump
```

## Running locally

Requirements: PHP with the `pdo_mysql` and `soap` extensions, and MySQL (XAMPP or WAMP works).

1. Put the project in your web server folder, for example `htdocs/store of me`.
2. Create a database named `store of me` and import `store_of_me.sql`.
3. The database login is set in `files/head/header.php` and `index.php` (`root` with no password by default). Change it if yours is different.
4. For sign-up emails, set your Gmail address and app password in `register.php`. For reCAPTCHA, put your own site key and secret key in `login.php`, `register.php` and `files/head/header.php`. For payment, set your Zarinpal merchant ID in `request.php`.
5. Open `http://localhost/store of me/`.
