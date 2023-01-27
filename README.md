# gponSimplyDetail
Simple gpons detail info

Tested: 
OLT Dasan 


Installation:

You need:

- Apache 2.4 or later
- PHP 7.0 or later
- PHP 7.x Extensions + Mysql 
- Mysql 5.6 or later
- net-snmp + php-snmp

Copy the files to your web folder.
Create database "gpon" and load in it the supplied install/gpon.sql file. 
Grant permissions to user for databse "gpon". Modify inc/lib.php to match the mysql user,pass.


In the menu (setting): we set the OLT IP and community.

examples:

IP: 1.1.1.1 community: fsdfer23

The “SNMP community string” is like a user ID or password that allows access to a router's or other device's statistics.


![gpon](https://user-images.githubusercontent.com/83060284/215084623-35cd376b-e7da-40f2-b8bb-826c37da129a.png)

