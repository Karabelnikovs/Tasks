<?php


class Select{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

$query_string = "SELECT * FROM tasks";
$params=[];

$tasks = $db->execute($query_string, $params)->fetchAll();

return $tasks;

}