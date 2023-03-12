
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/select2/css/select2.min.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />
    {{-- <style>
       [data-tab-info] {
            display: none;
        }
          
        .active[data-tab-info] {
            display: block;
        }
          
        .tab-content {
            font-size: 30px;
            font-family: sans-serif;
            font-weight: bold;
            color: rgb(82, 75, 75);
        }
          
        .tabs {
            font-size: 1rem;
            color: rgb(255, 255, 255);
            display: flex;
            margin: 0;
        }
          
        .tabs span {
            /* background: rgb(28, 145, 38); */
            padding: 10px;
            border: 1px solid rgb(255, 255, 255);
        }
          
        .tabs span:hover {
            background: rgb(29, 185, 112);
            cursor: pointer;
            color: black;
        }
    </style> --}}
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                @yield('content')
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    <script src="{{asset('js/settings.js')}}"></script>
    <script src="{{asset('js/todolist.js')}}"></script>
    <script src="{{asset('plugin/select2/js/select2.full.min.js')}}"></script>
    <!-- endinject -->
    <script type="text/javascript">
      const tabs = document.querySelectorAll('[data-tab-value]')
      const tabInfos = document.querySelectorAll('[data-tab-info]')

      tabs.forEach(tab => {
          tab.addEventListener('click', () => {
              const target = document
                  .querySelector(tab.dataset.tabValue);

              tabInfos.forEach(tabInfo => {
                  tabInfo.classList.remove('active')
              })
              target.classList.add('active');
          })
      })
    </script>

  </body>
</html>