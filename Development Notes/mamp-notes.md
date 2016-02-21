# MAMP Notes

### EXPORT DATABASE FROM MAMP
#### Step One:
  - Open a new terminal window
##### Step Two:
  - Navigate to the MAMP install by entering the following line in terminal
  - cd /applications/MAMP/library/bin
  - Hit the enter key
#### Step Three:
  - Write the dump command
  - ./mysqldump -u [USERNAME] -p [DATA_BASENAME] > [PATH_TO_FILE]
  - Hit the enter key
  - Example:
  - ./mysqldump -u root -p wp_database > /Applications/MAMP/htdocs/symposium10_wp/wp_db_onezero.sql
  - Quick tip: to navigate to a folder quickly you can drag the folder into the terminal window and it will write the location of the folder. It was a great day when someone showed me this.
#### Step Four:
  - This line of text should appear after you hit enter
  - Enter password:
  - So guess what, type your password, keep in mind that the letters will not appear, but they are there
  - Hit the enter key
#### Step Five:
  - Check the location of where you stored your file, if it is there, SUCCESS
  - Now you can import the database, which will be outlined next.

## IMPORT DATABASE INTO MAMP
#### Step One:
  - Open a new terminal window
  - CAREFUL: This will replace all tables in the database you specify!
#### Step Two:
  - /applications/MAMP/library/bin/mysql -u [USERNAME] -p [DATABASE_NAME] < [PATH_TO_SQL_FILE]
  - Hit the Enter Key
  - Example:
  - /applications/MAMP/library/bin/mysql -u root -p wordpress_db < /Applications/MAMP/htdocs/backupDB.sql
  - Quick Tip: Don’t forget that you can simply drag the file into the terminal window and it will enter the location of the file for you.
#### Step Three:
  - You should be prompted with the following line:
  - Enter password:
  - Type your password, keep in mind that the letters will not appear, but they are there
  - Hit the enter key
#### Step Four:
  - Check if you database was successfully imported
  - Navigate to phpMyAdmin in a browser
  - http://localhost:8888/MAMP/

## Install ioncube
  - Get php 5.4.26 from here: [http://www.mamp.info/en/downloads/](http://www.mamp.info/en/downloads/)
  - Download ionCube from  [http://www.ioncube.com/loaders.php](http://www.ioncube.com/loaders.php)
  - Copy the whole ioncube folder to: `/Applications/MAMP/bin/php/php5.4.26/`
  - Open `/Applications/MAMP/conf/php5.4.26/php.ini`
  - Add this line somewhere around line 531 `zend_extension = "/Applications/MAMP/bin/php/php5.4.26/ioncube/ioncube_loader_dar_5.4.so"`
  

