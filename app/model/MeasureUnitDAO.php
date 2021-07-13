<?php

class MeasureUnitDAO extends BaseDAO
{
   protected static $tableName = "measure_units";

   /* Find the id of one measure unit thanks to its name */
   public static function findIDMeasureUnitWith($name_measure_unit)
   {
      $pdo = Database::getPdo();
      $sql = "SELECT id_measure_unit FROM measure_units WHERE name_measure_unit = '$name_measure_unit'";
      $result = $pdo->query($sql);
      $result->setFetchMode(PDO::FETCH_ASSOC);

      if ($result->rowcount() == 1) {
         $id_measure_unit = $result->fetch();
      } else {
         $id_measure_unit['id_measure_unit'] = null;
      }

      Database::disconnect();

      return $id_measure_unit['id_measure_unit'];
   }

   /* Creates a new measure unit */
   public static function createMeasureUnit($name_measure_unit)
   {
      $pdo = Database::getPdo();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO measure_units (name_measure_unit) values(?)";
      $q = $pdo->prepare($sql);
      $q->execute(
         [
            $name_measure_unit
         ]
      );
      $last_id = $pdo->lastInsertId();
      Database::disconnect();
      return $last_id;
   }

   /* Get the name of the measure unit thanks to its id */
   public static function getNameMeasureUnit($id_measure_unit)
   {
      $pdo = Database::getPdo();
      $sql = "SELECT name_measure_unit FROM measure_units WHERE id_measure_unit = $id_measure_unit";
      $result = $pdo->query($sql);
      $result->setFetchMode(PDO::FETCH_ASSOC);

      if ($result->rowcount() == 1) {
         $name_measure_unit = $result->fetch();
      } else {
         $name_measure_unit['name_measure_unit'] = "";
      }

      Database::disconnect();

      return $name_measure_unit['name_measure_unit'];
   }
}
