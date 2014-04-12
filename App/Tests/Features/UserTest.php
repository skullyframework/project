<?php


namespace Tests\Features;

require_once(dirname(__FILE__) . '/../DatabaseTestCase.php');
use Tests\DatabaseTestCase;
use RedBean_Facade as R;

class UserTest extends DatabaseTestCase {
    public function testRegisterFailWrongConfirmation()
    {
        $user = $this->app->createModel('user');
        $user->firstName = 'test';
        $user->email = 'correct@correct.com';
        $user->password = 'password';
        $user->passwordConfirmation = 'apassword';
        try {
            R::store($user);
        }
        catch(\Exception $e){

        }
        $this->assertNotEmpty($user->getErrors());
        $this->assertEmpty($user->getID());
    }

    public function testRegisterFailEmptyPassword()
    {
        $user = $this->app->createModel('user');
        $user->firstName = 'test';
        $user->email = 'correct@correct.com';
        $user->password = '';
        $user->passwordConfirmation = 'apassword';
        try {
            R::store($user);
        }
        catch(\Exception $e){

        }
        $this->assertNotEmpty($user->getErrors());
        $this->assertEmpty($user->getID());
    }

    public function testRegisterAndLogin()
    {
        $this->migrate();
        session_id(1111);
        $user = $this->app->createModel('user');
        $user->firstName = 'test';
        $user->email = 'correct@correct.com';
        $user->password = 'password';
        $user->passwordConfirmation = 'password';
        R::store($user);
        $this->assertEmpty($user->getErrors());
        $this->assertEquals(1, $user->getID());
        $this->assertNotEmpty($user->getPassword());

        /** @var \App\Models\Repositories\UserRepository $userRepository */
        $userRepository = $this->app->getRepository('User');
        /** @var \App\Models\User $user */
        $user = $userRepository->login('correct@correct.com', 'password');
        $sessionId = session_id();
        $usersession = R::findOne('usersession', "session_id = ?", array($sessionId));
        $this->assertNotEmpty($usersession);

        $this->assertNotEmpty($user);
        $this->assertEquals($user->getID(), $this->app->getSession()->get('userId'));

        session_id(2222);
        $userRepository->login('correct@correct.com', 'password');
        $usersession = R::findOne('usersession', "session_id = ?", array($sessionId));
        $this->assertEmpty($usersession);
    }

    public function testUserValidation(){

        $user = array(
            'email' => 'new2@user.com',
//            'password' => 'password',
//            'passwordConfirmation' => 'password',
            'birthdate' => array(
                'Day' => '12',
                'Month' => '1',
                'Year' => '1992'
            ),
            'gender' => 'female',
            'firstName' => 'first Name',
            'lastName' => 'Last Name'
        );
        $userModel = $this->app->createModel('user', $user);
//        $this->assertEquals($userModel->validates(), true);
        $this->assertEquals($userModel->validates(), false);
    }
}
 