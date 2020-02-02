<?php
/**
 *
 */

class question
{
    protected  $data_file;
    protected $db;


    function __construct()
    {
        $this->db=new Model();
    }
//
    public function allQuez()
    {
        return $this->db->query("select * from questions");
    }



//

    public function addQuez(array $aData)
    {

        $oStmt = $this->db->preparation('INSERT INTO questions VALUES(?,?,?,?)');

        return $oStmt->execute($aData);

    }

    public function addChoice(array $aData)
    {

        $oStmt = $this->db->preparation('INSERT INTO choices VALUES  (?,?,?,?)');

        return $oStmt->execute($aData);

    }

    public function addUserChoice(array $aData)
    {

        $oStmt = $this->db->preparation('INSERT INTO user_choice(user_id, choice_id) VALUES (?,?)');

        return $oStmt->execute($aData);

    }


    public function getQofSample(array $Data){
        $oStmt = $this->db->preparation("select * from questions where sample_id=?");
        $oStmt->execute($Data);
        return $oStmt->fetchAll();
    }

    public function getChoicesofQ(array $Data){
        $oStmt = $this->db->preparation("select * from choices where q_id=?");
        $oStmt->execute($Data);
        return $oStmt->fetchAll();
    }
    public function True_choices($Data)
    {
//               show_choices_of_question
        $oStmt = $this->db->preparation("select *  from choices where q_id=? and choice_true_answer=1");
        $oStmt->execute([$Data]);
        return $oStmt->fetchAll();

    }
    public function Q_($Data)
    {
        $oStmt = $this->db->preparation("select * from questions where q_id=?");
        $oStmt->execute([$Data]);
        return $oStmt->fetchAll();
    }
    public function calc_exam($q_id){
        $true_choice=True_choices($q_id);
        $choiceOfQ=choices_of_questions($q_id);
    }
    public function correctAnsower(array $aData)
    {

        $oStmt = $this->db->preparation('update choices set choice_true_answer = 1 where choice_id = ?');

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
