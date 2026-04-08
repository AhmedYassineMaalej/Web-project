
# Dependencies

required:
- [geckodriver](https://github.com/mozilla/geckodriver/releases)
- [php](https://www.php.net/downloads.php)
    - make sure you have [PDO extension](https://www.php.net/manual/en/book.pdo.php) enabled
- [php composer](https://getcomposer.org/)
- a mysql-compatible database:
    - [mysql](https://www.mysql.com/downloads/)
    - [mariadb](https://mariadb.com/downloads/)

For data-aquisition you can check out the requirements [here](ProductExtractor/README.md)

# Setup 

create a .env file in your project directory containing everything inside .env.example
> make sure you have geckodriver installed
> once downloaded, extract it and copy its path into .env (follow exactly as said in **.env.example**)



Regenerate classes to be included in project:
```bash
composer dump-autoload
```

## Create the database
# **1- Either use commandline tool mysql with the following command (after adding mysql to env vars)**

```bash
mysql -u root -p<password>   # Connect to mysql : no space between -p and <password>
```


# **2- Or use the mysql UI**


> then inside the window or the prompt (depending on what you're using):
```sql
SOURCE database/create.sql; -- which is equivalent to opening database/create.sql and pasting all of it
```
# Populating the database
Simply run 
```bash
uv run python main.py --browser firefox
```

# Running the server
After the database is populated with products
Run the server with the command
```bash
php -S localhost:8000 -t public
```
---
⚠️ **WARNING** ⚠️
The order specified is crucial to follow:
1. database + tables creation with database/create.sql
2. running the python program to populate the database
3. running the web app to read from the database (notice that the app only reads from the database and the only time it gets to edit it is during sign up for users)