@extends('layouts.app')
@push('pageTitle')
   Products
@endpush

@push('pagecss')
@endpush

@section('content')
<div class="page-header-content header-elements-md-inline">
	<div class="page-title d-flex">
		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Product</span> - List</h4>
		<a href="{{route('home')}}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
	</div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
	<div class="d-flex">
		<div class="breadcrumb">
			<a href="{{route('home')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
			<span class="breadcrumb-item active">Products List</span>
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
                        <a class="btn btn-primary" href="{{route('add_product')}}"> Add Product</a>
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
                                <th>Category</th>
                                <th>Price</th>
                                <th>Color</th>
                                <th>stock</th>
                                <th>height</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($products) && !empty($products))
                                @foreach($products as $product)
                                    <tr>
                                        <td></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            @if(isset($product->productdetail->color) && !empty( $product->productdetail->color))
                                                {{$color[$product->productdetail->color]}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($product->productdetail->stock) && !empty( $product->productdetail->stock))
                                                {{$product->productdetail->stock}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($product->productdetail->height) && !empty( $product->productdetail->height))
                                                {{$color[$product->productdetail->height]}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit_product',Crypt::encrypt($product->id)) }}" data-toggle="tooltip" title="View" class="btn btn-sm btn-primary btn-sm-tbl-action"><i class="icon-pencil3"></i></a>
                                            <a href="javascript:void(0)" onclick="deleteRow('{{route('delete_product')}}','{{Crypt::encrypt($product->id)}}','Delete')" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger btn-sm-tbl-action"><i class="icon-trash"></i></a>
                                        </td>
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

    @push('pagescript')
    <script type="text/javascript">
        $(function() {
        });
    </script>
    @endpush
 @stop()
