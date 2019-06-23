# Quantify - A Simple Blog

Created in 2012 by Andrew Landsverk as a learning exercise.

## Setup

### Docker

1. Edit `application/controllers/tools.php` and update the admin credentials to be your own
2. docker-compose up -d --build
3. After the applicaiton has started, Navigate to http://localhost/quantify/tools/setupDatabase
4. If you don't see "Good to go" check the logs in the container `/var/log/apache2/error.log`
5. After the page refreshes you can now navigate to http://localhost/quantify
6. Done!

### LAMP

Full instructions are not provided for LAMP stacks at this time. You will need to edit a few files to point to a different MySQL instance however:

- `application/config/database.php`

You will also need to make sure mod_rewrite is enable for Apache and that you deploy the application to the `/quantas/` directory under your base `/var/www/html/` or similar, otherwise you will most likely need to alter the `.htaccess` file that has also been provided. The apache user will also need write access to the following locations:

- `assets/uploads`
- `application/models/Proxies`
