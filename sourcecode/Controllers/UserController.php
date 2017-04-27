<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

require __DIR__ . '/../Modals/User.php';

class UserController
{
    static $model;

    public function __construct()
    {
        self::$model = new User();
    }

    public function create()
    {
        return self::$model->save($_POST);
    }

    public function update()
    {
        return self::$model->save($_POST);
    }
    public function delete()
    {
        return self::$model->delete($_POST['id']);
    }
    public function find($action, $id)
    {
        return self::$model->find($_POST);
    }
    public function findAll($action, $limit, $offset, $firstName)
    {
        return self::$model->findAll($limit, $offset, $firstName);
    }
}
