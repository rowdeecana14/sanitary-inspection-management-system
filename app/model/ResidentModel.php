<?php
namespace App\Model;

use App\Helper\Helper;
use App\Model\BaseModel;
use App\Model\Settings\GenderModel;
use App\Model\Settings\PersonDisabilityModel;

class ResidentModel extends BaseModel {
    private static $table = 'residents';
    private static $order_by = [ "residents.first_name", "asc"];
    private static $fillable = [];
    
    public function countMales() {
      $this->sql = "
        SELECT count(residents.id)
        FROM residents
        LEFT JOIN genders ON residents.gender_id=genders.id
        WHERE 
            residents.deleted_at IS NULL 
            AND UPPER(TRIM(genders.name)) = 'MALE'
          ";
      $this->statement  = $this->connection()->prepare($this->sql);
      $this->statement ->execute();

      return $this->statement ->fetchColumn();
    }

    public function countFemales() {
      $this->sql = "
          SELECT count(residents.id)
          FROM residents
          LEFT JOIN genders ON residents.gender_id=genders.id
          WHERE 
              residents.deleted_at IS NULL 
              AND UPPER(TRIM(genders.name)) = 'FEMALE'
          ";
      $this->statement  = $this->connection()->prepare($this->sql);
      $this->statement ->execute();

      return $this->statement ->fetchColumn();
    }

    public function countSeniors() {
      $this->sql = "
          SELECT count(residents.id)
          FROM residents
          WHERE 
              residents.deleted_at IS NULL 
              AND TIMESTAMPDIFF(YEAR, residents.birth_date, CURDATE()) > 59
      ";
      $this->statement  = $this->connection()->prepare($this->sql);
      $this->statement ->execute();

      return $this->statement ->fetchColumn();
    }

    public function countPwds() {
      $this->sql = "
        SELECT count(residents.id)
        FROM residents
        LEFT JOIN person_disabilities ON residents.person_disability_id=person_disabilities.id
        WHERE 
            residents.deleted_at IS NULL 
            AND UPPER(TRIM(person_disabilities.name)) != 'NONE'
        ";
      $this->statement  = $this->connection()->prepare($this->sql);
      $this->statement ->execute();

      return $this->statement ->fetchColumn();
    }

    public function countVoters() {
      $this->sql = "
        SELECT count(residents.id)
        FROM residents
        WHERE 
            residents.deleted_at IS NULL 
            AND residents.voter_status = 'Active'
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
          SELECT COUNT(residents.id) as total
          FROM residents
          WHERE YEAR(residents.created_at) = YEAR(CURDATE())
              AND MONTH(residents.created_at) = ".$month."
          ";
      $this->statement  = $this->connection()->prepare($this->sql);
      $this->statement ->execute();

      return $this->statement ->fetchColumn();
  }

  public function countGenders($id) {
    $this->sql = "
      SELECT count(residents.id)
      FROM residents
      WHERE 
          residents.deleted_at IS NULL 
          AND residents.gender_id = ".$id."
      ";
    $this->statement  = $this->connection()->prepare($this->sql);
    $this->statement ->execute();

    return $this->statement ->fetchColumn();
  }

  public function gendersGraph() {
    $color_list = array_values(Helper::colorLists());
    $model = new GenderModel;
    $genders = $model->all();
    $labels = [];
    $values = [];
    $colors = [];

    foreach($genders as $index => $gender) {
      array_push($colors, $color_list[$index]);
      array_push($labels, $gender['name']);
      array_push($values, $this->countGenders($gender['id']));
    }

    return [
      'colors' => $colors,
      'labels' => $labels,
      'values' => $values,
    ];
  }

  public function countPersonDisabilities($id) {
    // person_disability_id default none id = 7
    $this->sql = "
      SELECT count(residents.id)
      FROM residents
      WHERE 
          residents.deleted_at IS NULL 
          AND residents.person_disability_id = ".$id."
          AND residents.person_disability_id != 7
      ";
    $this->statement  = $this->connection()->prepare($this->sql);
    $this->statement ->execute();

    return $this->statement ->fetchColumn();
  }

  public function personDisabilitiesGraph() {
    $color_list = array_values(Helper::colorLists());
    $this->sql = "
      SELECT *
      FROM person_disabilities
      WHERE 
        person_disabilities.deleted_at IS NULL 
          AND person_disabilities.id != 7
      ";
    $this->statement  = $this->connection()->prepare($this->sql);
    $this->statement ->execute();
    $person_disabilities = $this->statement ->fetchAll();

    $labels = [];
    $values = [];
    $colors = [];

    foreach($person_disabilities as $index => $person_disability) {
      array_push($colors, $color_list[$index]);
      array_push($labels, $person_disability['name']);
      array_push($values, $this->countPersonDisabilities($person_disability['id']));
    }

    return [
      'colors' => $colors,
      'labels' => $labels,
      'values' => $values,
    ];
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