<div>
    <div class="wg-table table-all-user">
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
                @foreach ($categories as $category)
                <tr>
                    <td>{{$i}}</td>
                    <td class="pname">
                        <div class="image">
                            <img src="{{asset('storage/categories/'.$category->image)}}" alt="" class="image">
                        </div>
                        <div class="name">
                            <a href="#" class="body-title-2">{{$category->name}}</a>
                        </div>
                    </td>
                    <td>{{$category->slug}}</td>
                    <td>{{$category->products->count()}}</td>
                    <td>
                        <div class="list-icon-function">
                            <a href="{{route('admin.category.edit',$category->id)}}">
                                <div class="item edit">
                                    <i class="icon-edit-3"></i>
                                </div>
                            </a>
                            <form action="{{route('admin.category.delete',$category->id)}}" method="POST">
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

    </div>
</div>