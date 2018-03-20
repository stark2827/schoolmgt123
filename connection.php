<?php
$conn=mysql_connect("localhost","id868851_root","Blood1@");
if($conn)
{
	
    mysql_select_db("id868851_blood_bank",$conn);
}
else
{
	
    exit('Error : can not connect to database');
}
?>