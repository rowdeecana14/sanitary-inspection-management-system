<?php
namespace App\Model\Settings;
use App\Model\BaseModel;

class UserModel extends BaseModel {
    private static $table = 'users';
    private static $order_by = [ "health_officials.first_name", "asc"];
    private static $fillable = [];

    public function login($username) {
		$this->sql = "
            SELECT 
                users.id, health_officials.image, users.username, users.password, health_officials.first_name, health_officials.middle_name, 
                health_officials.last_name, occupations.name as position, users.status, users.deleted_at
            FROM ".$this->getTable()." 
            LEFT JOIN health_officials ON users.health_official_id=health_officials.id
            LEFT JOIN occupations ON health_officials.position_id=occupations.id
            WHERE users.username =:username order by users.id limit 1
        "; 
		$this->statement  = $this->connection()->prepare($this->sql);
		$this->statement->bindValue(":username", $username);
		$this->statement ->execute();

		return $this->statement->fetch();
    }

    public function logout() {
        
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