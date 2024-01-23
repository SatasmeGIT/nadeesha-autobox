<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;

class ContactUs extends Component
{   #[Validate('required|max:25')]
    public $name;
    #[Validate('required|email|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/')]
    public $email;
    #[Validate('required|numeric|digits:9')]
    public $phone;
    #[Validate('required|max:200')]
    public $subject;
    #[Validate('required|max:1000')]
    public $text;

    public function send(){
     $this->validate();

     $result = \Mail::send('contactForAdmin', [
        'name' => $this->name,
        'email' => $this->email,
        'phone' => $this->phone,
        'subject' => $this->subject,
        'text' => $this->text
    ], function ($message) {
        $message->from('jayathilaka221b@gmail.com', 'your app name');
        $message->to("jayathilaka221b@gmail.com", 'your name')->subject('Contact Mail');
    });


    if ($result) {
        \Mail::send('contactForClient', [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'text' => $this->text
        ], function ($message) {
            $message->from('jayathilaka221b@gmail.com', 'your app name');
            $message->to($this->email, 'your name')->subject('Contact Mail');
        }); // reply message

        $this->reset(); // Reset input fields and validation errors
        session()->flash('success', 'Email sent successfully!');
    } else {
        // Handle failure if needed
        session()->flash('fail', 'Something went wrong!');
    }

    }

    public function render()
    {

        return view('livewire.contact-us');
    }
}