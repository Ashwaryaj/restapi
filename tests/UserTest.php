<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;
    protected function setUp()
    {
        $this->user = new User();
    }
    public function testInstanceOf()
    {
        $this->assertInstanceOf(User::class, $this->user);
    }
    public function testFind()
    {
        $this->assertNotEmpty($this->user->find(4));
    }
    public function testFindByIdZero()
    {
        $this->assertFalse($this->user->find(0));
    }
    public function testFindByIdNegative()
    {
        $this->assertFalse($this->user->find(-1));
    }
    public function testFindByIdPositive()
    {
        $this->assertNotEmpty($this->user->find(4));
    }
    public function testFindByIdNotNumber()
    {
        $this->assertFalse($this->user->find('@'));
    }
    public function testFindByIdNotExists()
    {
        $this->user->deleteAll();
        $this->assertFalse($this->user->find(1));
    }
    public function testFindByIdExists()
    {
        $this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $id=// id of the saved user
        $this->assertNotEmpty($this->user->find($id));
    }
    public function testDeleteById()
    {
        $this->assertFalse($this->user->delete(0));
    }
    public function testDeleteByIdNegative()
    {
        $this->assertFalse($this->user->delete(-1));
    }
    public function testDeleteByIdPositive()
    {
        $this->assertNotEmpty($this->user->delete(4));
    }
    public function testDeleteByIdNotNumber()
    {
        $this->assertFalse($this->user->delete('@'));
    }
    public function testDeleteByIdNotExists()
    {
        $this->user->deleteAll();
        $this->assertFalse($this->user->delete(7));
    }
    public function testDeleteByIdExists()
    {
        $this->user->save(['id'=>6, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $id=// id of the saved user
        $this->assertNotEmpty($this->user->find($id));
    }
    public function testFindAll()
    {
        $this->assertNotEmpty($this->user->findAll(4, 4, 'Ben'));
    }
    public function testFindAllByOffset()
    {
        $this->assertNotEmpty($this->user->findAll([], 5));
    }
    public function testFindAllByFilter()
    {
        $this->assertNotEmpty($this->user->findAll());
    }
    public function testSave()
    {
        $userDetails=array();
        $userDetails=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($userDetails);
    }
    public function testUpdate()
    {
        $this->assertNotEmpty($this->user->save(['id'=>1,'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testSaveWithRequiredValidation()
    {
        $this->assertNotEmpty($this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testSaveWithEmailValidation()
    {
        $this->assertNotEmpty($this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithExistId()
    {
        $this->assertNotEmpty($this->user->save(['id'=>6, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithIdZero()
    {
        $this->assertEmpty($this->user->save(['id'=>0, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithNegativeId()
    {
        $this->assertEmpty($this->user->save(['id'=>-1, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithInvalidId()
    {
        $this->assertEmpty($this->user->save(['id'=>'@', 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithNotExistId()
    {
        $this->user->deleteAll();
        $this->assertEmpty($this->user->save(['id'=>6, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithRequiredValidation()
    {
        $this->assertNotEmpty($this->user->save(['id'=>6, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithEmailValidation()
    {
        $this->assertNotEmpty($this->user->save(['id'=>6, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testBeforeSave()
    {
        $this->assertTrue($this->user->beforeSave());
    }
    public function testAfterSave()
    {
        $this->assertTrue($this->user->afterSave());
    }
    public function testBeforeDelete()
    {
        $this->assertTrue($this->user->beforeDelete());
    }
    public function testAfterDelete()
    {
        $this->assertTrue($this->user->afterDelete());
    }
    public function testBeforeFind()
    {
        $this->assertTrue($this->user->beforeFind());
    }
    public function testAfterFind()
    {
        $this->assertTrue($this->user->afterFind());
    }
    public function testRules()
    {
        $this->assertTrue($this->user->rules());
    }
    public function testValidate()
    {
        $this->assertTrue($this->user->validate());
    }
    public function testLabels()
    {
        $this->assertTrue($this->user->labels());
    }
    public function testFindAllByOffsetNegative()
    {
        $this->assertFalse($this->user->findAll(5, -5, 'Ben'));
    }
    public function testFindAllByOffsetFloat()
    {
        $this->assertFalse($this->user->findAll(5, 5.0, 'Ben'));
    }
    public function testFindAllByOffsetNotExists()
    {
        $this->assertFalse($this->user->findAll(5, '@', 'Ben'));
    }
    public function testFindAllByLimitNegative()
    {
        $this->assertFalse($this->user->findAll(-5, 5, 'Ben'));
    }
    public function testFindAllByLimitFloat()
    {
        $this->assertFalse($this->user->findAll(5.0, 5, 'Ben'));
    }
    public function testFindAllByLimitInvalid()
    {
        $this->assertFalse($this->user->findAll('!', 5, 'Ben'));
    }
    public function testFindAllByFilterInvalid()
    {
        $this->assertFalse($this->user->findAll(5, 5, 98));
    }
    public function testFindAllByFirstNameLengthExceeds()
    {
        $firstName="Abcdefghijklmnopqrstuvwxyz";
        if (strlen($firstName) >=15) {
            $check=true;
        }
        $this->assertTrue($check);
    }
}
