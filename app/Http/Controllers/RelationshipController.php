<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Relationship;
use App\Organization;
use App\Type;

use DB;

use Validator;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class RelationshipController extends Controller
{

    public function findByOrganizationName($name){


        $organization = Organization::where('name', $name)->first();

        if(!$organization){
            return response()->json(['success' => false, 'error' => 'Organization $name not found!']);
        }

        $organization_daughters = $organization->owner_relationships()->join('organizations', 'relationships.rel_linked_org_id','=', 'organizations.id')->get(['organizations.id','organizations.name', DB::raw("'daughter' as calculated_type")]);  

        $organization_parents = $organization->linked_relationships()->join('organizations', 'relationships.rel_owner_org_id','=', 'organizations.id')->get(['organizations.id','organizations.name', DB::raw("'parent' as calculated_type")]);

        $owner_ids = $organization_parents->lists('id')->toArray();

        $organization_sisters = Organization::where('ol.name','<>',$name)->whereIn('organizations.id', $owner_ids)->join('relationships', 'relationships.rel_owner_org_id', '=', 'organizations.id')->join('organizations as ol', 'relationships.rel_linked_org_id', '=', 'ol.id')->get(['ol.id','ol.name', DB::raw("'sister' as calculated_type")]);

        $organizations = $organization_daughters->merge($organization_parents)->merge($organization_sisters)->sortBy('name')->values();

        $page = Input::get('page', 1); 
        $perPage = Input::get('limit', 100);

        $paginator = CustomPaginator::paginate($organizations, $page, $perPage);

        if($page > $paginator->lastPage()){
            return response()->json(['success' => false, 'error' => 'The last page for the current query is '. $paginator->lastPage()]);
        }

    	return response()->json(['success' => true, $paginator]);
    }

    public function create(Request $request){
    	
        $data = $request->except(['api_token']);

        $this->create_nested_organization($data, 0);
        
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function deleteAll(){

        DB::table('relationships')->delete();
        DB::table('organizations')->delete();

        return response()->json(['success' => true, 'message' => 'All organizations and its relationships have been deleted.']);
    }


    private function create_nested_organization(Array $requests, $parent_id)
    {
        //$relationship[];

        $new_id = $parent_id;

        foreach($requests as $key => $value)
        { 
          
            //$relationship = new Relationship;

            if(!is_integer($key) && 
                !is_array($value)){
                $new_organization = Organization::firstOrCreate([$key => $value]);

                $new_id = $new_organization->id;

                if($parent_id != $new_id && $parent_id > 0){
                    $relationship = array();
                    $relationship['rel_owner_org_id'] = $parent_id;
                    $relationship['rel_linked_org_id'] = $new_id;
                    $relationship['type_id'] = Type::find(1)->id;

                    Relationship::firstOrCreate($relationship);
                }

            }
            else{

                $this->create_nested_organization($value, $new_id);
            }
        }    

    }
}
