<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CustomPaginator
{
	public static function paginate($collection, $page, $perPage){

		$offset = ($page * $perPage) - $perPage;

        $paginator = new LengthAwarePaginator($collection->slice($offset, $perPage), $collection->count(), $perPage, Paginator::resolveCurrentPage(), ['path' => Paginator::resolveCurrentPath()]);

        return $paginator;


	}	
} 