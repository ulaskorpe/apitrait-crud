<?php
	/**
	 * Created by PhpStorm.
	 * User: S.Ahmet BALCI
	 * Date: 22.02.2023
	 * Time: 11:46
	 */

	namespace App\Repository;

	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Database\Eloquent\Model;


	interface EloquentRepositoryInterface
	{
		/**
		 * Get all models.
		 *
		 * @param array $column
		 * @param array $relations
		 * @return Collection
		 */
		public function all(array $column = ['*'], array $relations =[]):Collection;

		/**
		 * @return Collection
		 */
		public function allTrashed():Collection;

		/**
		 * @param int $modelId
		 * @param array $columns
		 * @param array $relations
		 * @param array $appends
		 * @return Model|null
		 */
		public function findById(
			int $modelId,
			array $columns =['*'],
			array $relations =[],
			array $appends =[]
		): ?Model;

		/**
		 * @param int $modelId
		 * @return Model|null
		 */
		public function findTrashedById(int $modelId):?Model;

		/**
		 * @param int $modelId
		 * @return Model|null
		 */
		public function findOnlyTrashedById(int $modelId):?Model;

		/**
		 * @param array $payload
		 * @return Model|null
		 */
		public function create(array $payload):?Model;

		/**
		 * @param int $modelId
		 * @param array $payload
		 * @return bool
		 */
		public function update(int $modelId, array $payload):bool;

		/**
		 * @param int $modelId
		 * @return bool
		 */
		public function deleteById(int $modelId):bool;

		/**
		 * @param int $modelId
		 * @return bool
		 */
		public function restoreById(int $modelId):bool;

		/**
		 * @param int $modelId
		 * @return bool
		 */
		public function permanentlyDeleteById(int $modelId):bool;

	}