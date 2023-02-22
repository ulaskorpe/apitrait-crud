<?php

namespace App\Http\Controllers;

use App\Repository\UserService\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
	private  UserRepositoryInterface $userRepository;

	public function __construct(UserRepositoryInterface $userRepository){
		$this->userRepository = $userRepository;
	}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return response()->json( $this->userRepository->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json( $this->userRepository->create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
