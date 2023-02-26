@extends('layouts.dashboard')
@section('style')
    <style>
        #products{
            color: #0a58ca;
        }
    </style>
@endsection
@section('content')
    <!-- Main Content-->

    <div style="height: 24px"></div>
    <div class="">
        <h6 class="display-5 fw-regular">Products</h6>
        <table class="table table-bordered" id="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Old Price</th>
                <th>Category</th>
                <th>image</th>
                <th>available</th>
                <th>Manage Product</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->price}}$</td>
                    <td><strike>{{$product->old_price}}$</strike></td>
                    <td>{{$product->category->name}}</td>
                    <td><img height="40px" src="{{asset('images/products/'.$product->image)}}"></td>
                    <td>{{$product->available==1?'Yes':'No'}}</td>
                    <td>
                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <form action="{{route('products.destroy',$product->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm rounded-0" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{route('products.edit',$product->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" aria-describedby="tooltip217655"><i class="fa fa-edit"></i></a>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>

@endsection

@section('title','My News')

@section('yajra')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>

        $(document).ready( function () {
            $('#table').DataTable();
        } );

    </script>

@endsection
