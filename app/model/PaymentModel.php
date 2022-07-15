<?php
namespace App\Model;
use App\Model\BaseModel;

class PaymentModel extends BaseModel {
    private static $table = 'payments';
    private static $order_by = [];
    private static $fillable = [];

    // DEV CUSTOM DEFINED FUNCTION
    public function reports($date) {
        $this->sql = "
            SELECT *
            FROM  payments
            WHERE paid_at BETWEEN '".$date['from']."' AND '".$date['end']."'
        ";
        $this->statement  = $this->connection()->prepare($this->sql);
        $this->statement ->execute();

        return $this->statement ->fetchAll();
    }
   
    public function getFillable() {
       return self::$fillable;
   }

    public function getTable() {
        return self::$table;
    }

    public function getOrderBy() {
        return self::$order_by;
    }
}

?>