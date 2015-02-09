<?php

class UserTest extends TestCase {

    /**
     * Username is required
     * @expectedException PDOException
     */
   
    public function testUsernameIsRequired() {
        // Create a new User
        $user = new User();
        $user->email = "name@domain.com";
        $user->password = "password";
        $user->created_at ="2015-02-03 18:08:56";
        
        // User should not save
        $this->assertFalse($user->save());
        
        // Save the errors
        $errors = $user->errors()->all();
        
        // There should be 1 error
        $this->assertCount(1, $errors);
        
        // The username error should be set
        $this->assertEquals($errors[0], Lang::get('validation.required')->with('username'));
    }

    /**
     * Saving user to database
     */
    public function testSavingUser() {
        // Create a new User
        $user = new User();
        $user->username = "username";
        $user->email = "name@domain.com";
        $user->password = "password";
        
        // User should save
        $this->assertTrue($user->save());
    }

    /**
     * Checking for duplication
     * @expectedException PDOException
     */
    public function testUserDuplication() {
        // Create a new User
        $user = new User();
        $user->username = "username";
        $user->email = "name@domain.com";
        $user->password = "password";
        
        $user2 = new User();
        $user2->username = "username";
        $user2->email = "name@domain.com";
        $user2->password = "password";
        
        // User should save
        $this->assertTrue($user->save());
        
        // User should save only once
        $this->assertFalse($user2->save());
    }
}
?>