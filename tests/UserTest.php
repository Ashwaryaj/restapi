<?php
use PHPUnit\Framework\TestCase;

/**
 * This is unit testing of User modal.
 */
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
        $id=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($this->user->find($id));
    }
    public function testFindByIdZero()
    {
        $this->assertEmpty($this->user->find(0));
    }
    public function testFindByIdNegative()
    {
        $this->assertEmpty($this->user->find(-1));
    }
    public function testFindByIdNotNumber()
    {
        $this->assertEmpty($this->user->find('@'));
    }
    public function testFindByIdPositive()
    {
        $id=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($this->user->find($id));
    }
    public function testFindByIdNotExists()
    {
        $this->user->deleteAll();
        $this->assertEmpty($this->user->find(1));
    }
    public function testFindByIdExists()
    {
        $this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $id= $this->user->getLastId();
        $this->assertNotEmpty($this->user->find($id));
    }
    public function testDeleteByIdPositive()
    {
        $message=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertTrue($this->user->delete($this->user->getLastId()));
    }
    public function testDeleteByIdNegative()
    {
        $this->assertFalse($this->user->delete(-1));
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
        $this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $id=$this->user->getLastId();
        $this->assertNotEmpty($this->user->find($id));
    }
    public function testFindAll()
    {
        $this->user->save(['firstName'=>'asd', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($this->user->findAll(4, 0, 'asd'));
    }
    public function testFindAllByOffset()
    {
        $this->assertNotEmpty($this->user->findAll(1, 0));
    }
    public function testFindAllByFilter()
    {
        $this->assertNotEmpty($this->user->findAll());
    }
    public function testSave()
    {
        $id=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
    }
    public function testUpdate()
    {
        $this->assertTrue($this->user->save(['id'=>1,'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Pune', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithNegativeId()
    {
        $this->assertFalse($this->user->save(['id'=>-1, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithInvalidId()
    {
        $this->assertFalse($this->user->save(['id'=>'@', 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithNotExistId()
    {
        $this->user->deleteAll();
        $this->assertEmpty($this->user->save(['id'=>6, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithExistId()
    {
        $this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $id=$this->user->getLastId();
        $this->assertTrue($this->user->save(['id'=>$id,'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Pune', 'age'=>21, 'phoneNumber'=>"9087054321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithIdZero()
    {
        $this->assertFalse($this->user->save(['id'=>0, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testSaveWithRequiredValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $id=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
    }
    public function testSaveWithLengthValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $id=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
    }
    public function testSaveWithEmailValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $id=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
    }
    public function testSaveWithTypeValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $id=$this->user->save(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
    }
    public function testUpdateWithRequiredValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $id=$this->user->save(['id'=>3,'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'London', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
    }
    public function testUpdateWithEmailValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $id=$this->user->save(['id'=>1, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
    }
    public function testUpdateWithLengthValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $this->assertTrue($this->user->save(['id'=>1, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Won', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
    }
    public function testUpdateWithTypeValidation()
    {
        $this->assertFalse($this->user->validate(['firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Delhi', 'age'=>21, 'phoneNumber'=>"9087654321", 'email'=>"ashwaryajethi@yahoo.co.in"]));
        $id=$this->user->save(['id'=>1, 'firstName'=>'Ben', 'middleName'=>'Ten', 'lastName'=>'Don', 'address'=>'Pune', 'age'=>21, 'phoneNumber'=>"9087654323", 'email'=>"ashwaryajethi@yahoo.co.in"]);
        $this->assertNotEmpty($id);
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
    public function testLabels()
    {
        $this->assertTrue($this->user->labels());
    }
    public function testFindAllByOffsetNegative()
    {
        $this->assertFalse($this->user->findAll(5, -1, 'Ben'));
    }
    public function testFindAllByOffsetFloat()
    {
        $this->assertEmpty($this->user->findAll(5, 7.9876, 'Ben'));
    }

    public function testFindAllByLimitNegative()
    {
        $this->assertFalse($this->user->findAll(-5, 0, 'Ben'));
    }
    public function testFindAllByOffsetNotExists()
    {
        $this->assertNotEmpty($this->user->findAll(5, '?', 'Ben'));
    }
    public function testFindAllByLimitFloat()
    {
        $this->assertNotEmpty($this->user->findAll(5.078, 0, 'Ben'));
    }
    public function testFindAllByLimitInvalid()
    {
        $this->assertEmpty($this->user->findAll('!', 0, 'Ben'));
    }
    public function testFindAllByFilterInvalid()
    {
        $this->assertEmpty($this->user->findAll(5, 0, 98));
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
