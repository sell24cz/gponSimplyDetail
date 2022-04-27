# gponSimplyDetail
Simple gpons detail info

Installation:

You need:

Apache 2.4 or later
PHP 7.0 or later 
PHP 7.x Extensions + Mysql PDO
Mysql 5.6 or later 
net-snmp + php-snmp

Copy the files to your web folder.
Create database "gpon" and load in it the supplied install/gpon.sql file. 
Grant permissions to user for databse "gpon". Modify inc/lib.php to match the mysql user,pass.


In the menu (setting): we set the OLT IP and community.

examples:

IP: 1.1.1.1 community: fsdfer23

The “SNMP community string” is like a user ID or password that allows access to a router's or other device's statistics.



![gpon](https://user-images.githubusercontent.com/83060284/165462717-24d10579-5a32-461b-b24b-844223c823d9.png)
