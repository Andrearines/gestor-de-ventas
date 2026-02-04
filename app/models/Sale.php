<?php

namespace models;

class Sale extends Main
{
    public static $table = 'sales';
    static $columnDB = ['id', 'user_id', 'event_id', 'ticket_id', 'combo_id', 'amount', 'source', 'sale_date'];

    public $id;
    public $user_id;
    public $event_id;
    public $ticket_id;
    public $combo_id;
    public $amount;
    public $source;
    public $sale_date;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }

    public static function getStats()
    {
        $query = "SELECT COUNT(*) as total_sales, SUM(amount) as total_income FROM " . static::$table;
        $result = self::$db->query($query);
        $data = $result->fetch_assoc();

        return [
            'boletos_vendidos' => (int) ($data['total_sales'] ?? 0),
            'ingresos' => (float) ($data['total_income'] ?? 0)
        ];
    }
}
