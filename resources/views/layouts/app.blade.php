<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>
		 @stack('pageTitle')
	</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/global_assets/css/icons/icomoon/styles.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/global_assets/css/icons/fontawesome/css/font-awesome.min.css')!!}" rel="stylesheet" type="text/css">

	<link href="{!!asset('admin/assets/css/bootstrap.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/bootstrap_limitless.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/layout.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/components.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/colors.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/core.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/custom-admin-style.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/global_assets/css/toastr/toastr.min.css')!!}" rel="stylesheet" type="text/css">

	<!-- /global stylesheets -->
 @stack('pagecss')
 	<!-- Core JS files -->
 	<script src="{!!asset('admin/global_assets/js/main/jquery.min.js')!!}"></script>
 	<script src="{!!asset('admin/global_assets/js/main/bootstrap.bundle.min.js')!!}"></script>
 	<script src="{!!asset('admin/global_assets/js/plugins/loaders/blockui.min.js')!!}"></script>
 <!-- /core JS files -->

 <!-- Theme JS files -->
 	<script src="{!!asset('admin/global_assets/js/plugins/visualization/d3/d3.min.js')!!}"></script>
 	<script src="{!!asset('admin/global_assets/js/plugins/visualization/d3/d3_tooltip.js')!!}"></script>
 	<script src="{!!asset('admin/global_assets/js/plugins/ui/moment/moment.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/demo_pages/form_checkboxes_radios.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/notifications/sweet_alert.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/demo_pages/extra_sweetalert.js')!!}"></script>

 	<script src="{!!asset('admin/assets/js/app.js')!!}"></script>
 	<script src="{!!asset('admin/global_assets/js/demo_pages/dashboard.js')!!}"></script>

	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/formValidation.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/form-validator.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/framework/bootstrap.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/toastr/toastr.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/tables/datatables/datatables.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/demo_pages/datatables_responsive.js')!!}"></script>

	<script src="{!!asset('admin/assets/js/custom.js')!!}"></script>

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		@include('includes.header')
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md nav-hide-tablate">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">
				@include('includes.sidebar')
			</div>
			<!-- /page header -->
			<!-- Main content -->
				<!-- Content area -->
					@yield('content')
				<!-- /content area -->
			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				@include('includes.footer')
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/allformsValidation.js')!!}"></script>

	@stack('pagescript')
	<script type="text/javascript">
		$(function(){
			@if ($message = Session::get('success_message'))
				toastr.success("{{$message}}", "Success !");
			@endif
			@if ($message = Session::get('error_message'))
				toastr.error("{{$message}}", "Error !");
			@endif
		});
		$(function() {

            function deleteRow(url,valid,stat){
                var val_id= valid;
                var stat= stat;
                var url= url;
                if( valid != ''){
                    //console.log(valid);
                    swal({
                        title: 'Are you sure?',
                          text: "This row will be "+stat+"!",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonText: 'Yes, '+stat+' it!',
                          cancelButtonText: 'No, cancel!',
                          confirmButtonClass: 'btn btn-success',
                          cancelButtonClass: 'btn btn-danger',
                          buttonsStyling: true
                   }).then(function(isConfirm) {
                        if (isConfirm.value) {
							$.ajax({
		                        type: "POST",
		                        url: url,
		                        dataType: "json",
		                        data: {'_token':'{{csrf_token()}}','val_id':val_id},
		                        success:function(response){
									if(response.result == 'success'){
										toastr.success(response.message, "Success !");
										location. reload(true);
									}else{
										toastr.error(response.message, "Error !");
									}
		                        }
		                    });
                        } else {
                            swal("Cancelled", "Row is not "+stat+"! :)", "error");
                        }
                   })
                }
            }
            deleteRow_data = deleteRow;
        });
        function deleteRow(url,valID,stat)
        {
            if(valID != '' && valID != 0 && url != '' && url != 0){
                deleteRow_data(url,valID,stat);
            }
        }
	</script>
</body>
</html>
