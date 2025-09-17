<?php

namespace App\Http\Controllers;

use App\Exports\UsersEksport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('users.index');
    }
    public function export()
    {
        return Excel::download(new UsersEksport, 'users.xlsx');
    }
}
