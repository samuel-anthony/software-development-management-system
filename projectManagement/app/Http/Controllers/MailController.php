<?php

namespace App\Http\Controllers;

use \App\Mail\SendMail;
use Illuminate\Http\Request;
use App\project;
class MailController extends Controller
{
    public function mailsend($param){
        $project = project::whereProjId($param)->first();
        $details = [
            'dear'=>'Dear, '.$project->client->cl_name,
            'row1' => 'Here is your advertising report with following components : ',
			'row2' => 'Requirement : '.$project->requirement,
			'row3' => 'Content : '.$project->content,
			'row4' => 'Thank you',
            'image' => $project->media
        ];

        \Mail::to($project->client->cl_email)->send(new SendMail($details));
        return redirect('home')->with(['alert'=>'alertSuccess','message'=>'successfully finish the project']);
    }
}