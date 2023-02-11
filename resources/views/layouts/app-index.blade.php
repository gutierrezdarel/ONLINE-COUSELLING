<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{config('app.app_name')}}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('storage/images/favicon.png')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset ('vendor/dist/css/custom_index.css')}}" rel="stylesheet" />
        {{-- <link rel="stylesheet" href="{{ asset('vendor/dist/custom/main-page-custom.css')}}"> --}}
    </head>


    <body id="page-top">    
         
        <!-- Navigation-->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class=""  href="http://www.ub.edu.ph/"><img class="" id="logo" src="{{asset('storage/images/logo.png')}}" alt="responsive-image" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0 ">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item">
                            @auth
                                <a class="nav-link"href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                            @else
                                <a class="nav-link btn btn-sm btn-flat text-light" href="{{ route('login') }}" class="text-sm text-gray-700 underline" style="background-color: #6690b3">Log in</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        @if ($banner)
        <header class="masthead" style="background-image: linear-gradient(to bottom, rgba(13, 14, 14, 0.52), rgba(17, 17, 17, 0.73)),url({{asset('storage/images/'.$banner->image)}});">
            <div class="container">
                @if ($message = Session::get('success'))
                <div class=" bg-success" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        Someone from our admin will reach you out as soonest!
                        <br />
                    </div>
                </div>
                @endif

                <div class="subtitle">{{$banner->body}}</div>
                
            </div>
        </header>
        @endif
        <!-- Services-->
        <section class="page-section bg-light" id="services">
            <div class="container">
                <div class="text-center">
                    @if($serviceTitle)
                    <h2 class="section-heading text-uppercase">{{$serviceTitle->title}}</h2>
                    <h3 class="section-subheading text-dark pt-2">{{$serviceTitle->description}}</h3>
                    @endif
                </div>
                <div class="row text-center">
                    @if($categories)
                    @foreach ($categories as $category)
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x" style="color: #6690b3"></i>
                                <i class="{{$category->icon}} fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">{{$category->category}}</h4>
                            <p class="text-dark pt-2">{{$category->description}}</p>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </section>

        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    @if($about)
                    <h2 class="section-heading text-uppercase">{{$about->title}}</h2>
                    {{-- <h3 class="section-subheading text-muted">{{$about->desc}}</h3> --}}
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="card border-0">
                            <div class="card-body text-center">
                               
                                <h5 class="section-heading text-uppercase pb-2">{{$vision->title}}</h5>
                                <span class="text-dark pt-2">{{$vision->desc}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card border-0">
                            <div class="card-body text-center">
                            
                                <h5 class="section-heading text-uppercase pb-2">{{$mission->title}}</h5>
                                <span class="text-dark pt-2">{{$mission->desc}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body text-center">
                              
                                <h5 class="section-heading text-uppercase pb-2">{{$common->title}}</h5>
                               <span class="text-dark">{{$common->desc}}</span>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Guidance Councelors</h2>
                    <h3 class="section-subheading text-dark">
                        Our counselors help students identify goals and potential solutions to problems which cause emotional turmoil; 
                        seek to improve communication and coping skills; strengthen self-esteem; and promote behavior change and optimal mental health.
                    </h3>
                </div>
                <div class="row">
                    @if($guidances)
                   
                    @foreach ($guidances as $guidance)
                    <div class="col-lg-6">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('storage/images/avatar/'.$guidance->avatar)}}" alt="..." />
                            <h4>{{$guidance->name}}</h4>
                            <p class="text-muted">{{$guidance->getUserPrimaryRole()->role}}</p>
                           
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p class="large text-dark">
                            Counseling is an opportunity to discuss with a qualified and objective person about your key sources of frustration or anguish in a nonjudgmental setting about what you see as the main reasons of frustration or distress. He or she will first listen to how you experience life, then help you consider alternative ways of understanding or viewing situations so you feel more capable of breaking the patterns that are keeping you stuck in your current challenges.
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase pb-5">Contact Us</h2>
                </div>
                <form action="{{route('send.from.external')}}" method="post" id="contactForm">
                    @csrf
                    @method('post')
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" name="name" placeholder="Your Name *" required>
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" name="email" placeholder="Your Email *" required>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <span class="text-danger error-text email_error"></span>
                            </div>

                           <div class="form-group">
                                <!-- Section Input-->
                                <input class="form-control" id="email" type="text" name="section" placeholder="Your Year & Section put N/A if non-student" required>
                                <span class="text-danger error-text"></span>              
                            </div>


                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" name="number" placeholder="Mobile ex: 09123456789" pattern="[0-9]{11}" required>
                                <span class="text-danger error-text number_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" name="message" placeholder="Purpose of the Message*" required></textarea>
                                <span class="text-danger error-text message_error"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            Someone from our admin will reach out to you as soonest!
                            <br />
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-xl text-uppercase" id="submitButton" type="submit" style="background-color: #6690b3;  color:white">Send Message</button></div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Group 10 - SY 2021-2022</div>
                   
                    <div class="col-lg-8 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>

<script>



window.addEventListener('DOMContentLoaded', event => {

// Navbar shrink function
var navbarShrink = function () {
    const navbarCollapsible = document.body.querySelector('#mainNav');
    if (!navbarCollapsible) {
        return;
    }
    if (window.scrollY === 0) {
        navbarCollapsible.classList.remove('navbar-shrink')
    } else {
        navbarCollapsible.classList.add('navbar-shrink')
    }

};

// Shrink the navbar 
navbarShrink();

// Shrink the navbar when page is scrolled
document.addEventListener('scroll', navbarShrink);

// Activate Bootstrap scrollspy on the main nav element
const mainNav = document.body.querySelector('#mainNav');
if (mainNav) {
    new bootstrap.ScrollSpy(document.body, {
        target: '#mainNav',
        offset: 74,
    });
};

// Collapse responsive navbar when toggler is visible
const navbarToggler = document.body.querySelector('.navbar-toggler');
const responsiveNavItems = [].slice.call(
    document.querySelectorAll('#navbarResponsive .nav-link')
);
responsiveNavItems.map(function (responsiveNavItem) {
    responsiveNavItem.addEventListener('click', () => {
        if (window.getComputedStyle(navbarToggler).display !== 'none') {
            navbarToggler.click();
        }
    });
});

});

$(function(){
    $("#contactForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else{
                    $('#submitSuccessMessage').show();
                   
                    //$('#comment-count').text('success');
                   // var url ="{{ route('home') }}";
                    //$(location).attr('href', url);
                }
            }
        }).fail(function(data) {
          
           // $('#comment-success').modal('show');
            //alert(data.statusText + ": " + data.responseText);
        });
    });
});

</script>
