<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title> Admin | login</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/global_assets/css/icons/icomoon/styles.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/bootstrap.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/bootstrap_limitless.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/layout.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/components.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/colors.min.css')!!}" rel="stylesheet" type="text/css">
	<link href="{!!asset('admin/assets/css/custom-admin-style.css')!!}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{!!asset('admin/global_assets/js/main/jquery.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/main/bootstrap.bundle.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/loaders/blockui.min.js')!!}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{!!asset('admin/global_assets/js/plugins/visualization/d3/d3.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/visualization/d3/d3_tooltip.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/forms/styling/switchery.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/ui/moment/moment.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/pickers/daterangepicker.js')!!}"></script>

	<script src="{!!asset('admin/assets/js/app.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/demo_pages/dashboard.js')!!}"></script>

	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/formValidation.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/form-validator.min.js')!!}"></script>
	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/framework/bootstrap.js')!!}"></script>
	<!-- /theme JS files -->

</head>

<body style="    background: #f7f7f7;">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->

			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->

				<form  action="{{ route('login') }}" method="post" class="login-form">
					@csrf
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>

								 <h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Your credentials</span>
							</div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                    <div class="col-md-12">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>


						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	<script src="{!!asset('admin/global_assets/js/plugins/formvalidation/allformsValidation.js')!!}"></script>
</body>

</html>
