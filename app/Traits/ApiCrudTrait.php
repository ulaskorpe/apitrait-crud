<?php
	/**
	 * Created by PhpStorm.
	 * User: S.Ahmet BALCI
	 * Date: 23.02.2023
	 * Time: 17:52
	 */

	namespace App\Traits;

	use App\Repository\UserService\UserRepositoryInterface;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\App;
	use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;

    trait ApiCrudTrait

	{

		abstract function model();
		abstract function validationRules($resource_id =0);
		abstract function columns();



        public function index( ): Collection
        {
            return $this->model()::all();
        }
			public function create(Request $request)
			{
			  $validator = 	Validator::make($request->all(), $this->validationRules()) ;
                if ($validator->fails()) {
                    return new ValidationException($validator);
                }

				return $this->model()::create($request->all());

			}

			public function show($resource_id)
			{
				return $this->model()::findOrFail($resource_id);
			}

			public function update(Request $request, $resource_id)
			{
				$resource = $this->model()::find($resource_id);

                if(empty($resource)){
                    return response('not-found',404);
                }else{
                $validator = 	Validator::make($request->all(), $this->validationRules($resource_id)) ;
                if ($validator->fails()) {
                    return new ValidationException($validator);
                }
				 $resource->update($request->all());
                    return $resource;
                }
			}

			public function delete($resource_id)
			{
				$resource = $this->model()::find($resource_id);
                if(empty($resource)){
                    return response('not-found',404);
                }else {
                     $resource->delete();
                    return response('deleted',200);
                }
			}

	}