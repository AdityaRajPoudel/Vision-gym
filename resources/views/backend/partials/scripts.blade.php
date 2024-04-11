 <!-- plugins:js -->
 <script src="{{asset('build/assets/backend/vendors/base/vendor.bundle.base.js')}}"></script>

  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src=" {{asset('build/assets/backend/vendors/chart.js/Chart.min.js')}}"></script>
  <script src=" {{asset('build/assets/backend/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src=" {{asset('build/assets/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src=" {{asset('build/assets/backend/js/off-canvas.js')}}"></script>
  <script src=" {{asset('build/assets/backend/js/hoverable-collapse.js')}}"></script>
  <script src=" {{asset('build/assets/backend/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src=" {{asset('build/assets/backend/js/dashboard.js')}}"></script>
  <script src=" {{asset('build/assets/backend/js/data-table.js')}}"></script>
  <script src=" {{asset('build/assets/backend/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('build/assets/backend/js/dataTables.bootstrap4.js')}}"></script>
  <!-- End custom js for this page-->

  <script src="{{asset('build/assets/backend/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <script src="{{ asset('build/assets/backend/js/chart.js') }}"></script>
  <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.js" integrity="sha512-MXWlk6UOVfE/OdjLyby2zlldm3K36O43PyJmAmXfib7wWEUkediNdwRx4rrvM1GtP1yO+sDLCkvXV6o03sQHmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

  <script>
     new DataTable('#DataTable');
  </script>
  <script>
   @if(Session::has('message'))
   toastr.options =
   {
      "closeButton" : true,
      "progressBar" : true
   }
         toastr.success("{{ session('message') }}");
   @endif
 
   @if(Session::has('error'))
   toastr.options =
   {
      "closeButton" : true,
      "progressBar" : true
   }
         toastr.error("{{ session('error') }}");
   @endif
 
   @if(Session::has('info'))
   toastr.options =
   {
      "closeButton" : true,
      "progressBar" : true
   }
         toastr.info("{{ session('info') }}");
   @endif
 
   @if(Session::has('warning'))
   toastr.options =
   {
      "closeButton" : true,
      "progressBar" : true
   }
         toastr.warning("{{ session('warning') }}");
   @endif
 </script>
  @yield('scripts')