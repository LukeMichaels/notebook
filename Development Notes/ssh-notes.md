# SSH Notes

## Present Working Directory
pwd

## List Files
ls

## cronjobs
crontab -e

## Read File
nano filename.extension

  - CTRL+o: this will save the file
  - CTRL+x: this will exit the file
  - CTRL+w: this will allow you to enter a phrase to search the file
  - CTRL+k: this will allow you to cut 1 or more lines of text
  - CTRL+u: this will allow you to uncut lines of text that were cut using CTRL k (similar to pasting text)
  - CTRL+v: this will advance the file to the next page
  - CTRL+y: this will move the file to the previous page
  - CTRL+t: this will run spellcheck on the file

## find in file
grep "help" *.htm
~ would locate any htm file containing the word help

## download file
scp your_username@remotehost.edu:foobar.txt /some/local/directory

## change directory
cd

## change permissions
chmod 666 filename.php

## change ownership
chown -R user:group path 
(user/group are what it needs to be changed to)

Example: 
chown -R xcart46:xcart46 /home/xcart46/public_html/

## remove files
rm myFile.txt myFile1.txt myFile2.txt

remove folder (and contained files)
rm -rf foldername/

remove all files/folders in current directory
rm -rf *

## move
mv /path

## copy
  /path

## MySQL Dump
mysqldump -p -u username database_name > dbname.sql

## MySQL Import
Create SQL database on server
navigate to the directory where your .sql file is.
run this command:  mysql -p -u username database_name < file.sql 


## Compress Folder
tar -pczf filename.tar.gz directorytocompress
tar -pczf bobsbackup.tar.gz /home/bobsredm/public_html

## Uncompress Folder
tar -zxvf filename.tar.gz /directoryonnewserver


## Use PHP To Tar/Untar
Compress Folder
if(system("tar -czvf your-fine.tar.gz your-directory/")) 
  echo '<br> <b>Directory compressed successfully!</b>';
else echo '<br> <b>No Donuts for you :(, 
  command has been disabled by host!</b>';

Uncompress Folder
if(system("tar -zxvf your-file.tar.gz")) 
  echo '<br> <b>file uncompressed successfully!</b>';
else echo '<br> <b>No Donuts for you :(, 
  command has been disabled by host!</b>';


## Show Filesystem size/used/available
show all folder sizes for current directory recursively
df -h

show disk use summary for current directory
du -sh

free space, used space, total space of all partitions on system
df -h