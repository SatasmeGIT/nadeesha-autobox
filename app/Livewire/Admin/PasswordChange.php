<?php

namespace App\Livewire\Admin;
use Livewire\Attributes\Validate;
use DB;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class PasswordChange extends Component
{
    #[Validate('required|min:4')]
    public $password;
    public $userDetailed;
    
    public function save()
    {
       $this->validate(); 
    
      $result = DB::table('users')
    ->where('id', $this->userDetailed)
    ->update([
        'password' => Hash::make($this->password),
    ]);
    
     if($result){
       $this->reset(); // Reset input fields and validation errors
        session()->flash('success_password', 'Password changed'); 
    }
    else{
       session()->flash('fail_password', 'Something went wrong!'); 
    }
    

    } 
    
    
    public function render()
    {
        return view('livewire.admin.password-change');
    }
}
