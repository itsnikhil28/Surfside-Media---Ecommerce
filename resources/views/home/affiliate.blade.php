@extends('layouts.app')

@section('content')
<main class="pt-90">
    <section class="affiliate-program container">
        <h2 class="page-title text-center mb-5 mt-5">Join Our Affiliate Program</h2>

        <!-- Program Overview Section -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h3 class="text-center mb-4">Earn Money by Promoting Our Products</h3>
                <p class="text-center">
                    Become an affiliate and start earning commissions by promoting our top-rated products! It’s simple,
                    easy, and rewarding. Whether you're a blogger, influencer, or a passionate marketer, our program is
                    perfect for you!
                </p>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-4 mb-4">
                <div class="affiliate-step card shadow-sm p-4 text-center rounded">
                    <i class="fa fa-user-plus fa-3x text-primary mb-3"></i>
                    <h4 class="card-title">Step 1: Sign Up</h4>
                    <p>Register for our affiliate program. It only takes a few minutes! Contact us now</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="affiliate-step card shadow-sm p-4 text-center rounded">
                    <i class="fa fa-share fa-3x text-success mb-3"></i>
                    <h4 class="card-title">Step 2: Promote Products</h4>
                    <p>Get access to banners, links, and promotional material to help you market our products.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="affiliate-step card shadow-sm p-4 text-center rounded">
                    <i class="fa fa-dollar fa-3x text-warning mb-3"></i>
                    <h4 class="card-title">Step 3: Earn Commissions</h4>
                    <p>Earn a commission on every sale made through your affiliate link. Simple as that!</p>
                </div>
            </div>
        </div>

        <!-- Benefits of Joining Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="text-center text-primary mb-4">Why Join Our Affiliate Program?</h3>
                <ul class="list-unstyled text-center">
                    <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i><strong>High
                            Commissions</strong> – Earn up
                        to 20% commission on each sale!</li>
                    <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i><strong>Free to Join</strong> –
                        There are
                        no fees or hidden costs to join our affiliate program.</li>
                    <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i><strong>Access to Marketing
                            Tools</strong>
                        – Get access to banners, links, and exclusive offers to help you succeed.</li>
                    <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i><strong>Timely
                            Payments</strong> – Get paid
                        on time through your preferred payment method.</li>
                </ul>
            </div>
            <div class="col-md-12 mt-5 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <h4 class="text-primary mb-3">Ready to Get Started?</h4>
                    <a href="/contact" class="btn btn-lg btn-primary shadow-lg px-4 py-2 rounded-pill">Contact Us
                        Now</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection