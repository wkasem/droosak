<?php

namespace droosak\Helpers;
use droosak\Conversations;
use droosak\User;
use DB;

class Conversation
{

  protected $user;

  public function __construct($id)
  {

    $this->user = User::where('id' , $id)->first();
    $this->conversations = auth()->user()->conversations()->get() ?? collect([]);
  }

  public static function get($id)
  {
    $i = new static($id);

     if($i->user){
       if($i->already()){

          return $i->data();
        }

        $i->createConversation();
     }

      return $i->data();
    }

    public function already()
    {
      if($this->user->id == auth()->user()->id) return true;

      return $this->conversations->where('other_id' , $this->user->id)->count();
    }

    public function data()
    {

      return [
        $this->conversations ,
        ($this->user) ? $this->user->id : null];
    }

    public function createConversation()
    {

      $data = $this->build();

      DB::table('conversations')->insert($data);

      $this->conversations->push(
         Conversations::hydrate([$data[0]])->load(['messages' , 'otherUser'])->first()
      );

    }


    public function build()
    {

      $conversation_id = str_random(100);

      return [
                [
                  'id' => $conversation_id,
                  'user_id' => auth()->user()->id,
                  'other_id'=> $this->user->id
                ],
                [
                  'id' => $conversation_id,
                  'user_id' => $this->user->id,
                  'other_id'=> auth()->user()->id
                ]
             ];
    }
}
