
# Dependencies

required:
- [php](https://www.php.net/downloads.php)
    - make sure you have [PDO extension](https://www.php.net/manual/en/book.pdo.php) enabled
- [php composer](https://getcomposer.org/)
- a mysql-compatible database:
    - [mysql](https://www.mysql.com/downloads/)
    - [mariadb](https://mariadb.com/downloads/)

For data-aquisition you can check out the requirements [here](ProductExtractor/README.md)

# Setup 

create a .env file in your project directory containing everything inside .env.example


Regenerate classes to be included in project:
```bash
composer dump-autoload
```

# Running the server

Run the server with the command
```bash
php -S localhost:8000 -t public
```
