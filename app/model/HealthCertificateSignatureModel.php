<?php
namespace App\Model;
use App\Model\BaseModel;

class HealthCertificateSignatureModel extends BaseModel {
    private static $table = 'health_certificate_signatures';
    private static $order_by = [ "health_certificate_signatures.id", "desc"];
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