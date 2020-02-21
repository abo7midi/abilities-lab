<?php
/**
 *
 */

class Sample
{
    protected  $data_file;
    protected $db;


    function __construct()
    {
        $this->db=new Model();
    }
//
    public function all()
    {
        return $this->db->query("select * from samples");
    }


    public function getExamSamples(array $Data){
        $oStmt = $this->db->preparation("select * from samples where exam_id=?");
        $oStmt->execute($Data);
        return $oStmt->fetchAll();
    }

    public function getUserExamSamples(array $Data){
        $oStmt = $this->db->preparation("SELECT * FROM `samples` WHERE exam_id=? AND sample_id not in (SELECT sample_id from user_exam WHERE user_id =? and exam_id =?)");
        $oStmt->execute($Data);
        return $oStmt->fetchAll();
    }

/*select e.*,COUNT(s.sample_id) from exams e INNER join samples s USING (exam_id) GROUP BY e.exam_id having cat_id=3 and exam_state=1*/
//

    public function add(array $aData)
    {

        $oStmt = $this->db->preparation('insert into samples values(?,?,?,?)');

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
