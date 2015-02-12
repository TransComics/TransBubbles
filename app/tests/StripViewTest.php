<?php

class StripViewTest extends TestCase {

    public function setUp() {
        parent::setUp();
        Artisan::call('db:seed');
    }

    public function testStripsAddNoLogin() {
        $this->client->request('GET', 'comic/1/strip/create');
        
        $this->assertRedirectedToRoute('user.signin');
    }

    public function testStripsAddLogin() {
        Auth::loginUsingId(1);

        $this->client->request('GET', 'comic/1/strip/create');
        $this->assertResponseOk();
    }

    public function testEditFirstStripNoLogin() {
        $this->client->request('GET', 'comic/1/strip/1/edit');
        $this->assertRedirectedTo('user.signin');
    }

    public function testEditFirstStripLogin() {
        Auth::loginUsingId(1);

        $this->client->request('GET', 'comic/1/strip/1/edit');
        $this->assertResponseOk();
    }
}
