<?php

class SubjectModel extends Model
{
    public function __construct()
    {
        $this->connect();
        $this->table_name = "subjects";
    }

    public function Materials()
    {
        return $this->hasMany('materials', 'subject_id', 'id');
    }
}