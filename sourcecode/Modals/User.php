<?php
require __DIR__ . '/../config.php';
/**
 * User Modal class
 */
class User
{
    /**
     * Connection object for database connection
     *
     * @var private
     */
    private $conn;
    /**
     * Sql object for sql commands
     *
     * @var private
     */
    private $sql;
    /**
     * Rules for validation
     *
     * @var protected
     */
    protected $rules = [
        'required' => ['firstName', 'lastName', 'email', 'age', 'address', 'phoneNumber'],
        'validEmail' => ['email'],
        'alphanumeric' => ['address'],
        'alphabetic' => ['firstName', 'middleName', 'lastName'],
        'lengthCheck' => [
            [
                'firstName' => [
                    'min' => 0,
                    'max' => 20,
                ],
            ],
            'middleName' => [
                'min' => 1,
                'max' => 20,
            ],
            'lastName'  => [
                'min' => 1,
                'max' => 20,
            ],
            'email'  => [
                'min' => 5,
                'max' => 50,
            ],
            'age'  => [
                'min' => 1,
                'max' => 3,
            ],
            'address'   => [
                'min' => 4,
                'max' => 200,
            ],
            'phoneNumber'  => [
                'min' => 5,
                'max' => 15,
            ]
        ]
    ];
    /**
     * Modal constructor. Provides db connection
     */
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
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Performs actions before executing Save method
     *
     * @return boolean Boolean true
     */
    public function beforeSave()
    {
        return true;
    }
    /**
     * Performs actions after executing Save method
     *
     * @return boolean Boolean true
     */
    public function afterSave()
    {
        return true;
    }
    /**
     * Performs actions before executing Delete method
     *
     * @return boolean Boolean true
     */
    public function beforeDelete()
    {
        return true;
    }
    /**
     * Performs actions after executing Delete method
     *
     * @return boolean Boolean true
     */
    public function afterDelete()
    {
        return true;
    }
    /**
     * Performs actions before executing Find method
     *
     * @return boolean Boolean true
     */
    public function beforeFind()
    {
        return true;
    }
    /**
     * Performs actions after executing Find method
     *
     * @return boolean Boolean true
     */
    public function afterFind()
    {
        return true;
    }
    /**
     * Provides validation for user
     *
     * @param  array $userDetails Contains all user details like first name,last name, age etc
     * @return boolean              Errors count
     */
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
    /**
     * For required validation
     *
     * @param  mixed $field It can be any field related to user
     * @param  array $data  User details
     * @return boolean        If field has a value then true otherwise false
     */
    public function required($field, $data)
    {
        return (isset($data[$field]) && !empty($data[$field]));
    }
    /**
     * For email validation
     *
     * @param  mixed $field It can be any field related to user
     * @param  array $data  User details
     * @return boolean        If email is validated then true otherwise false
     */
    public function validEmail($field, $data)
    {
        $email = $data[$field];
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        return (preg_match($regex, $email))?true:false;
    }
    /**
     * Check whether field is alphabetic
     *
     * @param  mixed $field It can be any field related to user
     * @param  array $data  User details
     * @return boolean       true If field is alphabetic else false
     */
    public function alphabetic($field, $data)
    {
        return ctype_alpha($data[$field]);
    }
    /**
     * Check whether field is alphanumeric
     *
     * @param  mixed $field It can be any field related to user
     * @param  array $data  User details
     * @return boolean       true If field is alphanumeric else false
     */
    public function alphanumeric($field, $data)
    {
        return ctype_alnum($data[$field]);
    }
    /**
     * Check whether field is of specified length
     *
     * @param  mixed $field It can be any field related to user
     * @param  array $data  User details
     * @return boolean       true If field is of specified length else false
     */
    public function lengthCheck($field, $data)
    {
        $inputKey = (array_keys($field))[0];

        if (isset($data[$inputKey])) {
            return (strlen($data[$inputKey]) >= $field[$inputKey]['min']);
        }

        return true;
    }
    /**
     * Provides labels for application
     *
     * @return boolean true
     */
    public function labels()
    {
        return true;
    }
    /**
     * Creates/Updates a user
     *
     * @param  array $userDetails Fields  related to user
     * @return mixed             Boolean or error message
     */
    public function save($userDetails = array())
    {
        try {
            if (!array_key_exists('id', $userDetails)) {
                $sql = $this->conn->prepare(
                    "INSERT INTO users (first_name, middle_name, last_name, email, age, phone_no, address)
                VALUES (:firstName, :middleName, :lastName, :email, :age, :phoneNumber, :address)"
                );
                $sql->bindParam(':firstName', $userDetails['firstName']);
                $sql->bindParam(':middleName', $userDetails['middleName']);
                $sql->bindParam(':lastName', $userDetails['lastName']);
                $sql->bindParam('email', $userDetails['email']);
                $sql->bindParam(':age', $userDetails['age']);
                $sql->bindParam('phoneNumber', $userDetails['phoneNumber']);
                $sql->bindParam('address', $userDetails['address']);
                $sql->execute();
                return $this->conn->lastInsertId();
            } else {
                $sql= $this->conn->prepare("update users set first_name=:firstName, middle_name=:middleName, last_name=:lastName, email=:email, age=:age, phone_no=:phoneNumber, address=:address where id=:id");
                $sql->bindParam(':id', $userDetails['id']);
                $sql->bindParam(':firstName', $userDetails['firstName']);
                $sql->bindParam(':middleName', $userDetails['middleName']);
                $sql->bindParam(':lastName', $userDetails['lastName']);
                $sql->bindParam('email', $userDetails['email']);
                $sql->bindParam(':age', $userDetails['age']);
                $sql->bindParam('phoneNumber', $userDetails['phoneNumber']);
                $sql->bindParam('address', $userDetails['address']);
                $sql->execute();
                $count= $sql->rowCount();

                if (0==$count) {
                    return false;
                } else {
                    return true;
                }
            }
        } catch (PDOException $e) {
            return  $e->getMessage();
        }
    }
    /**
     * Method for finding a user
     *
     * @param  Integer $id id of user
     * @return mixed     Boolean or String based on records fetched or error
     */
    public function find($id)
    {
        try {
            $sql=$this->conn->prepare("select * from users where id=:id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Deletes all user
     *
     * @return String PDO error message
     */
    public function deleteAll()
    {
        try {
            $sql=$this->conn->prepare("truncate table users");
            $sql->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**
     * Deletes a user
     *
     * @param  Integer $id User id
     * @return mixed     Boolean or String based on records deleted or error
     */
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
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function findAll($limit = 10, $offset = 0, $firstName = 'Ben')
    {
        try {
            $sql=$this->conn->prepare("SELECT * from users WHERE first_name=:firstName LIMIT  :offset, :lmt");
            $sql->bindParam(':firstName', $firstName);
            $sql->bindValue(':offset', $offset, PDO::PARAM_INT);
            $sql->bindValue(':lmt', $limit, PDO::PARAM_INT);
            $sql->execute();
            $result=$sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Get last inserted user id
     *
     * @return Integer Id of last inserted user
     */
    public function getLastId()
    {
        return $this->conn->lastInsertId();
    }
}
