<?php
namespace App\Model;
use App\Model\BaseModel;

class ComplaintModel extends BaseModel {
    private static $table = 'complaints';
    private static $order_by = [ "complaints.created_at", "asc"];
    private static $fillable = [];

    public function countUnsettleds() {
        $this->sql = "
            SELECT count(complaints.id)
            FROM complaints
            LEFT JOIN complaint_statuses ON complaints.complaint_status_id=complaint_statuses.id
            WHERE 
                complaints.deleted_at IS NULL 
                AND UPPER(TRIM(complaint_statuses.name)) = 'UNSETTLED'
            ";
        $this->statement  = $this->connection()->prepare($this->sql);
        $this->statement ->execute();

        return $this->statement ->fetchColumn();
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
            SELECT COUNT(complaints.id) as total
            FROM complaints
            WHERE YEAR(complaints.date_reported) = YEAR(CURDATE())
                AND MONTH(complaints.date_reported) = ".$month."
            ";
        $this->statement  = $this->connection()->prepare($this->sql);
        $this->statement ->execute();

        return $this->statement ->fetchColumn();
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