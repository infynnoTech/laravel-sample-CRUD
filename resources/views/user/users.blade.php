@extends('layouts.app')
@push('pageTitle')
   Users
@endpush

@push('pagecss')
@endpush()

@section('content')
<div class="page-header-content header-elements-md-inline">
	<div class="page-title d-flex">
		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">User</span> - List</h4>
		<a href="{{route('home')}}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
	</div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
	<div class="d-flex">
		<div class="breadcrumb">
			<a href="{{route('home')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
			<span class="breadcrumb-item active">User List</span>
		</div>
		<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
	</div>
	<div class="header-elements d-none">
		<div class="breadcrumb justify-content-center">
		</div>
	</div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body" style="">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modal_user_add"> Add User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="ques_tbody">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($users) && !empty($users))
                                @foreach($users as $user)
                                    <tr>
                                        <td></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="editUser('{{Crypt::encrypt($user->id)}}')" data-toggle="tooltip" title="View" class="btn btn-sm btn-primary btn-sm-tbl-action"><i class="icon-pencil3"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteRow('{{route('delete_user')}}','{{Crypt::encrypt($user->id)}}','Delete')" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger btn-sm-tbl-action"><i class="icon-trash"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if(isset($users) && !empty($users))
                    {!! $users->render() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_user_add" class="modal show" tabindex="-1">
    <div class="modal-dialog">
        <form autocomplete="off" action="" method="POST" enctype="multipart/form-data" class="form-user" id="user_add">
          {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label for="categories_name" class="col-form-label text-md-right">{{ __('User Name') }}</label>
                        <input id="categories_name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label for="user_email" class="col-form-label text-md-right">{{ __('User Email') }}</label>
                        <input id="user_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  >
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label for="user_password" class="col-form-label text-md-right">{{ __('User Password') }}</label>
                        <input id="user_password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label for="confirm_password" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <input id="confirm_password" type="password" class="form-control{{ $errors->has('passwordAgain') ? ' is-invalid' : '' }}" name="passwordAgain" value="" />
                        @if ($errors->has('passwordAgain'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passwordAgain') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" id="add_user_btn" class="btn bg-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_user_edit" class="modal show" tabindex="-1">
    <div class="modal-dialog">
        <form autocomplete="off" action="{{route('update_user')}}" method="POST" enctype="multipart/form-data" class="form-user" id="user_edit">
          {{ csrf_field() }}
          <input type='hidden' name="user" value="0" id="user_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit user</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label for="edit_name" class="col-form-label text-md-right">{{ __('user Name') }}</label>
                        <input id="edit_name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label for="edit_email" class="col-form-label text-md-right">{{ __('user Email') }}</label>
                        <input id="edit_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label for="edit_password" class="col-form-label text-md-right">{{ __('User Password') }}</label>
                        <input id="edit_password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}"  >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label for="edit_confirm_password" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <input id="edit_confirm_password" type="password" class="form-control{{ $errors->has('passwordAgain') ? ' is-invalid' : '' }}" name="passwordAgain" value="{{ old('passwordAgain') }}"  >
                        @if ($errors->has('passwordAgain'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passwordAgain') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
    @push('pagescript')
    <script type="text/javascript">
        $(function() {

            $(document).on('click','#add_user_btn',function(e){

                e.preventDefault();
                var data = {
                    '_token':'{{csrf_token()}}',
                    'name':$("#categories_name").val(),
                    'email':$("#user_email").val(),
                    'password':$("#user_password").val(),
                    'passwordAgain':$("#confirm_password").val()
                }
                $.ajax({
                    type: "POST",
                    url: '{{ route("add_user") }}',
                    data: data,
                    dataType: 'json',
                    success:function(response){
                        //alert('sss');
                        toastr.success(response.message, "Success !");
                        location. reload(true);
                    },
                    error: function( json )
                    {
                        if(json.status === 422) {
                            var errors = json.responseJSON;
                            $.each(json.responseJSON.errors, function (key, value) {
                            //    console.log(value);
                               toastr.error(value, "Error !");
                            });

                        } else {

                        }
                    }
                });
            });

            @if ($errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('passwordAgain'))
                $('#modal_user_add').modal('show');
            @endif

            function editUser(id){
                if(id != '' && id != 0){
                    $.ajax({
                        type: "POST",
                        url: '{{ route("edit_user") }}',
                        dataType: "json",
                        data: {'_token':'{{csrf_token()}}','val_id':id},
                        success:function(response){
                            if(response.result == 'success'){
                                $('#modal_user_edit').modal('show');
                                $('#edit_name').val(response.name);
                                $('#edit_email').val(response.email);
                                $('#user_id').val(id);

                            }else{
                                toastr.error(response.message, "Error !");
                            }
                        }
                    });
                }
            }
            editUser_data = editUser;
        });
        function editUser(id)
        {
            if(id != '' && id != 0){
                editUser_data(id);
            }
        }
    </script>
    @endpush()
 @stop()
