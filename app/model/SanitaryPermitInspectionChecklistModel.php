<?php
namespace App\Model;
use App\Model\BaseModel;

class SanitaryPermitInspectionChecklistModel extends BaseModel {
    private static $table = 'sanitary_permit_inspection_checklists';
    private static $order_by = [ "sanitary_permit_inspection_checklists.id", "desc"];
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