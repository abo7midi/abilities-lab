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

    public function allSubCate()
    {
        return $this->db->query("select * from categories WHERE Existing = 1");
    }

    public function adminUser()
    {
        return $this->db->query("select * from users WHERE group_id = 1");
    }

    public function checkLogin(array $aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM users WHERE  user_name =:username  AND user_pwd =:password AND group_id = 1 LIMIT =1');
        $oStmt->execute($aData);
        $users = $oStmt->fetchAll();
        return $users;
    }


}