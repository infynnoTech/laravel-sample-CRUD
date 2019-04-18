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

    <script type="text/javascript">
        //Global object to store the files
        $(function(){
            $(document).on('click','#submit-all',function(e){
                // alert('ss');
                // e.preventDefault()
            });
        });
        let fileStorage = {};

        $(document).ready(function(){
            //Handle the file change
            $("input[type='file']").change(function(e){
                //Get the id
                let id = e.target.id;

                //Get the files
                let files = e.target.files;

                //Store the file
                storeFile(id, files);

                //Show the complete icon
                $(this).siblings('.icon').hide();
                $(this).parent().removeClass('drawn');
                setTimeout(() => {
                    $(this).parent().addClass('drawn');
                }, 50);
            });

            //Store the file for particular filepicker
            let storeFile = (id, files) => {
                fileStorage[id] = files;

                //Update the file count
                $(`[data-id="${id}"] > .file-total-viewer`).text(files.length);
            }

            //Show file list
            $('[data-toggle="popover"]').popover({
                html: true,
                title: "Files",
                placement:"bottom",
                content: function () {
                    //Get the id of the file picker
                    let id = $(this).attr('data-id');

                    //Get all the files of this filepicker
                    let items = fileStorage[id];

                    //Preview the file
                    let template = '<div class="row">';
                    if(items && items.length){
                        for(let val of items){
                            template += "<div class='col-12 pb10'><span class='popover-content-file-name'>" + val.name + "</span><span class='popover-content-remove' data-target='" + id + "' data-name='" + val.name + "' data-type='upload'><i class='fas fa-trash'></i></span></div>"
                        }
                    }else{
                        template += "<div class='col-12 pb10'><span class='popover-content'>No file</span></div>";
                    }

                    template += '</div>';
                    return template;
                }
            });

            //Prevent multiple popover
            $('body').on('click', function (e) {
                $('[data-toggle="popover"],[data-original-title]').each(function () {
                   //the 'is' for buttons that trigger popups
                   //the 'has' for icons within a button that triggers a popup
                   if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                        (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false;  // fix for BS 3.3.6
                   }
                });
            });

            //Delete files
            $(document).on('click', '.popover-content-remove', function (e) {
                //Get the id whose file to delete
                let id = $(this).attr('data-target');

                //Get the name of the file to delete
                let name = $(this).attr('data-name');

                //Confirm delete
                let isDelete = confirm("Do you really want to delete this file?");

                //If confirmed
                if (isDelete) {
                 //Remove the requested file
                 let files = Object.values(fileStorage[id]);
                 let newArr = files.filter((e) => { return e.name !== name; });

                 //Update the list
                 storeFile(id, newArr);

                  //If there is no file then show No file
                  if(newArr.length === 0){
                        $(this).parent().parent().append("<div class='col-12 pb10'><span class='popover-content'>No file</span></div>");
                   }

                   //Remove the current file
                   $(this).parent().remove();
                }
            });
        });

    </script>
    @endpush
 @stop()
