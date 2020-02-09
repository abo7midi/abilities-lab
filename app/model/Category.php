<?php
/**
 *
 */

class Category
{
  protected $data_file;
  protected $db;


  function __construct()
  {
       $this->db=new Model();
  }
//
public function allSubCate()
{
  return $this->db->query("select * from categories");
}

//

public function selfjoin(){
      return $this->db->query("SELECT A.cat_id AS main_id, A.cat_name AS main_name ,B.cat_name AS sub_name, B.cat_main_cat AS sub_of_main_id FROM categories A, categories B WHERE A.cat_id = B.cat_main_cat AND A.cat_main_cat = 0");
}

//

public function add(array $aData)
{

      $oStmt = $this->db->preparation('insert into categories(cat_name,cat_description,cat_created_at,cat_main_cat) values(?,?,now(),?)');

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
          $oStmt = $this->db->preparation('UPDATE categories
                                          SET cat_name=:name , cat_description=:description,
                                          cat_updated_at=now(),
                                          cat_main_cat=:cat
                                          WHERE cat_id=:id ');
          return $oStmt->execute($aData);

  }

  //

  public function find($aData)
  {
    $oStmt = $this->db->preparation('SELECT * FROM categories WHERE cat_id =?');
  $oStmt->execute($aData);
        return $oStmt->fetch();

  }

}


 ?>
