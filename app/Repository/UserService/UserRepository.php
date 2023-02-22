<?php
	/**
	 * Created by PhpStorm.
	 * User: S.Ahmet BALCI
	 * Date: 22.02.2023
	 * Time: 12:35
	 */

	namespace App\Repository\UserService;

	use App\Models\User;
	use App\Repository\Eloquent\BaseRepository as BaseRepositoryAlias;

	class UserRepository extends BaseRepositoryAlias implements UserRepositoryInterface
	{

		protected $model;

		public function __construct(User $model)
		{
			parent::__construct($model);
		}


	}