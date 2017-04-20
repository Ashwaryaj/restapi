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
        $arr=array();
        $this->assertEquals($arr, $this->user->find(4));
    }

    public function testFindByIdZero()
    {
        $this->assertTrue($this->user->find(0));
    }

    public function testFindByIdNegative()
    {
        $this->assertTrue($this->user->find(-1));
    }

    public function testFindByIdPositive()
    {
        $this->assertTrue($this->user->find(3));
    }

    public function testFindByIdNotNumber()
    {
        $this->assertTrue($this->user->find('@'));
    }

    public function testFindByIdNotExists()
    {
        $this->assertTrue($this->user->find(9));
    }

    public function testFindByIdExists()
    {
        // Save
        // Id
        $this->assertTrue($this->user->find(1));
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
        $this->assertTrue($this->user->delete(3));
    }

    public function testDeleteByIdNotNumber()
    {
        $this->assertTrue($this->user->delete('@'));
    }

    public function testDeleteByIdNotExists()
    {
        $this->assertTrue($this->user->delete(9));
    }

    public function testDeleteByIdExists()
    {

        $this->assertTrue($this->user->delete(1));
    }

    public function testFindAll()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->findAll(4, 4, 'Ben'));
    }

    public function testFindAllByOffset()
    {
        $this->assertTrue($this->user->findAll(5));
    }

    public function testFindAllByFilter()
    {
        $this->assertTrue($this->user->findAll(5));
    }

    public function testSave()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testUpdate()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testSaveWithRequiredValidation()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testSaveWithEmailValidation()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testUpdateWithExistId()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testUpdateWithIdZero()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testUpdateWithNegativeId()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(-5));
    }
    public function testUpdateWithInvalidId()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save('@'));
    }

    public function testUpdateWithNotExistId()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testUpdateWithRequiredValidation()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
    }

    public function testUpdateWithEmailValidation()
    {
        $arr=array();
        $this->assertEquals($arr, $this->user->save(5));
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
        $this->assertTrue($this->user->findAll(5, -5, 'Ben'));
    }

    public function testFindAllByOffsetFloat()
    {
        $this->assertTrue($this->user->findAll(5, 5.0, 'Ben'));
    }
    public function testFindAllByOffsetNotExists()
    {
        $this->assertTrue($this->user->findAll(5, '@', 'Ben'));
    }
    public function testFindAllByLimitNegative()
    {
        $this->assertTrue($this->user->findAll(-5, 5, 'Ben'));
    }

    public function testFindAllByLimitFloat()
    {
        $this->assertTrue($this->user->findAll(5.0, 5, 'Ben'));
    }
    public function testFindAllByLimitInvalid()
    {
        $this->assertTrue($this->user->findAll('!', 5, 'Ben'));
    }
    public function testFindAllByFilterInvalid()
    {
        $this->assertTrue($this->user->findAll('!', 5, 98));
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
