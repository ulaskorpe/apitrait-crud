<?php
	/**
	 * Created by PhpStorm.
	 * User: S.Ahmet BALCI
	 * Date: 23.02.2023
	 * Time: 17:52
	 */

	namespace App\Traits;

	use App\Models\User;
    use App\Repository\UserService\UserRepositoryInterface;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;
    use Exception;

    trait ApiCrudTrait

	{

		abstract function model();
		abstract function newModel();
		abstract function validationRules($resource_id =0);
		abstract function columns();
		abstract function with();
		abstract function hashed();
		abstract function defaults();


        public function index(Request $request)
        {



            try {

            $query = $this->model()::select($this->columns());
            if(!empty($this->with())){
                $query->with($this->with());
            }
            $filter = $request->input('filter');

            if(!empty($filter)) {
                if (strlen($filter) >= 3) {
                        $i=0;
                    foreach ($this->columns() as $column){
                        if($column !='id'){
                        if($i==0){
                            $query->where( $column, 'LIKE', "%{$filter}%");
                        }else{
                            $query->orWhere($column, 'LIKE', "%{$filter}%");
                        }
                        $i++;
                        }
                    }
                }
                $sort = $request['sort'];
                if(!empty($sort)) {
                    $split = explode("|", $sort);
                    $query->orderBy($split[0], $split[1]);
                }


            }
            if(!empty($request->input('limit')) ) {
                $data = $query->paginate($request->input('limit'));
            } else {
                $data = $query->get();
            }

            $response = [
                'data' => $data
            ];

            return response($response, 200);

            } catch (Exception $e) {
                return response([
                    'msg' => trans('errors.default'),
                    'srv' => $e->getMessage()
                ], 400);
            }
        }


        private  function valueArray( Request $request) {


            $values = [];
            foreach ( $this->columns() as $item){
                if($item!='id'){

                    $values[$item] =(!empty($request[$item])) ? $request[$item] : ((!empty($this->defaults()[$item]))?$this->defaults()[$item]:'');
                }
            }
            return $values;
        }

        public function create(Request $request)
			{
            try{
			  $validator = 	Validator::make($request->all(), $this->validationRules()) ;
                if ($validator->fails()) {
                    return new ValidationException($validator);
                }
               $model = $this->newModel();
                foreach ($this->columns() as $column){
                if($column!='id'){
                     $model->$column =  (!empty( $request[$column]))? $request[$column] : ((!empty($this->defaults()[$column]))?$this->defaults()[$column]:'');
                }
                }
               $model->save();
                return $model;
              } catch (Exception $e) {
                return response([
                'srv' => $e->getMessage()
                ], 400);
                }
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

			public function forceDelete($resource_id)
			{
				$resource = $this->model()::withTrashed()->find($resource_id);
                if(empty($resource)){
                    return response('not-found',404);
                }else {
                     $resource->forceDelete();
                    return response('deleted',200);
                }
			}

			public function modelname(){
                    return $this->model()  ;
            }

            public function findTrashed(){
                return $this->model()::onlyTrashed()->get();
            }

            public function restoreTrashed($id)
        {
            $this->model()::withTrashed()
                ->where('id','=', $id)
                ->restore();
            return $this->model()::find($id);
        }

	}