<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use App\User;
use App\Comments;




class CommentsController extends Controller
{


    public function save(Request $request)
    {
        $currentUser = Auth::user()->id;
        if ($request->ajax()) {
            $data = array(
                'type' => $request->type,
                'doc_id' => $request->doc_id,
                'from' => Auth::user()->id,
                'to' => $request->to,
                'comment' => $request->comment
            );
            Comments::create($data);
            $out = array(
                'status' => 1
            );
            echo json_encode($out);
        } else
            return null;
    }

    public function getComments(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id;
            $chat =  Comments::select('comments.comment', 'comments.from', 'comments.created_at', 'users.name', 'users.image')
                ->leftjoin('users', 'comments.from', 'users.id')
                ->where('type', $request->type)
                ->where('doc_id', $request->doc_id)
                ->orderBy('comments.id', 'asc')
                ->get();
            $data = array(
                'status' => 1,
                'chat' => $chat,
                'currentUser' => $currentUser,
                'imgPath' => url('public'),
            );
            echo json_encode($data);
        }
    }
}
