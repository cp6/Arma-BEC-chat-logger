# Arma BEC chat logger


<p> Inserts your Arma server BEC chat logs into a MYSQL database as well as having the ability to display the chat from the database.</p>

<p> 

__get_bec_log.bat__ Gets the latest BEC chat log file every 120 seconds and moves it to `C:\xampp\htdocs\chat\` and renames it to `chat.log` Put __get_bec_log.bat__ in your arma servers BEC logs chat folder and double click __get_bec_log.bat__ to start it.

</p>

<p>

__log.php__ goes through each line of the chat.log file and checks if it exists in the database, if it does then skip else insert into database. Asign __log.php__ to a cron job of 5 minutes for busy servers else 10 or 15 minutes should be fine.

</p>

<p>

__display.php__ Fetches the side chat data from the database and sorts by id, in theory it will display the most recent message first. By default it is limited to 250 messages. It also has some basic styling and date formatting.

</p>

<p>

__table.sql__ is the MYSQL file, run this to get the database and table. By default the database is called `bec_chat` and the table is `server1` 

</p>

#### Make sure to enter your MYSQL details (Username & password in both the `log.php` and `display.php`

