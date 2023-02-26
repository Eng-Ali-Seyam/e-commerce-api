@extends('layouts.dashboard')
@section('style')
    <style>
        #category{
            color: #0a58ca;
        }
    </style>
@endsection
@section('content')
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

            @foreach($categories as $category)
                <div class="card d-flex flex-row justify-content-between" style="width: 100%;padding: 5px;margin-bottom: 20px">

                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <img height="30px" src="{{asset('images/'.$category->image)}}">
                            <h5 class="card-title">{{$category->name}}</h5>
                        </div>
                        <div style="height: 10px;"></div>
                        <h6 class="card-subtitle mb-2 text-muted">Created at {{$category->created_at}}</h6>
                    </div>
                    <div class="d-flex flex-column justify-content-evenly">
                        <a href="{{route('categories.edit',$category->id)}}"  class="btn btn-secondary" tabindex="-1" role="button" aria-disabled="true">Update</a>
                        <form action="{{route('categories.destroy',$category->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete X</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <hr class="my-4">
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="{{route('categories.create')}}">Add Categories →</a></div>
        </div>
    </div>
@endsection
@section('title','Categories')
