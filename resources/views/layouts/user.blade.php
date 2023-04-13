<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boutique | Ecommerce bootstrap template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- gLightbox gallery-->
    <link rel="stylesheet" href="{{ asset ('userpanel/vendor/glightbox/css/glightbox.min.css')}}">
    <!-- Range slider-->
    <link rel="stylesheet" href="{{ asset ('userpanel/vendor/nouislider/nouislider.min.css')}}">
    <!-- Choices CSS-->
    <link rel="stylesheet" href="{{ asset ('userpanel/vendor/choices.js/public/assets/styles/choices.min.css')}}">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="{{ asset ('userpanel/vendor/swiper/swiper-bundle.min.css')}}">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset ('userpanel/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset ('userpanel/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset ('userpanel/img/favicon.png')}}">
  </head>
  <body>
    <div class="page-holder">
      <!-- navbar-->
      <header class="header bg-white">
        <div class="container px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="#"><span class="fw-bold text-uppercase text-dark">Boutique</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{ request()->IS('index') ? 'active' : '' }}" href="{{route('index')}}">Home</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{ request()->IS('shop') ? 'active' : '' }}" href="{{route('shop')}}">Shop</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{ request()->IS('aboutUs') ? 'active' : '' }}" href="{{route('aboutUs')}}">About Us</a>
                </li>
                
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{ request()->IS('contactUs') ? 'active' : '' }}" href="{{route('contactUs')}}">Contact Us</a>
                </li>
               
                @if(Auth::check())
                @if (Auth::user()->role_id == 0)
                  
                @else
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{ request()->IS('orderstatuspage') ? 'active' : '' }}" href="{{route('orderstatuspage')}}">Check Order Status</a>
                </li>
                @endif
                @else
                <li class="nav-item">
                  <!-- Link--><a class="nav-link {{ request()->IS('orderstatuspage') ? 'active' : '' }}" href="{{route('orderstatuspage')}}">Check Order Status</a>
                </li>
                @endif
              </ul>
              <ul class="navbar-nav ms-auto">   
                
                @if(Auth::check())
                @if (Auth::user()->role_id == 0)
                  
                @else
                <li class="nav-item"><a class="nav-link {{ request()->IS('cartShow') ? 'active' : '' }}" href="{{route('cartShow')}}"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Cart<small class="text-gray fw-normal">({{\Gloudemans\Shoppingcart\Facades\Cart::content()->count()}})</small></a></li>
              
                @endif
                @else
                <li class="nav-item"><a class="nav-link {{ request()->IS('cartShow') ? 'active' : '' }}" href="{{route('cartShow')}}"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Cart<small class="text-gray fw-normal">({{\Gloudemans\Shoppingcart\Facades\Cart::content()->count()}})</small></a></li>
              
                @endif
                @if(Auth::user())
                <li class="nav-item"><a class="nav-link {{ request()->IS('myorders') ? 'active' : '' }}"  @if(Auth::user()->role_id == 0) title="My Admin Profile" href="{{route('home')}}" @else title="My Orders" href="{{route('myorders',Auth::user()->id)}}" @endif> <i class="fas fa-user me-1 text-gray fw-normal"></i><?php echo Auth::user()->name; ?></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->IS('logout') ? 'active' : '' }}" href="{{route('logout')}}"> <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
               
                @else
              <li class="nav-item"><a class="nav-link {{ request()->IS('login') ? 'active' : '' }}" href="{{route('login')}}"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Login</a></li>
             
              @endif
            </ul>
            </div>
          </nav>
        </div>
      </header>
      <!--  Modal -->
      @yield('content')
      <footer class="bg-dark text-white">
        <div class="container py-4">
          <div class="row py-5">
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Customer services</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#!">Help &amp; Contact Us</a></li>
                <li><a class="footer-link" href="#!">Returns &amp; Refunds</a></li>
                <li><a class="footer-link" href="#!">Online Stores</a></li>
                <li><a class="footer-link" href="#!">Terms &amp; Conditions</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Company</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#!">What We Do</a></li>
                <li><a class="footer-link" href="#!">Available Services</a></li>
                <li><a class="footer-link" href="#!">Latest Posts</a></li>
                <li><a class="footer-link" href="#!">FAQs</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h6 class="text-uppercase mb-3">Social media</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#!">Twitter</a></li>
                <li><a class="footer-link" href="#!">Instagram</a></li>
                <li><a class="footer-link" href="#!">Tumblr</a></li>
                <li><a class="footer-link" href="#!">Pinterest</a></li>
              </ul>
            </div>
          </div>
          <div class="border-top pt-4" style="border-color: #1d1d1d !important">
            <div class="row">
              <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">&copy; 2021 All rights reserved.</p>
              </div>
              <div class="col-md-6 text-center text-md-end">
                <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstrapious.com/p/boutique-bootstrap-e-commerce-template">Bootstrapious</a></p>
                <!-- If you want to remove the backlink, please purchase the Attribution-Free License. See details in readme.txt or license.txt. Thanks!-->
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="{{ asset ('userpanel/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset ('userpanel/vendor/glightbox/js/glightbox.min.js')}}"></script>
      <script src="{{ asset ('userpanel/vendor/nouislider/nouislider.min.js')}}"></script>
      <script src="{{ asset ('userpanel/vendor/swiper/swiper-bundle.min.js')}}"></script>
      <script src="{{ asset ('userpanel/vendor/choices.js/public/assets/scripts/choices.min.js')}}"></script>
      <script src="{{ asset ('userpanel/js/front.js')}}"></script>
      
      <script>
        
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
      </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>