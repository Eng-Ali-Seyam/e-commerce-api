@extends('layouts.dashboard')
@section('style')
    <style>
        #users{
            color: #0a58ca;
        }
    </style>
@endsection
@section('content')
    <div style="height: 24px"></div>
    <div class="">
        <h6 class="display-5 fw-regular">Users</h6>
        <table class="table table-bordered" id="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created at</th>
        </tr>
        </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection


@section('title','Admin')
@section('active','Home-dashboard')

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

