<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('public/backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('public/backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('public/backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/header-colors.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/assets/css/sweetalert.css')}}">
       
  
    <title>Admin | Fast Driving Test Booking</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('admin.layouts.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('admin.layouts.header')
        <!--end header -->
        <!--start page wrapper -->

        @yield('content')
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2022. All right reserved by Fast Driving Test Booking.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    @include('admin.layouts.switch')
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('public/backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('public/backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/index.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('public/backend/assets/js/app.js') }}"></script>

    <script src="{{ asset('public/backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        // CKEDITOR.replace("summary");
        CKEDITOR.replace("description");
        CKEDITOR.replace("note");
        CKEDITOR.replace("additional");
    </script>

    @yield('js_extra')


    {{-- sweet alert --}}
    <script src="{{ asset('public/backend/assets/js/sweetalert.min.js') }}"></script>  
    <script src="{{ asset('public/backend/assets/js/.min.js') }}"></script>      <script>
        //Delete Alert
        $(document).on("click","#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
            swal({
            title: "Are you sure?",
            text: "Delete for everytime!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Your file is safe!");
            }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
          } );
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel', 'pdf', 'print']
            } );
         
            table.buttons().container()
                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
        } );
    </script>

        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
              'use strict'
    
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.querySelectorAll('.needs-validation')
    
              // Loop over them and prevent submission
              Array.prototype.slice.call(forms)
                .forEach(function (form) {
                  form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                      event.preventDefault()
                      event.stopPropagation()
                    }
    
                    form.classList.add('was-validated')
                  }, false)
                })
            })()
    </script>

    {{-- text to slug --}}
    <script> 
    document.getElementById("textString").addEventListener("input", function () {
      let theSlug = string_to_slug(this.value);
      document.getElementById("textSlug").value = theSlug;
    });

    function string_to_slug(str) {
      str = str.replace(/^\s+|\s+$/g, ""); // trim
      str = str.toLowerCase();

      // remove accents, swap ñ for n, etc
      var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
      var to = "aaaaeeeeiiiioooouuuunc------";
      for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
      }

      str = str
        .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
        .replace(/\s+/g, "-") // collapse whitespace and replace by -
        .replace(/-+/g, "-"); // collapse dashes

      return str;
    }

    </script>
</body>

</html>