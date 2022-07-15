<?php
namespace App\Model;
use App\Model\BaseModel;

class HealthOfficialModel extends BaseModel {
    private static $table = 'health_officials';
    private static $order_by = [ "health_officials.first_name", "asc"];
    private static $fillable = [];

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