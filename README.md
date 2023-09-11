<p align="center" ><a href="https://laravel.com" target="_blank" align="center"><strong>myBlog</strong></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About myBlog
MyBlog is a news site with numerous news categories. MyBlog has been wonderfully built with some of the best tools for building robust online apps, is extensively documented for simple comprehension, and is speed-optimized.
This project aims to provide new web developers with an example of how to establish a news blog and a helpful code structure.

The following are some of myBlog's features: 

- Displays news from a variety of news categories on the homepage.
- Users can search the blog for a particular post.
- Users receive a message asking them to validate their email address in order to continue saving, liking, and commenting on posts.
- Each time a user logs in, a mail alert is sent. The user's IP address, logged location, login date and time, device type, device name, device operating system, and device browser type are all included in the email they get.
- There are error handlers to deal with the 419 error (caused by a mismatched token, which causes the session to expire), as well as the 404 error (caused by the user entering an erroneous URL).
- Users have the option of saving their favorite posts and then deleting them.
- avoiding using the alphabet and symbols in the number field
- Every field is subject to validation.
- For a better user experience, wysiwyg editors are used.
- A user can like or dislike a post (this action uses AJAX to happen instantly, thus the page is not reloaded).
- Users have the option of commenting and replying (this action uses AJAX to happen instantly, thus the page is not reloaded).
- When a user's password is changed, an email is sent to them (this action uses AJAX to happen instantly, thus the page is not reloaded).
- The profile image of users can be changed (this action uses AJAX to happen instantly, thus the page is not reloaded).
- There is a user activity table that shows all the user's activity and allows searches by date or word.
- Users can subscribe to a news category to receive updates on that category's news via mail (users are allowed to unsubscribe whenever they wish to).
- a login that directs users to the proper dashboard, either the admin, editor, or home page
- It features an editor's dashboard where posts may be created or modified (this action uses AJAX to happen instantly, thus the page is not reloaded).
- Each post may include a watermark.
- Editors can change or reset passwords.
- Admin Dashboard
- An administrator can delete users, view a specific user's activities, and suspend users.
- A post may be deleted, suspended, or asked to be reedited by the administrator.
- Admin has the ability to add, remove, or suspend an Editor.
- Administrators can track editor activity.
- The blog administrator has access to every comment and can search comments by term, date, or post.
- Admin may create, remove, or suspend sub-admins.


## Requirements
- PHP >= 7.4
- Laravel >= 7.0
- database (MySQL etc)

## Installation

After downloading laravel-blog
<br>
Create a new Database
Create a database connection from laravel-blog to the new database in the environment variable file (.env).
Open a new terminal and type "php artisan migrate"
type "composer install 
mv .env.example .env 
php artisan cache:clear 
composer dump-autoload 
php artisan key:generate"
For the email (user verification, user login, password change, newsletter subscription, etc) system to work, you need internet connection.

## Security Vulnerabilities

If you discover a security vulnerability within myBlog, please send an e-mail to Ubong Ibok via (mailto:ubong.ibok@gmail.com). All security vulnerabilities will be promptly addressed.

## License
