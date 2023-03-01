<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiCrudTrait;
use Illuminate\Http\Request;
use PHPUnit\Metadata\PostCondition;

class UsController extends Controller
{
	use ApiCrudTrait;


	public function model()
	{
		return User::class;
	}


    public function newModel(){
	    return new User();
    }



    private  function validationRules($resource_id = 0)
    {
        $role_array = Role::pluck('id')->toArray();
        $roles = implode(',',$role_array);
        $deal_array = Deal::pluck('id')->toArray();
        $deals = implode(",",$deal_array);


        if($resource_id == 0){
            return ['firstname' => 'required','lastname'=>'required','role_id'=>'in:'.$roles,'nickname'=>'required|unique:core_users',
                'email'=>'required|email|unique:core_users','password'=>'required|min:6','privacy'=>'in:1,0','newsletter'=>'in:1,0',
                'deal_type'=>'in:orders,sales','core_deal_id'=>'in:'.$deals,'force_core_deal_id'=>'in:'.$deals,'invoice_receiver'=>'in:1,0'
                ];
        }else{



            return ['name' => 'required|unique:core_brands,name,'.$resource_id];
        }
    }

	public function columns()
	{
		return ['id','firstname','lastname','nickname','role_id','email','phone'
            ,'password','privacy','newsletter','deal_type','deal_value','core_deal_id','force_core_deal_id','invoice_receiver','intern','remember_token'];
	}

    public  function hashed(){
	    return ['password','remember_token'];
    }

    public  function with(){
        return ['products','brands'];
    }

    public  function defaults(){
        return ['firstname' => 'guest','lastname'=>'guest','role_id'=>1,
            'email'=>'guest'.rand(10000,211222).'@xx.com','password'=>'123123','privacy'=>true,'newsletter'=>true,'deal_value'=>1000,'intern'=>true,
            'deal_type'=>'orders','core_deal_id'=>1,'force_core_deal_id'=>1,'invoice_receiver'=>1,'remember_token'=>rand(1000,99999)
        ];
    }



}
