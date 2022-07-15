<?php
namespace App\Model;
use App\Model\BaseModel;

class CompanyModel extends BaseModel {
    private static $table = 'companies';
    private static $order_by = [ "companies.name", "asc"];
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