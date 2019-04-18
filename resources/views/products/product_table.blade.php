<table class="table" id="ques_tbody">
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
@if(isset($products) && !empty($products))
{!! $products->render() !!}
@endif
