<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('resources/assets/img/favicon.ico') }}" type="image/x-icon">

    <title><?php echo ucwords(str_replace("-", " ", Request::segment(2))) . ' | ' . Helper::ProjectName(); ?></title>

    <style>
        #container {
            width: 100%;
            height: 100%;
            top: 0;
            position: absolute;
            visibility: hidden;
            display: none;
            background-color: rgba(22, 22, 22, 0.5);
            /* complimenting your modal colors */
        }

        #container:target {
            visibility: visible;
            display: block;
        }

        .modal {
            position: relative;
            margin: 0 auto;
            top: 25%;
        }

        .table-p thead th,
        .table-p tr td {
            text-align: left !important;
        }
    </style>



    <link href="{{ asset('resources/assets/admin/build/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/admin/build/css/choosen/chosen.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/admin/build/css/toastr.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">



    <!------------------ DASHBOARD STYLE -------------------------->


    @if(Request::segment(2)=='dashboard')


    <!-- Custom Theme files -->
    <link href="{{ asset('resources/assets/admin/dashboard/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!--js-->
    <script src="{{ asset('resources/assets/admin/dashboard/jquery-2.1.1.min.js') }}"></script>

    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
    <!--static chart-->
    <script src="{{ asset('resources/assets/admin/dashboard/Chart.min.js') }}"></script>
    <!--//charts-->
    <!-- geo chart -->
    <script src="{{ asset('resources/assets/admin/dashboard/modernizr.min.js') }}" type="text/javascript"></script>
    <!-- Chartinator  -->
    <script src="{{ asset('resources/assets/admin/dashboard/chartinator.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {

            var chart3 = $('#geoChart').chartinator({
                tableSel: '.geoChart',

                columns: [{
                    role: 'tooltip',
                    type: 'string'
                }],

                colIndexes: [2],

                rows: [
                    ['China - 2015'],
                    ['Colombia - 2015'],
                    ['France - 2015'],
                    ['Italy - 2015'],
                    ['Japan - 2015'],
                    ['Kazakhstan - 2015'],
                    ['Mexico - 2015'],
                    ['Poland - 2015'],
                    ['Russia - 2015'],
                    ['Spain - 2015'],
                    ['Tanzania - 2015'],
                    ['Turkey - 2015']
                ],

                ignoreCol: [2],

                chartType: 'GeoChart',

                chartAspectRatio: 1.5,

                chartZoom: 1.75,

                chartOffset: [-12, 0],

                chartOptions: {

                    width: null,

                    backgroundColor: '#fff',

                    datalessRegionColor: '#F5F5F5',

                    region: 'world',

                    resolution: 'countries',

                    legend: 'none',

                    colorAxis: {

                        colors: ['#679CCA', '#337AB7']
                    },
                    tooltip: {

                        trigger: 'focus',

                        isHtml: true
                    }
                }


            });
        });
    </script>
    <!--geo chart-->

    <!--skycons-icons-->
    <script src="{{ asset('resources/assets/admin/dashboard/skycons.js') }}"></script>

    @endif

    <!---------------------- END DASHBOARD ------------------->





    <style>
        .zoom {
            transition: transform .2s;
            width: 60%;
            margin: 0 auto;
        }

        .zoom:hover {
            -ms-transform: scale(3.0);
            /* IE 9 */
            -webkit-transform: scale(3.0);
            /* Safari 3-8 */
            transform: scale(3.0);
            z-index: 5;
            position: relative;
        }
    </style>

    <script type='text/javascript'>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    <script>
        UPLOADCARE_PUBLIC_KEY = '4193fffd841e248200c2';
    </script>


</head>