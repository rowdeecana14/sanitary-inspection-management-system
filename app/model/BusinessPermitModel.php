<?php
namespace App\Model;
use App\Model\BaseModel;

class BusinessPermitModel extends BaseModel {
    private static $table = 'business_permits';
    private static $order_by = [ "business_permits.issued_at", "asc"];
    private static $fillable = [];

    // DEV CUSTOM DEFINED FUNCTION
    public function reports($date) {
        $this->sql = "
            SELECT payments.id, payments.or_no, payments.amount, payments.paid_at
            FROM business_permits
            LEFT JOIN payments ON business_permits.payment_id=payments.id
            WHERE payments.paid_at BETWEEN '".$date['from']."' AND '".$date['end']."'
        ";
        $this->statement  = $this->connection()->prepare($this->sql);
        $this->statement ->execute();

        return $this->statement ->fetchAll();
    }

    public function monthlyGraph() {
        $month_list = ['01', '02', '03', '04', '05', '06', '07','08', '09', '10', '11', '12'];
        $monthly = [];

        foreach($month_list as $month) {
            array_push($monthly, $this->getMonth($month));
            
            if($month == date('m')) {
                break;
            }
        }

        return $monthly;
    }

    public function getMonth($month) {
        $this->sql = "
            SELECT COUNT(business_permits.id) as total
            FROM business_permits
            WHERE YEAR(business_permits.issued_at) = YEAR(CURDATE())
                AND MONTH(business_permits.issued_at) = ".$month."
            ";
        $this->statement  = $this->connection()->prepare($this->sql);
        $this->statement ->execute();

        return $this->statement ->fetchColumn();
    }

    public function getLastRow() {
        $this->sql = "
            SELECT *
            FROM business_permits
            WHERE deleted_at IS NULL
            ORDER BY ID DESC LIMIT 1
        ";
        $this->statement  = $this->connection()->prepare($this->sql);
        $this->statement ->execute();

        return $this->statement->fetch();
    }
   
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