@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Content</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Active</th>
            <th>Update</th>
        </tr>

        @foreach($list as $lists)
            <tr>
                <th>{{$lists->id}}</th>
                <th>{{$lists->name}}</th>
                <th>{{$lists->description}}</th>
                <th>{{$lists->content}}</th>
                <th>{{$lists->created_at}}</th>
                <th>{{$lists->updated_at}}</th>
                <th>{{$lists->active}}</th>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/menus/edit/{{$lists->id}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a  class="btn btn-danger btn-sm" href="/admin/menus/destroy/{{$lists->id}}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </thead>
        <tbody>
        </tbody>
    </table>
    @include('pagination.default', ['paginator' => $list])
@endsection
