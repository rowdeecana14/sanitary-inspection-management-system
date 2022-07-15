<?php
namespace App\Model;
use App\Model\BaseModel;

class TransferCadaverModel extends BaseModel {
    private static $table = 'transfer_cadavers';
    private static $order_by = [ "transfer_cadavers.issued_at", "desc"];
    private static $fillable = [];

    // DEV CUSTOM DEFINED FUNCTION
    public function reports($date) {
        $this->sql = "
            SELECT payments.id, payments.or_no, payments.amount, payments.paid_at
            FROM transfer_cadavers
            LEFT JOIN payments ON transfer_cadavers.payment_id=payments.id
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
            SELECT COUNT(transfer_cadavers.id) as total
            FROM transfer_cadavers
            WHERE YEAR(transfer_cadavers.issued_at) = YEAR(CURDATE())
                AND MONTH(transfer_cadavers.issued_at) = ".$month."
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