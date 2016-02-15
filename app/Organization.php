<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name'];

    /*public function relationships(){
    	return $this->belongsToMany('App\Relationship')->withTimestamps();
    }*/

    public function owner_relationships(){
    	return $this->hasMany('App\Relationship', 'rel_owner_org_id', 'id');
    }

    public function linked_relationships(){
    	return $this->hasMany('App\Relationship', 'rel_linked_org_id', 'id');
    }

    public function base_relationships(){
    	return $this->hasMany('App\Relationship', 'org_id', 'id');
    }
}
