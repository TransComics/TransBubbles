<?php

class RoleAccessTest extends TestCase {

    public function setUp() {
        parent::setUp();

        Artisan::call('db:seed');
    }

    public function testPrivate() {

        // As Guest
        $this->client->request('GET', '/private/roles', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('user.signin');

        // As non-superadmin user
        Auth::loginUsingId(3);
        $this->client->request('GET', '/private/roles', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('access.denied');

        // As superadmin user
        Auth::loginUsingId(5);
        $this->client->request('GET', '/private/roles', ['_token' => csrf_token()]);
        $this->assertResponseOk();
    }

    public function testComicPrivateGuest() {
        // As Guest
        $this->client->request('GET', '/comic/3/role', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('user.signin');

        $this->client->request('GET', '/comic/4/role', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('user.signin');
    }

    public function testComicPrivateNonAdmin() {
        // As a non comic admin
        Auth::loginUsingId(4);
        $this->client->request('GET', '/comic/3/role', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('access.denied');

        $this->client->request('GET', '/comic/4/role', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('access.denied');
    }

    public function testComicPrivateComicAdmin() {
        // As a comic admin
        Auth::loginUsingId(2);
        $this->client->request('GET', '/comic/3/role', ['_token' => csrf_token()]);
        $this->assertResponseOk();
        
        Auth::loginUsingId(3);
        $this->client->request('GET', '/comic/4/role', ['_token' => csrf_token()]);
        $this->assertResponseOk();
    }

    public function testComicPrivateSuperAdmin() {
        // As a superadmin
        Auth::loginUsingId(5);
        $this->client->request('GET', '/comic/3/role', ['_token' => csrf_token()]);
        $this->assertResponseOk();

        $this->client->request('GET', '/comic/4/role', ['_token' => csrf_token()]);
        $this->assertResponseOk();
    }

}
