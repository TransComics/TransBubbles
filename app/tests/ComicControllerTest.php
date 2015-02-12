<?php

class ComicControllerTest extends TestCase {
    
    public function setUp() {
        parent::setUp();
        
        Artisan::call('db:seed');
    }
    
    public function testComicDeleteIdNotFoundAsUser() {
        Auth::loginUsingId(1);
        
        $this->client->request('DELETE', '/comic/100', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('home');
    }
    
    public function testComicDeleteIdNotFoundAsGuest() {
        $this->client->request('DELETE', '/comic/100', ['_token' => csrf_token()]);
        $this->assertRedirectedToRoute('user.signin');
    }
    
    public function testComicUpdateIdNotFoundAsUser() {
        Auth::loginUsingId(1);
        
        $this->client->request('GET', '/comic/100/edit');
        $this->assertRedirectedToRoute('comic.create');
    }

    public function testComicUpdateIdNotFoundAsGuest() {
        $this->client->request('GET', '/comic/100/edit');
        $this->assertRedirectedToRoute('user.signin');
    }
}