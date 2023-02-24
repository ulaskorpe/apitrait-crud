<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiCrudTrait;
use Illuminate\Http\Request;
use PHPUnit\Metadata\PostCondition;

class UsController extends Controller
{
	use ApiCrudTrait;


	function model()
	{
		return User::class;
	}

	function validationRules($resource_id = 0)
	{
		return ['title' => 'required', 'content' => 'required'];
	}

	function columns(array $columns)
	{
		return ['id','name'];
	}
}
