@extends('layouts.dashboard')

@section('style')
    <style>
        #add{
            color: #0c84ff;
        }
    </style>
@endsection
@section('content')


    @if(count($categories))
    <form style="width: 80%; margin: 0 auto" method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title" value="{{old('title')}}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group" >
            <label for="exampleFormControlInput1">Price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Price" value="{{old('price')}}">
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group" >
            <label for="exampleFormControlInput1">Old Price</label>
            <input type="text" class="form-control @error('old_price') is-invalid @enderror" name="old_price" placeholder="Old Price" value="{{old('old_price')}}">
            @error('old_price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" name="category" >
                @foreach($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Available</label>
            <select class="form-control" name="available" >
               <option selected value="1">True</option>
               <option value="0">False</option>
            </select>
            @error('available')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label" value="{{old('image')}}">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" >
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

    @else
        <div class="card text-bg-warning mb-3" style="max-width: 18rem; margin: 0 auto">
            <div class="card-header">Warning</div>
            <div class="card-body">
                <h5 class="card-title">No Category</h5>
                <p class="card-text">You Should add category to add news</p>
            </div>
        </div>
    @endif


@endsection

@section('title','Add News')

