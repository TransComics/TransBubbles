<?php

class StripViewTest extends TestCase {

    public function setUp() {
        parent::setUp();
        Artisan::call('db:seed');
    }

    public function testStripsAddNoLogin() {
        $this->client->request('GET', '/strips');
        $this->assertRedirectedToRoute('user.signin');
    }

    public function testStripsAddLogin() {
        Auth::loginUsingId(1);

        $this->client->request('GET', '/strips');
        $this->assertResponseOk();
    }

    public function testEditFirstStripNoLogin() {
        $this->client->request('GET', '/strips/1');
        $this->assertRedirectedTo('login');
    }

    public function testEditFirstStripLogin() {
        Auth::loginUsingId(1);

        $this->client->request('GET', '/strips/1');
        $this->assertResponseOk();
    }
}
