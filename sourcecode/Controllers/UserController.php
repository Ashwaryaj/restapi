<?php
  class UserController
  {
    public function create()
    {
        echo "string";
        die();
        //return mixed
    }

    public function update()
    {
        echo "str";
        //return mixed
    }
    public function delete($id)
    {
        //return mixed
    }
    public function find($id)
    {
        //return mixed
    }
    public function findAll($limit, $offset, $firstName)
    {
        //return mixed
    }

    public function list()
    {
        return ['testing'];
    }

    public function listing($action, $filter)
    {
        return ['action' => $action, 'filter' => $filter];
    }
  }
