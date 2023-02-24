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

	trait ApiCrudTrait

	{

		abstract function model();

		abstract function validationRules($resource_id =0);
		abstract function columns();


		/*
			public function index(array $columns = ['*'], array $relations = [])
			{
				return $this->model()::all();
			}
			*/

			public function index(array $columns = ['*'], array $relations = []): Collection
			{
				return $this->model()::with($relations)->select($this->columns())->get();
			}

			public function create(Request $request)
			{
				Validator::make($request->all(), $this->validationRules())->validate();

				return $this->model()::create($request->all());
			}

			public function show($resource_id)
			{
				return $this->model()::findOrFail($resource_id);
			}

			public function update(Request $request, $resource_id)
			{
				$resource = $this->model()::findOrFail($resource_id);

				Validator::make($request->all(), $this->validationRules($resource_id))->validate();

				return $resource->update($request->all());
			}

			public function delete($resource_id)
			{
				$resource = $this->model()::findOrFail($resource_id);

				return $resource->delete();
			}

	}