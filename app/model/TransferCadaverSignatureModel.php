<?php
namespace App\Model;
use App\Model\BaseModel;

class TransferCadaverSignatureModel extends BaseModel {
    private static $table = 'transfer_cadaver_signatures';
    private static $order_by = [ "transfer_cadaver_signatures.id", "desc"];
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