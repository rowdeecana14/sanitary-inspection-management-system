<?php
namespace App\Model\Settings;
use App\Model\BaseModel;

class PurokModel extends BaseModel {
    private static $table = 'puroks';
    private static $order_by = [ "puroks.name", "asc"];
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