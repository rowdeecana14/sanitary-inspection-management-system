<?php
namespace App\Model\Settings;
use App\Model\BaseModel;

class SignatureModel extends BaseModel {
    private static $table = 'signatures';
    private static $order_by = [ "name", "asc"];
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