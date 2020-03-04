<?php


class Admin
{
    protected  $data_file;
    protected $db;
    protected $inventory=[ ];

    function __construct()
    {
        $this->db=new Model();
    }


// return all row of table of users
    public function all()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1");
    }

    public function allCategories(){
        return $this->db->query('select * from categories WHERE Existing = 1');
    }

    public function allAdmin()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1 AND users.group_id = 1 AND users.user_state = 1");
    }

    public function allExaminer()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1 AND users.group_id = 2 AND users.user_state = 1");
    }

    public function allMember()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1 AND users.group_id = 3 AND users.user_state = 1");
    }

    public function allAdminPending()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1 AND users.group_id = 1 AND users.user_state = 0");
    }

    public function allExaminerPending()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1 AND users.group_id = 2 AND users.user_state = 0");
    }

    public function allMemberPending()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1 AND users.group_id = 3 AND users.user_state = 0");
    }

    public function allSubCate()
    {
        return $this->db->query("select * from categories WHERE Existing = 1");
    }

    public function countAllUsers(){
        $stmt = $this->db->preparation("SELECT * FROM users where user_state = 1 AND Existing = -1");
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function countAllPendingUsers(){
        $stmt = $this->db->preparation("SELECT * FROM users where user_state = 0 AND Existing = -1");
        $stmt->execute();
        return $stmt->rowCount();
    }


    public function allMainCategories()
    {
        return $this->db->query("select categories.*, users.user_name AS Created_By 
                                        from categories 
                                        INNER JOIN users 
                                        ON categories.user_id = users.user_id WHERE categories.cat_main_cat = 0");
    }

    public function allSubCategories()
    {
        return $this->db->query("select categories.*, users.user_name AS Created_By 
                                        from categories 
                                        INNER JOIN users 
                                        ON categories.user_id = users.user_id WHERE categories.cat_main_cat != 0");
    }

    public function adminUser()
    {
        return $this->db->query("select * from users WHERE group_id = 1");
    }

    public function checkLogin(array $aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM users WHERE  user_name =:username  AND user_pwd =:password AND group_id = 1');
        $oStmt->execute($aData);
        $users = $oStmt->fetchAll();
        return $users;
    }


    public function delete($id)
    {
        $oStmt = $this->db->preparation('UPDATE users SET Existing = 0 WHERE user_id = ?');

        return $oStmt->execute($id);
    }


//

    public function update($aData)
    {
        $oStmt = $this->db->preparation('UPDATE `users` SET `full_name`=:fullname,`user_name`=:username,`user_pwd`=:password,`user_email`=:email,
                                            `phone`=:mobile,`group_id`=:type,image=:picture WHERE user_id =:id ');
        return $oStmt->execute($aData);

    }

    public function updateActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE users set user_state=1 where user_id=? ');
        return $oStmt->execute($aData);

    }
    public function updatedisActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE users set user_state=0 where user_id=? ');
        return $oStmt->execute($aData);

    }
//
////
//
    public function find($aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM users WHERE user_id =?');
        $oStmt->execute($aData);
        return $oStmt->fetch();

    }

}