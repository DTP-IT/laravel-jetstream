<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->userRepository->getAll();
        $roles = $this->userRepository->getAllRole();

        return view('pages.users.list-users')->with(compact('data', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.add-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();   
        
        $userDetails = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created_at'
        ];
        $this->userRepository->store($userDetails);

        return redirect()->route('user.create')->with('message', 'Create user success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->userRepository->getAllRole();
        return view('pages.users.update-user')->with(compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $userDetails = [
            'name' => $data['name'],
            'email' => $data['email'],
            'updated_at'
        ];
        $this->userRepository->update($userDetails, $user->id);
        $this->userRepository->insertRole($user, $data['role']);
        
        return redirect()->route('user.index')->with('message', 'Update user success');
    }

    /**
     * Display a listing of the resource with search character.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->has('key')) {
            $data = $this->userRepository->searchUser($request['key']);
        } else {
            $data = $this->userRepository->getAll();
        }
        
        return  view('pages.users.list-users')->with(compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission() 
    {
        $dataPermission = $this->userRepository->getAllPermission();
        $dataRole = $this->userRepository->getAllRole();

        return view('pages.permission')->with(compact('dataPermission', 'dataRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertPermission(Request $request)
    {  
        $this->userRepository->insertPermission($request['id'], $request['permission']);
        
        return redirect()->route('user.permission')->with('message', 'Insert Permission success!');
    }
}
