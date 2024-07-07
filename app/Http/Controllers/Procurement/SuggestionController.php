<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use App\User;
use App\procurement\EprSuggestion;




class SuggestionController extends Controller
{

    public function index(Request $request)
    {
        $currentUser = Auth::user()->id;
        if ($request->ajax()) {
        } else {

            // $users = User::where('id', '!=', $currentUser)->get();
            $users = User::get();
            if (Auth::user()->image == '')
                $profile = '/Profilepicture/default.jpg';
            else
                $profile = Auth::user()->image;
            $data = array(
                'type' => $request->type,
                'docId' => $request->id,
                'from' => $currentUser,
            );
            $usersOnChat = EprSuggestion::select('users.*')
                ->leftjoin('users', 'epr_suggestion.to', '=', 'users.id')
                ->where('type', $request->type)
                ->where('doc_id', $request->id)
                ->where('from', $currentUser)
                ->groupBy('users.id')
                ->get();

            $usersOnChat = $usersOnChat->map(function ($value, $key) use ($request, $currentUser) {
                $outArray = array(
                    'id' => $value->id,
                    'image' => $value->image,
                    'name' => $value->name,
                    'designation' => $value->designation,
                    'count_unread' => $this->getUnrededCount($request, $currentUser, $value->id)
                );
                return $outArray;
            });


            return view('procurement.suggestion.list', compact('users', 'data', 'usersOnChat', 'profile'));
        }
    }

    public function getUnrededCount($request, $currentUser, $sender)
    {
        $count = EprSuggestion::leftjoin('users', 'epr_suggestion.to', '=', 'users.id')
            ->where('type', $request->type)
            ->where('doc_id', $request->id)
            ->where('from', $currentUser)
            ->where('users.id', $sender)
            ->where('read_status', 0)
            ->where('responce_status', 1)
            ->count();
        return $count;
    }

    public function getUserDetails(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $ifFound = User::find($id);
            if ($ifFound) {
                $data = array(
                    'status' => '1',
                    'data' => $ifFound
                );
            } else {
                $data = array(
                    'status' => '0',
                );
            }
            echo json_encode($data);
        } else return null;
    }

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
            EprSuggestion::create($data);
            $out = array(
                'status' => 1
            );
            echo json_encode($out);
        } else
            return null;
    }

    public function getSuggestions(Request $request)
    {
        if ($request->ajax()) {
            $currentUser = Auth::user()->id;
            $chat =  EprSuggestion::select('type', 'doc_id', 'from', 'to', 'comment', 'responce_status', 'created_at')
                ->where('type', $request->type)
                ->where('doc_id', $request->doc_id)
                ->where('from', $currentUser)
                ->where('to', $request->to)
                ->orderBy('id', 'asc')
                ->get();
            $data = array(
                'status' => 1,
                'chat' => $chat
            );
            echo json_encode($data);

            EprSuggestion::where('type', $request->type)
                ->where('doc_id', $request->doc_id)
                ->where('from', $currentUser)
                ->where('to', $request->to)
                ->where('responce_status', 1)
                ->update(array('read_status' => 1));
        }
    }
}
