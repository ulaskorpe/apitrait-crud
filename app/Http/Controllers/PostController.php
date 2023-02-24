<?php

namespace App\Http\Controllers;

use App\Repository\PostService\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
	protected PostRepositoryInterface $postRepository;
    public function __construct(PostRepositoryInterface $postRepository){
		$this->postRepository = $postRepository;
    }

	public function index(){
		return $this->postRepository->all();
	}
}
