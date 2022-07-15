<?php
namespace App\Model;
use App\Model\BaseModel;

class BusinessPermitSignatureModel extends BaseModel {
    private static $table = 'business_permit_signatures';
    private static $order_by = [ "business_permit_signatures.id", "desc"];
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