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

    public function all()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1");
    }
//
    public function allSubCate()
    {
        return $this->db->query("select * from categories where cat_main_cat != 0 and cat_state = 1");
    }


//public function selfjoin(){
//      return $this->db->query("SELECT A.cat_id AS main_id, A.cat_name AS main_name ,B.cat_name AS sub_name, B.cat_main_cat AS sub_of_main_id FROM categories A, categories B WHERE A.cat_id = B.cat_main_cat AND A.cat_main_cat = 0");
//}

//public function selfjoin(){
//      return $this->db->query("SELECT A.cat_id AS main_id, A.cat_name AS main_name ,B.cat_name AS sub_name, B.cat_main_cat AS sub_of_main_id FROM categories A, categories B WHERE A.cat_id = B.cat_main_cat AND A.cat_main_cat = 0");
//}

//

    public function add(array $aData)
    {

        $oStmt = $this->db->preparation('insert into categories(cat_name,cat_description,cat_created_at,cat_main_cat,user_id) values(?,?,now(),?,?)');

        return $oStmt->execute($aData);
    }

    public function allCategories(){
        return $this->db->query('select * from categories WHERE Existing = 1');
    }

    //
    public function delete($id)
    {
        $oStmt = $this->db->preparation('UPDATE categories SET Existing = 0 WHERE cat_id = ?');
        return $oStmt->execute($id);
    }
    
    public function update($aData)
    {
        $oStmt = $this->db->preparation('UPDATE categories
                                          SET cat_name=:name , cat_description=:description,
                                          cat_updated_at=now(),
                                          cat_main_cat=:cat,
                                          user_id=:userID 
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

    public function get_category()
    {
        $Stmt = $this->db->preparation('select * from categories where cat_main_cat = 0 and cat_state = 1');

        $Stmt->execute();
        return $Stmt->fetchAll();

    }

    public function get_sub_cat($cat_id)
    {
        $Stmt = $this->db->preparation('select * from categories where cat_main_cat=? and cat_state = 1');

        $Stmt->execute($cat_id);
        return $Stmt->fetchAll();

    }

    public function updateActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE categories set cat_state=1 where cat_id=? ');
        return $oStmt->execute($aData);

    }
    public function updatedisActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE categories set cat_state=0 where cat_id=? ');
        return $oStmt->execute($aData);

    }

}

?>
