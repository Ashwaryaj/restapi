<?php
/**
 * Set display errors to 1
 */
ini_set("display_errors", "1");
/**
 * Report all type of errors
 */
error_reporting(E_ALL);
/**
 * Requires user modal
 */
require __DIR__ . '/../Modals/User.php';
/**
 * User Controller class
 */
class UserController
{
    static $model;
    /**
     * Initialises a new User.
     */
    public function __construct()
    {
        self::$model = new User();
    }

    /**
     * Calls save method of User modal to create a user
     *
     * @return boolean Save method of user model
     */
    public function create()
    {
        return self::$model->save($_POST);
    }
    /**
     * Calls save method of User modal to update a user
     *
     * @return boolean Save method of user model
     */
    public function update()
    {
        return self::$model->save($_POST);
    }
    /**
     * Calls delete method of User modal to delete a user
     *
     * @return boolean Delete method of user model
     */
    public function delete()
    {
        return self::$model->delete($_POST['id']);
    }
    /**
     * Calls find method of User modal to find a user
     *
     * @param  String  $action Signifies what action to perform on User modal
     * @param  Integer $id     User id
     * @return boolean        Find method of user model
     */
    public function find()
    {
        return self::$model->find($_GET);
    }
/*    *
     * Calls findAll method of User modal to findAll users
     *
     * @param  String  $action    Signifies what action to perform on User
     * @param  Integer $limit     Number of users per page
     * @param  Integer $offset    Starting user of a page
     * @param  String  $firstName First name of user
     * @return boolean        FindAll method of user model

    public function findAll($action, $limit, $offset, $firstName)
    {
        return self::$model->findAll($limit, $offset, $firstName);
    }*/
}
