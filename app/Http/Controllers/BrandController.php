<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Traits\ApiCrudTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ApiCrudTrait;


    private function model()
    {
        return Brand::class;
    }
    private function newModel()
    {
        return new Brand();
    }
    private  function validationRules($resource_id = 0)
    {
        if($resource_id == 0){
            return ['name' => 'required|unique:core_brands'];
        }else{
            return ['name' => 'required|unique:core_brands,name,'.$resource_id];
        }
    }

    private function columns()
    {
        return ['id','name','manufacturer_id'];
    }

    private  function with(){
        return ['manufacturer'];
    }



    public  function hashed(){
        return ['password','remember_token'];
    }
    private function defaults()
    {
        return ['name'=>'xxx'.rand(1000,9999),'manufacturer_id'=>1];
    }

}
