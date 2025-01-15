<!-- latest jquery-->
<script src="{{ asset('/') }}admin/assets/js/jquery.min.js"></script>
<!-- Bootstrap js-->
<script src="{{ asset('/') }}admin/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="{{ asset('/') }}admin/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{ asset('/') }}admin/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="{{ asset('/') }}admin/assets/js/scrollbar/simplebar.js"></script>
<script src="{{ asset('/') }}admin/assets/js/scrollbar/custom.js"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('/') }}admin/assets/js/config.js"></script>
<!-- sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('/') }}admin/assets/js/custom_js/customnew.js"></script>

<!-- toastr -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    window.csrfToken = "{{ csrf_token() }}";
 </script>

<!-- Plugins JS start-->
<script src="{{ asset('/') }}admin/assets/js/sidebar-menu.js"></script>
<script src="{{ asset('/') }}admin/assets/js/sidebar-pin.js"></script>
<script src="{{ asset('/') }}admin/assets/js/slick/slick.min.js"></script>
<script src="{{ asset('/') }}admin/assets/js/slick/slick.js"></script>
<script src="{{ asset('/') }}admin/assets/js/header-slick.js"></script>
<script src="{{ asset('/') }}admin/assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="{{ asset('/') }}admin/assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="{{ asset('/') }}admin/assets/js/chart/apex-chart/moment.min.js"></script>
<script src="{{ asset('/') }}admin/assets/js/notify/bootstrap-notify.min.js"></script>
<!-- calendar js-->
<script src="{{ asset('/') }}admin/assets/js/dashboard/default.js"></script>
<script src="{{ asset('/') }}admin/assets/js/notify/index.js"></script>
<script src="{{ asset('/') }}admin/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}admin/assets/js/datatable/datatables/datatable.custom.js"></script>
<script src="{{ asset('/') }}admin/assets/js/datatable/datatables/datatable.custom1.js"></script>
<script src="{{ asset('/') }}admin/assets/js/datepicker/date-range-picker/moment.min.js"></script>
<script src="{{ asset('/') }}admin/assets/js/datepicker/date-range-picker/datepicker-range-custom.js"></script>
<script src="{{ asset('/') }}admin/assets/js/typeahead/handlebars.js"></script>
<script src="{{ asset('/') }}admin/assets/js/typeahead/typeahead.bundle.js"></script>
<script src="{{ asset('/') }}admin/assets/js/typeahead/typeahead.custom.js"></script>
<script src="{{ asset('/') }}admin/assets/js/typeahead-search/handlebars.js"></script>
<script src="{{ asset('/') }}admin/assets/js/typeahead-search/typeahead-custom.js"></script>
<script src="{{ asset('/') }}admin/assets/js/height-equal.js"></script>
<script src="{{ asset('/') }}admin/assets/js/animation/wow/wow.min.js"></script>

<!-- calendar js-->

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('/') }}admin/assets/js/script.js"></script>
<script src="{{ asset('/') }}admin/assets/js/theme-customizer/customizer.js"></script>
<!-- Plugin used-->
<script>new WOW().init();</script>


<!-- toastr used-->
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
       case 'info':
       toastr.info(" {{ Session::get('message') }} ");
       break;
   
       case 'success':
       toastr.success(" {{ Session::get('message') }} ");
       break;
   
       case 'warning':
       toastr.warning(" {{ Session::get('message') }} ");
       break;
   
       case 'error':
       toastr.error(" {{ Session::get('message') }} ");
       break; 
    }
    @endif 
   </script>