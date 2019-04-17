@extends('layouts.app')
@push('pageTitle')
   Categories
@endpush

@push('pagecss')
@endpush()

@section('content')
<div class="page-header-content header-elements-md-inline">
	<div class="page-title d-flex">
		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Category</span> - List</h4>
		<a href="{{route('home')}}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
	</div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
	<div class="d-flex">
		<div class="breadcrumb">
			<a href="{{route('home')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
			<span class="breadcrumb-item active">Category List</span>
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
                        <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modal_category_add"> Add Category</a>
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
                    <table class="table datatable-responsive-column-controlled" id="ques_tbody">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th class="never" ></th>
                        		<th class="never" ></th>
                                <th class="never" ></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($categories) && !empty($categories))
                                @foreach($categories as $category)
                                    <tr>
                                        <td></td>
                                        <td>{{$category->name}}</td>
                                        <td>{{ str_limit($category->description, $limit = 50, $end = '...') }}</td>
                                        <td>{!!$status[$category->status]!!}</td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="editCategory('{{Crypt::encrypt($category->id)}}')" data-toggle="tooltip" title="View" class="btn btn-sm btn-primary btn-sm-tbl-action"><i class="icon-pencil3"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteRow('{{route('delete_catelgory')}}','{{Crypt::encrypt($category->id)}}','Delete')" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger btn-sm-tbl-action"><i class="icon-trash"></i></a>
                                        </td>
                                        <td class="never" ></td>
                                		<td class="never" ></td>
                                        <td class="never" ></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_category_add" class="modal show" tabindex="-1">
    <div class="modal-dialog">
        <form autocomplete="off" action="{{route('add_catelgory')}}" method="POST" enctype="multipart/form-data" class="form-category">
          {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label for="categories_name" class="col-form-label text-md-right">{{ __('Category Name') }}</label>
                        <input id="categories_name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="status" checked="checked" value="1">
                            Enable / Disable
                        </label>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="categories_description" class="col-form-label text-md-right">{{ __('Description') }}</label>
                        <textarea id="categories_description" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('descrip

                                    tion') }}</strong>
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

<div id="modal_category_edit" class="modal show" tabindex="-1">
    <div class="modal-dialog">
        <form autocomplete="off" action="{{route('update_catelgory')}}" method="POST" enctype="multipart/form-data" class="form-category">
          {{ csrf_field() }}
          <input type='hidden' name="category" value="0" id="category_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label for="edit_name" class="col-form-label text-md-right">{{ __('Category Name') }}</label>
                        <input id="edit_name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="status_edit" checked name="status"  value="1">
                            Enable / Disable
                        </label>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="categories_description" class="col-form-label text-md-right">{{ __('Description') }}</label>
                        <textarea id="description_edit"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
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
            @if ($errors->has('name'))
                $('#modal_category_add').modal('show');
            @endif

            function editCategory(id){
                if(id != '' && id != 0){
                    $.ajax({
                        type: "POST",
                        url: '{{ route("edit_catelgory") }}',
                        dataType: "json",
                        data: {'_token':'{{csrf_token()}}','val_id':id},
                        success:function(response){
                            if(response.result == 'success'){
                                $('#modal_category_edit').modal('show');
                                $('#edit_name').val(response.name);
                                $('#category_id').val(id);
                                $('#description_edit').val(response.description);
                                if(response.status != '' && response.status == '1'){
                                    $('#status_edit').prop('checked',true);
                                }else{
                                    $('#status_edit').prop('checked',false);
                                }
                            }else{
                                toastr.error(response.message, "Error !");
                            }
                        }
                    });
                }
            }
            editCategory_data = editCategory;
        });
        function editCategory(id)
        {
            if(id != '' && id != 0){
                editCategory_data(id);
            }
        }
    </script>
    @endpush()
 @stop()
