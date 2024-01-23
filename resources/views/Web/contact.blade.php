@extends('Web.Layout.Layout')
<style>
    .input_style{
        border: green 0.5px solid !important;
    }
</style>
@section('content')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Contact
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="row align-items-end mb-50">
                            <div class="col-lg-9 mb-lg-0 mb-md-9 mb-sm-12">
                                <h4 class="mb-20 text-brand">How can help you ?</h4>
                                <h1 class="mb-30">Let us know how we can help you</h1>
                                <p class="mb-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,
                                    luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <section class="container mb-50 d-none d-md-block">
                <div class="border-radius-15 overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.9906800099457!2d79.87868798347361!3d6.77098740278955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae245a839e10c21%3A0x91ba88e04d0a8c1a!2sFrazer%20Ave%20%26%20Moratuwella%20Ln%2C%20Moratuwa%2010400!5e0!3m2!1ssi!2slk!4v1699359633916!5m2!1ssi!2slk"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <div class="row mb-60">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <h4 class="mb-15 text-brand"> <i class="fa-solid fa-map m-1"></i> Address</h4>
                                    197 Kaldemulla Road, moratuwa
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <h4 class="mb-15 text-brand"><i class="fa-solid fa-clock"></i>
                                        Sales Hours</h4>

                                    <abbr title="Phone">Mon-Fri 8.00am to 5.00pm<br />
                                        <abbr title="Email">Saturday 8.00am to 1.30pm<br />
                                            <abbr title="Email">Sunday closed<br />

                                </div>
                                <div class="col-md-4">
                                    <h4 class="mb-15 text-brand"><i class="fa-solid fa-phone m-1"></i>Sales Phone</h4>

                                    <abbr title="Phone"></abbr> <a href="tel:0706585100">0706585100</a> <br />
                                    <abbr title="Phone"></abbr> <a href="tel:0706585101">0706585101</a> <br />
                                    <abbr title="Phone"></abbr><a href="tel:0112607042">0112607042</a> <br />

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="contact-from-area padding-20-row-col">
                                        <h5 class="text-brand mb-10">Contact form</h5>
                                        <h2 class="mb-10">Drop Us a Line</h2>
                                        <p class="text-muted mb-30 font-sm">Your email address will not be published.
                                         </p>
                                       @livewire('contact_us')
                                      
                                    </div>
                                </div>
                                <div class="col-lg-4 pl-50 d-lg-block d-none">
                                  
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
