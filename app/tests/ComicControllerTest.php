<?php

class ComicControllerTest extends TestCase {
    
    public function setUp() {
        parent::setUp();
        
        Artisan::call('db:seed');
    }
    
    public function testComicDeleteIdNotFoundAsUser() {
        Auth::loginUsingId(1);
        
        $this->client->request('DELETE', '/comic/delete/100', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('home');
    }
    
    public function testComicDeleteIdNotFoundAsGuest() {
        $this->client->request('DELETE', '/comic/delete/100', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('user.signin');
    }
    
    public function testComicUpdateIdNotFoundAsUser() {
        Auth::loginUsingId(1);
        
        $this->client->request('GET', '/comic/update/100');
        $this->assertRedirectedToRoute('comic.add');
    }

    public function testComicUpdateIdNotFoundAsGuest() {
        $this->client->request('GET', '/comic/update/100');
        $this->assertRedirectedToRoute('user.signin');
    }
}