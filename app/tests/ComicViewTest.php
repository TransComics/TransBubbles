
<?php

class ComicViewTest extends TestCase {

    public function setUp() {
        parent::setUp();

        Artisan::call('db:seed');
    }

    public function testComicAddFormAsUser() {
        Auth::loginUsingId(1);

        $this->client->request('GET', '/comic/create');
        $this->assertResponseOk();
    }

    public function testComicAddFormAsGuest() {
        $this->client->request('GET', '/comic/create');
        $this->assertRedirectedToRoute('user.signin');
    }

    public function testComicUpdateFormAsUser() {
        Auth::loginUsingId(3); // Login : Gbt with his own comic

        $this->client->request('GET', '/comic/4/edit');
        $this->assertResponseOk();
    }

    public function testComicUpdateFormAsGuest() {
        $this->client->request('GET', '/comic/3/edit');
        $this->assertRedirectedToRoute('user.signin');
    }

    public function testComicsList() {
        $this->client->request('GET', '/comic/');
        $this->assertResponseOk();
    }

}
