@extends('layouts.app')
@push('pageTitle')
   Add Product
@endpush

@push('pagecss')
@endpush

@section('content')
<div class="page-header-content header-elements-md-inline">
	<div class="page-title d-flex">
		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Add</span> - Product</h4>
		<a href="{{route('home')}}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
	</div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
	<div class="d-flex">
		<div class="breadcrumb">
			<a href="{{route('home')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
			<span class="breadcrumb-item active">Add Product</span>
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
        <div class="card-header header-elements-inline">
               <h5 class="card-title">Product Information</h5>
               <div class="header-elements">
                   <div class="list-icons">
                       <a class="list-icons-item" data-action="collapse"></a>
                   </div>
               </div>
           </div>
        <div class="card-body" style="">
            <form autocomplete="off" action="{{route('save_product')}}" method="POST" enctype="multipart/form-data" class="form_admin_usrs" id="form_admin_products_add">
                {{ csrf_field() }}
                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <label for="product_name" class="col-form-label text-md-right">{{ __('Product Name') }}</label>
                            <input id="product_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <label for="category" class="col-form-label text-md-right">{{ __('Select Category') }}</label>
                            <select name="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}">
                                <option value="">Select Category</option>
                                @if(isset($categories) && !empty($categories))
                                    @foreach($categories as $category)
                                        <option {{(old('category') == $category->id) ? 'selected="selected"' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('category'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <div class="form-group has-feedback">
                                <label for="product_price" class="col-form-label text-md-right">{{ __('Product Price') }}</label>
                                <input id="product_price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}"  placeholder="10.5">
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <div class="form-group has-feedback">
                                <label for="product_stock" class="col-form-label text-md-right">{{ __('Product Stock') }}</label>
                                <input id="product_stock" type="text" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" name="stock" value="{{ old('stock') }}"  placeholder="15">
                                @if ($errors->has('stock'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label for="color" class="col-form-label text-md-right">{{ __('Select Color') }}</label>
                            <select name="color" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}">
                                <option value="">Select color</option>
                                @if(isset($color) && !empty($color))
                                    @foreach($color as $k=>$v)
                                        <option {{(old('color') == $k) ? 'selected="selected"' : ''}} value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('color'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label for="weight" class="col-form-label text-md-right">{{ __('Select weight') }}</label>
                            <select name="weight" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}">
                                <option value="">Select weight</option>
                                @if(isset($weight) && !empty($weight))
                                    @foreach($weight as $k=>$v)
                                        <option {{(old('weight') == $k) ? 'selected="selected"' : ''}} value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('weight'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label for="width" class="col-form-label text-md-right">{{ __('Select weight') }}</label>
                            <select name="width" class="form-control{{ $errors->has('width') ? ' is-invalid' : '' }}">
                                <option value="">Select width</option>
                                @if(isset($width) && !empty($width))
                                    @foreach($width as $k=>$v)
                                        <option {{(old('width') == $k) ? 'selected="selected"' : ''}} value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('width'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('width') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label for="height" class="col-form-label text-md-right">{{ __('Select height') }}</label>
                            <select name="height" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}">
                                <option value="">Select height</option>
                                @if(isset($height) && !empty($height))
                                    @foreach($height as $k=>$v)
                                        <option {{(old('height') == $k) ? 'selected="selected"' : ''}} value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('height'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label for="description" class="col-form-label text-md-right">{{ __('Description') }}</label>
                            <textarea rows="5" id="description"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn bg-primary">Save Product</button>
                    </div>
                </div>
            </form>
        </div>
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
                        url: '{!! URL::to("edit_catelgory") !!}',
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
    @endpush
 @stop()
