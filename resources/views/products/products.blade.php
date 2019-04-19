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
                <div class="col-md-12" id="tag_container">
                    @include('products.product_table')
                </div>
            </div>
        </div>
    </div>
</div>

    @push('pagescript')
    <script type="text/javascript">
        //if there has been changes to the anchor part (begins with a '#' symbol) of the current URL.
        $(window).on('hashchange', function() {
            // returns the anchor part of a URL, including the hash sign (#)
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);
                }
            }
        });

        $(document).ready(function()
        {
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                // set active class to  pagination navigatin link
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var myurl = $(this).attr('href');
                //get page number from navigatin URL
                var page=$(this).attr('href').split('page=')[1];

                getData(page);
            });

        });

        function getData(page){
            $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data){
                $("#tag_container").empty().html(data); // Uppend page wise data
                location.hash = page; //set page number in url
            }).fail(function(jqXHR, ajaxOptions, thrownError){
                  alert('No response from server');
            });
        }
    </script>
    @endpush
 @stop()
