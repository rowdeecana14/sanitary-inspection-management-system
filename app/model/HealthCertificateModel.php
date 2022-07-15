<?php
namespace App\Model;
use App\Model\BaseModel;

class HealthCertificateModel extends BaseModel {
    private static $table = 'health_certificates';
    private static $order_by = [ "health_certificates.issued_at", "desc"];
    private static $fillable = [];

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
            SELECT COUNT(health_certificates.id) as total
            FROM health_certificates
            WHERE YEAR(health_certificates.issued_at) = YEAR(CURDATE())
                AND MONTH(health_certificates.issued_at) = ".$month."
            ";
        $this->statement  = $this->connection()->prepare($this->sql);
        $this->statement ->execute();

        return $this->statement ->fetchColumn();
    }

    public function getLastRow() {
        $this->sql = "
            SELECT *
            FROM health_certificates
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