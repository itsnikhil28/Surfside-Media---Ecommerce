@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
        <div class="mw-930">
            <h2 class="page-title">CONTACT US</h2>
        </div>
    </section>

    <hr class="mt-2 text-secondary " />
    <div class="mb-4 pb-4"></div>

    <section class="contact-us container">
        <div class="mw-930">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="contact-us__form">
                <form name="contact-us-form" class="needs-validation" novalidate="" method="POST"
                    action="{{route('user.contact')}}">
                    @csrf
                    <h3 class="mb-5">Get In Touch</h3>
                    <div class="form-floating my-4">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Name *" required="">
                        <label for="contact_us_name">Name *</label>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-floating my-4">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            placeholder="Phone *" required="">
                        <label for="contact_us_name">Phone *</label>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-floating my-4">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email address *" required="">
                        <label for="contact_us_name">Email address *</label>
                        <span class="text-danger"></span>
                    </div>
                    <div class="my-4">
                        <textarea class="form-control form-control_gray" name="message" placeholder="Your Message"
                            cols="30" rows="8" required=""></textarea>
                        <span class="text-danger"></span>
                    </div>
                    <div class="my-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection