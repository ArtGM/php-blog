# Simple PHP Blog [![Maintainability](https://api.codeclimate.com/v1/badges/237966c2d47dd50e997b/maintainability)](https://codeclimate.com/github/ArtGM/php-blog/maintainability)

a little MVC Blog:

- Article
- Comment
- User

##Installation

- Step 1: Clone this repo
- Step 2: open a terminal on the project root folder and type `` composer install ``
- Step 2: Create a MySql Database
- Step 3: Import the phpblog.sql file into the database
- Step 4: Set Database credentials in src/Config/config.php
- Step 5: create a mail-config.php file with your gmail credentials (file not commited):
```php
define('AUTH', 'your_gmail_address');
define('PASS', 'your_gmail_password');
```
- Step 6: add host or vhost on root project folder
- Step 7: connect with login: Admin & Pass: admin1234 and change your info on the user manage dashboard
- Step 8: Create your first Post !!
