<article class="icontext align-items-start">
    
    <span class="icon icon-sm rounded-circle bg-primary-light">
        <i class="text-primary material-icons md-place"></i>
    </span>
    <div class="text">
        <h6 class="mb-1">Password</h6>
        <form wire:submit="save">
            <input type="hidden" wire:model="id" value="{{ $userDetailed }}"> 
            <input style="border:1px solid green !important;" class="form-control" type="text" wire:model="password" placeholder="Change password">
            <button style="width:100% !important; background-color:#3BB77E !important;" class="btn btn-success mt-2 text-center text-white" type="submit">Change</button>
        </form>
        @error('password') <p class="error text-danger">{{ $message }}</p> @enderror
        
         @if (session()->has('success_password'))
        
           <p> {{ session('success_password') }}</p> 
       
        @elseif (session()->has('fail_password'))
        @endif
            
            
    </div>

</article>
