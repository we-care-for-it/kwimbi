<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Task;
use App\Models\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;


class Tasks extends Component
{

    public $todo_text; 
    public $tasks;
    public $deleteId;
    public $task;
    
    public function render()


    
    {


  

        $this->tasks =  Task::where('user_id', Auth::id())->orderby('id', 'desc')->get();
        return view('livewire.user.tasks');
    }










 

public function closeTask($id)
{
 
    $this->task = Task::find($id);
    $this->task->delete();
    
    pnotify()->addWarning('Taak voltooid');
 
}

 




 
public function save(){
   

    $data = Task::Create([        
     
            'todo_text'    => $this->todo_text,
            'user_id'     =>  Auth::id()
            
    ]

    );
 
 $this->todo_text = NULL;
 
    pnotify()->addWarning('Taak opgeslagen');
   // return redirect()->to('/system/users');

}


    
}

 
 