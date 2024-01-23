<div>
   <div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session()->has('fail'))
    @endif
    <form wire:submit="send" class="contact-form-style mt-30">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                    <input wire:model.live="name" class="input_style" placeholder="First Name" type="text" />
                    @error('name')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                    <input wire:model.live="email" class="input_style" placeholder="Your Email" type="email" />
                    @error('email')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6">

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div style="height: 65px !important;" class="input-group-text input_style">
                            +94
                        </div>
                    </div>
                    <input wire:model.live="phone" style="height: 65px !important;" type="text"
                        class="form-control input_style" id="inlineFormInputGroup" placeholder="Enter Phone ">
                </div>
                @error('phone')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="input-style mb-20">
                    <input wire:model.live="subject" class="input_style" placeholder="Subject" type="text" />
                    @error('subject')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="col-lg-12 col-md-12">
                <div class="textarea-style mb-30">
                    <textarea wire:model.live="text" class="input_style" placeholder="Message"></textarea>
                    @error('text')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button class="submit submit-auto-width" type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Send message</span>
                    <span wire:loading>Loading...</span>
                </button>

            </div>

        </div>
    </form>
</div>

</div>
