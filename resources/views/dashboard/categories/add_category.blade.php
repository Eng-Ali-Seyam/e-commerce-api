@extends('layouts.dashboard')

@section('style')
    <style>
        #category{
            color: #0a58ca;
        }
    </style>
@endsection
@section('content')
    <form style="width: 80%; margin: 0 auto" method="post" action="{{route('categories.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Main Title">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" >
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection
@section('title','Add Category')
