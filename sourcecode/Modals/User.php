<?php
require '../restapi/sourcecode/config.php';


class User
{
    private $conn;
    private $sql;

    protected $rules = [
        'required' => ['first_name', 'last_name', 'email', 'age'],
    ];

    public function __construct()
    {
        $servername = DB_HOST;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $dbName = DB_NAME;
        //make connection
        try {
            $this->conn = new PDO(
                "mysql:host=$servername;dbname=$dbName",
                $username,
                $password
            );
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Could not connect to database";
            die();
        }
    }
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

    public function validate($userDetails = array())
    {
        $errors = [];

        foreach ($this->rules as $rule => $fields) {
            foreach ($fields as $field) {
                if (!$this->$rule($field, $userDetails)) {
                    $errors[$field] = $rule;
                }
            }
        }

        return (boolean)count($errors);
    }

    public function required($field, $data)
    {
        return (isset($data[$field]) && !empty($data[$field]));
    }

    public function labels()
    {
        return true;
    }

    public function save($userDetails = array())
    {

        try {
            if (!array_key_exists('id', $userDetails)) {
                $sql = $this->conn->prepare("INSERT INTO users (first_name, middle_name, last_name, email, age, phone_no, address)
                VALUES (:firstName, :middleName, :lastName, :email, :age, :phoneNumber, :address)");
                $sql->execute($userDetails);
                return $this->conn->lastInsertId();
            } else {
                $sql= $this->conn->prepare("update users set first_name=:firstName, middle_name=:middleName, last_name=:lastName, email=:email, age=:age, phone_no=:phoneNumber, address=:address where id=:id");
                $sql->execute($userDetails);
                $count= $sql->rowCount();
                if (0==$count) {
                    return false;
                } else {
                    return true;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function find($id)
    {
        try {
            $sql=$this->conn->prepare("select id from users where id=:id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function deleteAll()
    {
        try {
            $sql=$this->conn->prepare("truncate table users");
            $sql->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $sql=$this->conn->prepare("delete from users where id=:id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            $count= $sql->rowCount();
            if (0==$count) {
                return false;
            }
            //return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function findAll($limit = 10, $offset = null, $firstName = null)
    {
        try {
            if ($limit <= 0) {
                $limit = 0;
            }

            $sql=$this->conn->prepare("select * from users where first_name=:firstName LIMIT :limit OFFSET :offset");
            $sql->bindParam(':firstName', $firstName);
            $sql->bindValue(':limit',  (int)$limit, PDO::PARAM_INT);
            $sql->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getLastId()
    {
        return $this->conn->lastInsertId();
    }
}
