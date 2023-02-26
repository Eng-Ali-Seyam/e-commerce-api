<?php

namespace App\Http\Controllers;

use App\Mail\EmailMailable;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function send(Product $product)
    {
        $users = User::all();
        Mail::to($users)->send(new EmailMailable());
    }
}
