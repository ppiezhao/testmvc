<?php

/**
* Article Model
*/
class Article extends Illuminate\Database\Eloquent\Model
{
	public $timetamps = false;
	/*
	public static function first()
	{
		$connection = mysql_connect("localhost","root","php100");
		if(!$connection){
			die('Could not connect:' .mysql_error());
		}

		mysql_set_charset("UTF8",  $connection);
		
		mysql_select_db("mffc", $connection);
		
		$result = mysql_query("SELECT * FROM articles limit 0,1");

		if ($row = mysql_fetch_array($result)) {
			//echo '<h1>'.$row["title"].'</h1>';
			//echo '<p>'.$row["content"].'</p>';
			return $row;	
		}

		mysql_close($connection);
	}*/	
}
