<?php

class MaterialModel extends Model
{
    public function __construct()
    {
        $this->connect();
        $this->table_name = "materials";
    }
}