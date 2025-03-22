<div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>SalePrice</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Featured</th>
                    <th>Stock</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1
                @endphp
                @foreach ($products as $product)
                <tr>
                    <td>{{$i}}</td>
                    <td class="pname">
                        <div class="image">
                            <img src="{{asset('storage/products/'.$product->image)}}" alt="" class="image">
                        </div>
                        <div class="name">
                            <a href="#" class="body-title-2">{{$product->name}}</a>
                            <div class="text-tiny mt-3">{{$product->slug}}</div>
                        </div>
                    </td>
                    <td>&#8377;{{$product->regular_price}}</td>
                    <td>&#8377;{{$product->sale_price}}</td>
                    <td>{{$product->SKU}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->brand->name}}</td>
                    <td>{{$product->featured == 0 ? 'NO':'YES'}}</td>
                    <td>{{$product->stock_status}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        <div class="list-icon-function">
                            <a  target="_blank">
                                <div class="item eye">
                                    <i class="icon-eye"></i>
                                </div>
                            </a>
                            <a href="{{route('admin.product.edit',$product->id)}}">
                                <div class="item edit">
                                    <i class="icon-edit-3"></i>
                                </div>
                            </a>
                            <form action="{{route('admin.product.delete',$product->id)}}" method="POST">
                                @csrf
                                <div class="item text-danger delete">
                                    <i class="icon-trash-2"></i>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @php
                $i++
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="divider"></div>
    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
        {{$products->links('pagination::bootstrap-5')}}
    </div>
</div>