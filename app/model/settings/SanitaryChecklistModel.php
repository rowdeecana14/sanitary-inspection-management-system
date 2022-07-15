<?php
namespace App\Model\Settings;
use App\Model\BaseModel;

class SanitaryChecklistModel extends BaseModel {
    private static $table = 'sanitary_checklists';
    private static $order_by = [ "id", "asc"];
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