<?php

namespace App\Http\Controllers\web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AllEmails;
use App\Http\Controllers\Controller;
use App\Models\ContactUsQuery;
use Illuminate\Support\Facades\DB;
use App\Mail\TestEmail;

class emailController extends Controller
{
    public function index(){
        $data = ['message' => 'This is a test'];
        Mail::to('david.bayne.yo@gmail.com')->send(new TestEmail($data));
        return 'Email was sent';
    }
}