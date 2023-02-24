<?php

	/**
	 * Created by PhpStorm.
	 * User: S.Ahmet BALCI
	 * Date: 24.02.2023
	 * Time: 10:40
	 */

	namespace App\Repository\PostService;

	use App\Models\User;
	use App\Repository\Eloquent\BaseRepository;

	class PostRepository extends BaseRepository implements PostRepositoryInterface
	{

		protected $model;

		public function __construct(User $model)
		{
			parent::__construct($model);
		}
	}