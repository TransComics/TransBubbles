
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
        Auth::loginUsingId(1);

        $this->client->request('GET', '/comic/2/edit');
        $this->assertResponseOk();
    }

    public function testComicUpdateFormAsGuest() {
        $this->client->request('GET', '/comic/2/edit');
        $this->assertRedirectedToRoute('user.signin');
    }

    public function testComicsList() {
        $this->client->request('GET', '/comic/');
        $this->assertResponseOk();
    }

}
