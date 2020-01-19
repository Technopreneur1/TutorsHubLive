<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;

class ContactsController extends Controller
{

    
    public function get()
    {
        // get all users except the authenticated one
        // $contacts = User::where('id', '!=', auth()->id())->get();
        $messages = Message::where('from', auth()->id())
                        ->orWhere('to', auth()->id())
                        ->select('from', 'to')->distinct()->get();
        $userIds = [];
        foreach($messages as $msg)
        {
            if($msg->from != auth()->id())
            {
                if(!in_array($msg->from, $userIds))
                {
                    array_push($userIds, $msg->from);
                }
            }else{
                if(!in_array($msg->to, $userIds))
                {
                    array_push($userIds, $msg->to);
                }
                
            }
        }
        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();

        $contacts = User::find($userIds);
        // // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });


        return response()->json($contacts);
    }
    
    public function hasConversationWith(Request $request)
    {
        $from = Message::where('from', auth()->id())
                        ->Where('to', $request->id)
                        ->get();
        if(count($from))
        {
            return response()->json(['has' => true]);
        }
        $to = Message::where('to', auth()->id())
                        ->Where('from', $request->id)
                        ->get();
        if(count($to))
        {
            return response()->json(['has' => true]);
        }
        return response()->json(['has' => false]);
    }

    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
