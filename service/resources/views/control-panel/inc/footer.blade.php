<div class="pull-right">

  Powered By : <a href="http://www.samwebstudio.com/"> <strong>Sam Web Studio</strong></a>

</div>

<div class="clearfix"></div>











</div>











<script src="{{ asset('resources/assets/admin/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('resources/assets/admin/build/js/ajax.js') }}"></script>

<script src="{{ asset('resources/assets/admin/build/js/toastr.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/vendors/jquery/dist/jquery.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>

<script src="{{ asset('resources/assets/admin/vendors/datatables.net-scroller/js/datatables.scroller.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/build/js/custom.min.js') }}"></script>

<script src="{{ asset('resources/assets/admin/build/js/choosen/chosen.jquery.js') }}"></script>





<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





<script>
  $(function() {

    $(".datepicker").datepicker({



      dateFormat: 'dd-mm-yy',

      //     changeMonth: true,

      // changeYear: true,

      //     yearRange: '1980:2013',

    });



    $(".datepicker2").datepicker({
      dateFormat: 'dd-mm-yy',
    });

    $(".datepicker3").datepicker({
      dateFormat: 'dd-mm-yy',
      maxDate: 0
    });













  });



  $(function() {

    $('[data-toggle="tooltip"]').tooltip()

  })





  function isNumberKey(evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode

    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;

    return true;

  }





  $(".string").keypress(function(event) {

    var inputValue = event.which;

    // allow letters and whitespaces only.

    if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {

      event.preventDefault();

    }

  });





  $(document).ready(function() {





    <?php if (session()->has('success_msg')) { ?>



      setTimeout(function() {

        $('.alert').hide('slow');

      }, 3000);









    <?php } ?>



    <?php if (session()->has('error_msg') || count($errors) > 0) { ?>



      setTimeout(function() {

        $('.alert').hide('slow');

      }, 3000);



    <?php } ?>





    $("#datatable").DataTable({

      "paging": true,

      "ordering": false,

      "info": false

    });





    var handleDataTableButtons = function() {

      if ($("#datatable-buttons").length) {

        $("#datatable-buttons").DataTable({

          dom: "Bfrtip",

          buttons: [

            {

              extend: "copy",

              className: "btn-sm"

            },

            {

              extend: "csv",

              className: "btn-sm"

            },

            {

              extend: "excel",

              className: "btn-sm"

            },

            {

              extend: "pdfHtml5",

              className: "btn-sm"

            },

            {

              extend: "print",

              className: "btn-sm"

            },

          ],

          responsive: true

        });

      }

    };



    TableManageButtons = function() {

      "use strict";

      return {

        init: function() {

          handleDataTableButtons();

        }

      };

    }();



    $('#datatable').dataTable();



    $('#datatable-keytable').DataTable({

      keys: true

    });



    $('#datatable-responsive').DataTable();



    $('#datatable-scroller').DataTable({

      ajax: "js/datatables/json/scroller-demo.json",

      deferRender: true,

      scrollY: 380,

      scrollCollapse: true,

      scroller: true

    });



    $('#datatable-fixed-header').DataTable({

      fixedHeader: true

    });



    var $datatable = $('#datatable-checkbox');



    $datatable.dataTable({

      'order': [
        [1, 'asc']
      ],

      'columnDefs': [

        {
          orderable: false,
          targets: [0]
        }

      ]

    });

    $datatable.on('draw.dt', function() {

      $('input').iCheck({

        checkboxClass: 'icheckbox_flat-green'

      });

    });



    TableManageButtons.init();











  });









  function deleletconfig() {



    var del = confirm("Are you sure you want to delete this record?");

    if (del == true) {

    } else

    {



    }

    return del;

  }
</script>



<script>
  $("#checkAll").click(function() {

    $('input:checkbox').not(this).prop('checked', this.checked);

  });
</script>




@if(count($errors) > 0)

@foreach($errors -> all() as $error)

<script>
  $.toast({
    heading: 'Error',
    text: '{{ $error }}',
    position: 'top-right',
    loaderBg: '#ff6849',
    icon: 'error',
    hideAfter: 3500

  });
</script>


@endforeach

@endif


@if(session()->has('success_msg'))

<script>
  // toastr.success("{{ session()->get('success_msg') }}");
  $.toast({
    heading: 'Success!',
    text: '{{ session()->get("success_msg") }}',
    position: 'top-right',
    loaderBg: '#ff6849',
    icon: 'success',
    hideAfter: 3500,
    stack: 6
  });
</script>

@endif

@if(session()->has('error_msg'))

<script>
  // toastr.error("{{ session()->get('error_msg') }}");
  $.toast({
    heading: 'Error',
    text: '{{ session()->get("error_msg") }}',
    position: 'top-right',
    loaderBg: '#ff6849',
    icon: 'error',
    hideAfter: 3500

  });
</script>

@endif