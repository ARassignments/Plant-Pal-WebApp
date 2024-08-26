@extends('Front.master')

@section('content')
@include('Message.message')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Contact Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Contact Us</p>
                    <h1 class="display-5 mb-5">If You Have Any Query, Please Contact Us</h1>
                    <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    <form method="post" id="ContactForm" name="ContactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                    <span style = "color: red;"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                    <span style = "color: red;"></span>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control"  name="subject" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                    <span style = "color: red;"></span>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" name="message" id="message" style="height: 100px"></textarea>
                                    <label for="message">Message</label>
                                    <span style = "color: red;"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe class="position-relative w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('js')

<script>
$('#ContactForm').submit(function(event) {
    event.preventDefault();
    $('button[type=submit]').prop('disabled', true)
    $.ajax({
        url: ' {{ url("/Send-Contact-Email") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response) {
            $('button[type=submit]').prop('disabled', false)
            if (response['status'] == true) {
                window.location.href = ' {{ route("Front.contact") }} '
                $('#name').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback')
                    .html('')
                $('#subject').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback')
                    .html('')
                $('#email').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback')
                    .html('')
                $('#message').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback')
                    .html('')

            } else {
                var error = response['errors']
                if (error['name']) {
                    $('#name').addClass('is-invalid').siblings('span').addClass('invalid-feedback')
                        .html(error['name'])
                } else {
                    $('#name').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback').html('')
                }

                if (error['subject']) {
                    $('#subject').addClass('is-invalid').siblings('span').addClass('invalid-feedback')
                        .html(error['subject'])
                } else {
                    $('#subject').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback').html('')
                }
                if (error['email']) {
                    $('#email').addClass('is-invalid').siblings('span').addClass('invalid-feedback')
                        .html(error['email'])
                } else {
                    $('#email').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback').html('')
                }
                if (error['message']) {
                    $('#message').addClass('is-invalid').siblings('span').addClass(
                            'invalid-feedback')
                        .html(error['message'])
                } else {
                    $('#message').removeClass('is-invalid').siblings('span').removeClass(
                        'invalid-feedback').html('')
                }

            }
        }
    })
})
</script>
@endsection