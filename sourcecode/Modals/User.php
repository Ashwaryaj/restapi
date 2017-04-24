<?php
class User
{
    public function beforeSave()
    {
        return true;
    }

    public function afterSave()
    {
        return true;
    }

    public function beforeDelete()
    {
        return true;
    }

    public function afterDelete()
    {
        return true;
    }

    public function beforeFind()
    {
        return true;
    }

    public function afterFind()
    {
        return true;
    }

    public function rules()
    {
        return true;
    }

    public function validate()
    {
        return true;
    }

    public function labels()
    {
        return true;
    }

    public function save()
    {
        return array();
    }

    public function find($id)
    {
        return array('id'=>$id);
    }

    public function delete($id)
    {
        return array();
    }

    public function findAll($limit, $offset, $firstName)
    {
        return array();
    }
}
