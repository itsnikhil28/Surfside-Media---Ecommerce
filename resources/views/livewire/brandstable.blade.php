<div>
    <div class="wg-table table-all-user">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{$i}}</td>
                        <td class="pname">
                            <div class="image">
                                <img src="{{asset('storage/brands/'.$brand->image)}}" alt="" class="image">
                            </div>
                            <div class="name">
                                <a href="#" class="body-title-2">{{$brand->name}}</a>
                            </div>
                        </td>
                        <td>{{$brand->slug}}</td>
                        <td>{{$brand->products->count()}}</td>
                        <td>
                            <div class="list-icon-function">
                                <a href="{{route('admin.brand.edit',$brand->_id)}}">
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                </a>
                                <form action="{{ route('admin.brand.delete', $brand->_id) }}" method="POST"
                                    id="delete-form-{{ $brand->_id }}">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <div class="item text-danger delete" >
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
            {{$brands->links()}}
        </div>
    </div>
</div>