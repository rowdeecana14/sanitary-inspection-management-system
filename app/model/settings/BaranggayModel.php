<?php
namespace App\Model\Settings;
use App\Model\BaseModel;

class BaranggayModel extends BaseModel {
    private static $table = 'baranggays';
    private static $order_by = [ "name", "asc"];
    private static $fillable = [
        'name', 'created_by', 'updated_by', 'deleted_by', 'updated_at', 'deleted_at'
   ];

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