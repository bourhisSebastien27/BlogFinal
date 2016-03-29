<?php // connection à la base de donnée
Error_reporting(E_ALL^E_DEPRECATED);
//mysql_connect('localhost','root','');
mysql_connect('mysql13.000webhost.com','a2988544_seb','nbvcxw01');
//mysql_select_db('blog');
mysql_select_db('a2988544_blog');
mysql_query("set names 'utf8'");
?>