<?php
       //ENTER YOUR DATABASE CONNECTION INFO BELOW:
         $hostname="localhost";
         $database="anta1968_antarsayur";
         $username="anta1968_admin";
         $password="antarsayur123";

   //DO NOT EDIT BELOW THIS LINE
     $link = mysqli_connect($hostname, $username, $password);
     mysqli_select_db($link, $database) or die('Could not select database');
 ?> 