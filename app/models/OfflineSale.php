<?php

namespace models;

class OfflineSale extends Main
{
    public static $table = 'offline_sales';
    static $columnDB = ['id', 'local_uuid', 'payload', 'synced', 'created_at'];

    public $id;
    public $local_uuid;
    public $payload;
    public $synced;
    public $created_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}
