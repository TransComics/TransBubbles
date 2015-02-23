<?php

class UsersControllerTest extends TestCase {

    /**
     * @test This test should show the login form when going to /login
     */
    public function testShowLoginForm() {
        $response = $this->call('GET', 'login');
        $this->assertTrue($response->isOk());
    }

    /**
     * @test Testing login form with invalid user
     */
    public function testLoginFormError() {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton(Lang::get('login.sign_in'))->form();
        
        $form->setValues(array(
            'email' => 'mail@test.com',
            'password' => 'test'
        ));
        
        $crawler = $this->client->submit($form);
        // Asserting the session has errors for several keys...
        $this->assertSessionHas('message', Lang::get('login.error_post_login'));
        
        $crawler = $this->client->followRedirect(true);
        $this->assertCount(1, $crawler->filter('li:contains("username")'));
    }

    /**
     * @test Testing login form with success
     */
    public function testLoginFormSuccess() {
        $result = $this->action('POST', 'UsersController@postCreate', [
            'username' => 'fooo',
            'email' => 'fooo@bar.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            '_token' => Session::token()
        ], [], [], [
            'HTTP_REFERER' => route('home')
        ]);
        
        $user = User::whereusername('fooo')->first();
        
        $this->client->request('GET', '/verify/'.$user->confirmation_code);      
        
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton(Lang::get('login.sign_in'))->form();
        
        $form->setValues(array(
            'email' => 'fooo@bar.com',
            'password' => 'password'
        ));
        
        $crawler = $this->client->submit($form);
        // Asserting the session has errors for several keys...
        $this->assertSessionHas('message', Lang::get('login.logged_in'));
        
        $crawler = $this->client->followRedirect(true);
    }
}

?>