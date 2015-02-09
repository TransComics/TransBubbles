<?php

class ComicViewTest extends TestCase {
    
    public function setUp() {
        parent::setUp();
        Comic::unguard();
    }
    
    public function testComicAddForm() {
        $this->client->request('GET', '/comic/add');
        $this->assertResponseOk();
    }
    
    public function testComicUpdateForm() {
        Comic::create([
            'id' => 2,
            'title' => 'Comics2', 
            'author' =>  'AMC',
            'description' => 'DESC2',
            'authorApproval' => true
        ]);
        
        $this->client->request('GET', '/comic/update/2');
        $this->assertResponseOk();
    }
}
