<?php
class Manager
{
	protected function dbConnect()
	{
		$db = new PDO('mysql:host=db754366175.db.1and1.com;dbname=db754366175;charset=utf8', 'dbo754366175', 'forteroche', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
	}
}