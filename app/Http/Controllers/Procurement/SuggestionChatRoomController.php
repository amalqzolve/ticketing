<?php

namespace App\Http\Controllers\Procurement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use App\User;
use App\procurement\EprSuggestion;




class SuggestionChatRoomController extends Controller
{

    public function chatRoom(Request $request)
    {
        $currentUser = Auth::user()->id;
        if ($request->ajax()) {
        } else {
            if (Auth::user()->image == '')
                $profile = '/Profilepicture/default.jpg';
            else
                $profile = Auth::user()->image;
            $chat = EprSuggestion::select('epr_suggestion.*', 'users.name', 'users.image')
                ->leftjoin('users', 'epr_suggestion.from', '=', 'users.id')
                ->where('epr_suggestion.to', $currentUser)
                ->groupBy('epr_suggestion.type')
                ->groupBy('epr_suggestion.doc_id')
                ->groupBy('epr_suggestion.from')
                ->orderBy('epr_suggestion.id', 'desc')
                ->get();

            $chat = $chat->map(function ($value, $key) use ($currentUser) {
                $outArray = array(
                    'image' => $value->image,
                    'name' => $value->name,
                    'type' => $value->type,
                    'doc_id' => $value->doc_id,
                    'from' => $value->from,
                    'designation' => $value->designation,
                    'count_unread' => $this->getUnrededCount($currentUser, $value)
                );
                return $outArray;
            });

            return view('procurement.suggestionChatRoom.chatRoom', compact('chat', 'profile'));
        }
    }

    public function getUnrededCount($currentUser, $value)
    {
        $count = EprSuggestion::where('epr_suggestion.to', $currentUser)
            ->where('epr_suggestion.type', $value->type)
            ->where('epr_suggestion.doc_id', $value->doc_id)
            ->where('epr_suggestion.from', $value->from)
            ->where('read_status', 0)
            ->where('responce_status', 0)
            ->count();
        return $count;
    }

    public function save(Request $request)
    {
        $currentUser = Auth::user()->id;
        if ($request->ajax()) {
            $data = array(
                'type' => $request->type,
                'doc_id' => $request->doc_id,
                'from' => $request->from,
                'to' => Auth::user()->id,
                'comment' => $request->comment,
                'responce_status' => 1
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
                ->where('from', $request->from)
                ->where('to', $currentUser)
                ->orderBy('id', 'asc')
                ->get();
            $data = array(
                'status' => 1,
                'chat' => $chat
            );
            echo json_encode($data);

            EprSuggestion::where('type', $request->type)
                ->where('doc_id', $request->doc_id)
                ->where('from', $request->from)
                ->where('to', $currentUser)
                ->where('responce_status', 0)
                ->update(array('read_status' => 1));
        }
    }
}
