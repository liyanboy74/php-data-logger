# PHP Data logger

Logging http requests into MySQL database

That API can save any POST,GET,JSON & ...

you must have table named `log` Columns (`ID` ,`name` ,`data` ,`dateTime`)

Edit below lines in `api.php` for connect to MySQL database:

```PHP
$servername     = 	"localhost"	;
$username 	= 	"USERNAME"	;
$password 	= 	"PASSWORD"	;
$dbname 	= 	"DB_NAME"	;
```
