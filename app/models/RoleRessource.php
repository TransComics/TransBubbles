<?php

class RoleRessource extends Eloquent {
    
    protected $guarded = ['id'];
    protected $table = 'roles_ressources';
    public $timestamps = false;
    
}