<?php

class ComicModelTest extends TestCase {
    
    public function setUp() {
        parent::setUp();
        
        Comic::unguard();
    }
    
    public function testCreate() {
        
        $this->assertEquals(0, Comic::all()->count());
        
        Comic::create([
            'id' => 1,
            'title' => 'Titre', 
            'author' =>  'Geoffrey BERGERET',
            'description' => 'DESC',
            'authorApproval' => true, 
            'lang_id' => 1
        ]);
        $this->assertEquals(1, Comic::all()->count());        

        Comic::create([
            'id' => 2,
            'title' => 'Comics2', 
            'author' =>  'AMC',
            'description' => 'DESC2',
            'authorApproval' => true,
            'lang_id' => 1
        ]);
        $this->assertEquals(2, Comic::all()->count());
    }
    
    public function testDestroy() {
        
        $this->assertEquals(0, Comic::all()->count());
        
        Comic::create([
            'id' => 1,
            'title' => 'Titre', 
            'author' =>  'Geoffrey BERGERET',
            'description' => 'DESC',
            'authorApproval' => true,
            'lang_id' => 1
        ]);
        $this->assertEquals(1, Comic::all()->count());        

        Comic::create([
            'id' => 2,
            'title' => 'Comics2', 
            'author' =>  'AMC',
            'description' => 'DESC2',
            'authorApproval' => true ,
            'lang_id' => 1
        ]);
        $this->assertEquals(2, Comic::all()->count());
        
        Comic::destroy(3);
        $this->assertEquals(2, Comic::all()->count());
        Comic::destroy(1);
        $this->assertEquals(1, Comic::all()->count());
        Comic::destroy(2);
        $this->assertEquals(0, Comic::all()->count());
    }
    
    
}