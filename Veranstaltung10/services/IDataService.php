<?php

interface IDataService
{
    public function getAll($sort);

    public function getById($id);
} 