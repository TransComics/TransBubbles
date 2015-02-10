<?php

class ComicViewTest extends TestCase {
    
    public function setUp() {
        parent::setUp();
        
        Artisan::call('db:seed');
    }
    
    public function testComicAddFormAsUser() {
        Auth::loginUsingId(1);
        
        $this->client->request('GET', '/comic/add');
        $this->assertResponseOk();
    }
    
    public function testComicAddFormAsGuest() {
        $this->client->request('GET', '/comic/add');
        $this->assertRedirectedToRoute('user.signin');
    }
    
    public function testComicUpdateFormAsUser() {
        Auth::loginUsingId(1);
        
        $this->client->request('GET', '/comic/update/2');
        $this->assertResponseOk();
    }

    public function testComicUpdateFormAsGuest() {
        $this->client->request('GET', '/comic/update/2');
        $this->assertRedirectedToRoute('user.signin');
    }
}