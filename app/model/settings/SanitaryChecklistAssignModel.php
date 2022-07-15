<?php
namespace App\Model\Settings;
use App\Model\BaseModel;

class SanitaryChecklistAssignModel extends BaseModel {
    private static $table = 'sanitary_checklist_assigns';
    private static $order_by = [ "checklists.name", "asc"];
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