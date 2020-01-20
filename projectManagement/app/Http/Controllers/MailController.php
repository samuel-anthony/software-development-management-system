<?php

namespace App\Http\Controllers;

use \App\Mail\SendMail;
use Illuminate\Http\Request;
use App\project;
class MailController extends Controller
{
    public function mailsend(){
        $project = project::first();
        $details = [
            'title' => $project->client->cl_name,
            'body' => 'Body: This is for testing email using smtp',
            'image' => $project->media
        ];

        \Mail::to('samuelanthony1696@gmail.com')->send(new SendMail($details));
        return view('home');
    }
}
