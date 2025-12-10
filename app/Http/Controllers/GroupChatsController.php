<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupChatsController extends Controller
{
    public function index()
    {
        return view("chats.group_chats");
    }
}
