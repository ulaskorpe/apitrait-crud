<?php

namespace App\Http\Controllers;


use App\Models\Country;
use App\Traits\ApiCrudTrait;
use CountryRepository;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    use ApiCrudTrait;


    function model()
    {
        return Country::class;
    }

    function validationRules($resource_id = 0)
    {
        if($resource_id == 0){
            return ['name' => 'required|unique:core_countries', 'iso2' => 'required|unique:core_countries','iso3|unique:core_countries'];
        }else{
            return ['name' => 'required|unique:core_countries,name,'.$resource_id, 'iso2' => 'required|unique:core_countries,iso2,'.$resource_id,'iso3|unique:core_countries,iso3,'.$resource_id];
        }
    }

    function columns()
    {
        return ['id','name','iso2','iso3'];
    }

    function with(){
        return [];
    }
}
