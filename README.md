# Arma BEC chat logger


Inserts your Arma 2 or 3 server BEC chat logs into a MySQL database as well as providing the ability to display the chat from the database on a web page.

### Requires

* PHP version 8 or above
* MySQL server

### Instructions & about

```get_bec_log.bat``` Gets the latest BEC chat log file every 120 seconds and moves it to ```C:\xampp\htdocs\chat\``` and renames it to ```chat.log``` 

Put ```get_bec_log.bat``` in your Arma server's BEC logs chat folder and double click ```get_bec_log.bat``` to start it.


```log.php``` goes through each line of the ```chat.log``` file and checks if it exists in the database if it does then skip, else insert into database. 

Asign ```log.php``` to a cron job of 5 minutes for busy servers else 10 or 15 minutes should be fine.


```display.php``` Fetches the side chat data from the database and sorts by id, in theory it will display the most recent message first. 

By default it is limited to 250 messages. It also has some basic styling and date formatting.


```table.sql``` is the MySQL file, run this to create the database and table. By default the database is called `bec_chat` and the table is `server1` 


#### Make sure to enter your MYSQL details (Host, Username & password in both the `log.php` and `display.php`)