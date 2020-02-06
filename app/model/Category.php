<?php
/**
 *
 */

class Category
{
  protected  $data_file;
  protected $db;


  function __construct()
  {
       $this->db=new Model();
  }
//
public function allSubCate()
{
  return $this->db->query("select * from categories where cat_main_cat = 0");
}



//

public function add(array $aData)
{

      $oStmt = $this->db->preparation('insert into exams values(?,?,?,?,?,?,?,?,?,?,?,?,?)');

          return $oStmt->execute($aData);

  }

  //
  public function delete($id)
  {
    $oStmt = $this->db->preparation('DELETE FROM categories WHERE id=?');

        return $oStmt->execute($id);
  }


  //

  public function update($aData)
  {
          $oStmt = $this->db->preparation('UPDATE  categories
                                          SET   cat_title=:title
                                          WHERE id=:id ');
          return $oStmt->execute($aData);

  }

  //

  public function find($aData)
  {
    $oStmt = $this->db->preparation('SELECT * FROM categories WHERE id =?');
  $oStmt->execute($aData);
        return $oStmt->fetch();

  }

}


 ?>
