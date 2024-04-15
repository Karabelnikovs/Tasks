<?php


class Select{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public $query_string = "SELECT * FROM tasks";
    public $params=[];

    public$tasks = $db->execute($this->query_string, $this->params)->fetchAll();
}