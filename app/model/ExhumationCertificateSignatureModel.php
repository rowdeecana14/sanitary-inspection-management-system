<?php
namespace App\Model;
use App\Model\BaseModel;

class ExhumationCerticateSignatureModel extends BaseModel {
    private static $table = 'exhumation_certificate_signatures';
    private static $order_by = [ "exhumation_certificate_signatures.id", "desc"];
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