@extends('layouts.app')
@push('pageTitle')
   Add Product
@endpush

@push('pagecss')
    <link href="{!!asset('admin/assets/css/file-uploader.css')!!}" rel="stylesheet" type="text/css">
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
                                <input id="product_price" type='number' step='0.01' class=" form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}"  placeholder="10.5">
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
                        <div class="form-group">
                            <label for="color" class="col-form-label text-md-right">{{ __('Select Color') }}</label>
                            <select name="color[]" class="form-control multiselect {{ $errors->has('color') ? ' is-invalid' : '' }}" multiple="multiple">
                                @if(isset($color) && !empty($color))
                                @php
                                    $colors_ar = array();
                                    if(old('color')){
                                        $colors_ar = old('color');
                                    }
                                @endphp
                                    @foreach($color as $k=>$v)
                                        <option {{(is_array($colors_ar) && in_array( $k ,$colors_ar)) ? 'selected="selected"' : ''}} value="{{$k}}">{{$v}}</option>
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
                        <p class="text-semibold">Product Images:</p>

                    	<div class="dropzones" >
                            <div class="custom-file-picker">
                                <div class="picture-container form-group">
                                    <h4 class="info_text">Upload Product Images</h4>
                                    <div class="picture">
                                        <span class="icon"><i class="icon-file-upload2" style="font-size: 40px;top: 23px;"></i></span>
                                        <input type="file" name="files[]" class="wizard-file icon-file-upload2" multiple id="a8755cf0-f4d1-6376-ee21-a6defd1e7c08">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 37 37" xml:space="preserve">
                                            <path class="circ path" style="fill:none;stroke:#77d27b;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;" d="M30.5,6.5L30.5,6.5c6.6,6.6,6.6,17.4,0,24l0,0c-6.6,6.6-17.4,6.6-24,0l0,0c-6.6-6.6-6.6-17.4,0-24l0,0C13.1-0.2,23.9-0.2,30.5,6.5z"></path>
                                            <polyline class="tick path" style="fill:none;stroke:#77d27b;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;" points="11.6,20 15.9,24.2 26.4,13.8 "></polyline>
                                        </svg>
                                    </div>
                                </div>
                                <div class="popover-container text-center">
                                    <p data-toggle="popover" data-id="a8755cf0-f4d1-6376-ee21-a6defd1e7c08" class="btn-popover" data-original-title="" title="">
                                        <span class="file-total-viewer">0</span> Files Selected <input type="button" value="view" href="javascript:void(0)" class="btn btn-success btn-xs btn-file-view">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" id="submit-all" class="btn bg-primary">Save Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('pagescript')
    <script src="{!!asset('admin/global_assets/js/imageUploader/imageUploader.js')!!}"></script>
    <script type="text/javascript">
        //Global object to store the files
        $(function(){
            $('[name="price"]').formatter({
                   pattern: '${{999}}.{{99}}'
            });
        });
    </script>
    @endpush
 @stop()
