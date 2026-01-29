<?php

namespace models;

class SystemLog extends Main
{
    public static $table = 'system_logs';
    static $columnDB = ['id', 'type', 'message', 'model', 'model_id', 'created_at'];

    public $id;
    public $type;
    public $message;
    public $model;
    public $model_id;
    public $created_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}
