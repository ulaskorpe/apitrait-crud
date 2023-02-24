<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository ;

    public function  __construct(\PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;

    }

}
