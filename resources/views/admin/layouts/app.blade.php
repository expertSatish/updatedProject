
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('admin/css/bracket.css')}}">
    {{-- <link href="{{asset('admin/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css" integrity="sha512-JApjWRnfonFeGBY7t4yq8SWr1A6xVYEJgO/UMIYONxaR3C9GETKUg0LharbJncEzJF5Nmiv+Pr5QNulr81LjGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{asset('admin/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <script>

      const XCSRF_Token = "{{ csrf_token() }}";
      const EditorImageUpload = @json(route('admin.editorimage'));
    </script>

    @stack('css')

    <style>.error{color:#f97d7d!important;font-size:13px;font-weight:500;}
    .form-check-input:checked{background-color:#343a40;border-color:#343a40;}
    body{font-size:15px!important}
    a{text-decoration:none!important}
    .offcanvas{width:500px!important;}
    .defaultimgcss {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 5px;
      width: 150px;
    }

    /* .offcanvas-backdrop:last-child{z-index:-999999999!important;opacity:0;} */
    </style>
  </head>



  <body>

    <div class="br-logo text-center"><a href="#"><img src="{{asset('frontend/image/logo.svg')}}" class="w-100"></a></div>

    <x-admin.left-panel/>

    <x-admin.head-panel/>
    
    @yield('content')

    <script src="{{asset('admin/lib/jquery/jquery.js')}}"></script>

    <script src="{{asset('admin/lib/popper.js/popper.js')}}"></script>

    <script src="{{asset('admin/lib/bootstrap/bootstrap.js')}}"></script>

    <script src="{{asset('admin/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>

    <script src="{{asset('admin/lib/moment/moment.js')}}"></script>

    <script src="{{asset('admin/lib/jquery-ui/jquery-ui.js')}}"></script>

    <script src="{{asset('admin/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>

    <script src="{{asset('admin/lib/peity/jquery.peity.js')}}"></script>

    @stack('js')
    <link rel="preload" as="style" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" onload="this.rel='stylesheet'" crossorigin="anonymous"/>
    <script src="{{asset('admin/js/bracket.js')}}"></script>
    <script src="{{asset('admin/js/editor.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- CSS only -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <div class="offcanvas offcanvas-end" data-bs-backdrop="false" id="editmodal" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel"> </h5>
        <button type="button" class="btn-close" onclick="window.location.reload();" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        
      </div>
    </div>
    <script>
    $(document).ready(function() {
        toastr.options =
          {
          "closeButton" : true,
          "progressBar" : true,
          "positionClass" : "toast-top-center"
          }
        @if(Session::has('success'))
          toastr.success("{{ session('success') }}");
        @endif
        
        @if(Session::has('error'))
          toastr.error("{{ session('error') }}");
        @endif
    }); 
      setTimeout(function(){

        $('.alert').fadeOut();

      },5000);

      $("#checkall").change(function () {
          $(".listcheck").prop('checked', $(this).prop("checked"));
      });

    </script>
  </body>
</html>