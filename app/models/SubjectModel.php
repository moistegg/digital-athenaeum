<?php

class SubjectModel extends Model
{
    public function __construct()
    {
        $this->connect();
        $this->table_name = "subjects";
    }
}