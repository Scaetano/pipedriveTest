<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = [
       // 'org_id',
        'type_id',
        'rel_owner_org_id',
        'rel_linked_org_id'
    ];

    /*public function organizations(){
    	return $this->belongsToMany('App\Organization')->withTimestamps();
    }*/

    public function owner_organization(){
    	return $this->belongsTo('App\Organization', 'rel_owner_org_id');
    }

    public function linked_organization(){
    	return $this->belongsTo('App\Organization', 'rel_linked_org_id');
    }

    /*public function base_organization(){
    	return $this->belongsTo('App\Organization', 'org_id');
    }*/
}
