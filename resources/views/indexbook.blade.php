@extends('admin.main')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
        <table class="table">
            <tr>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Author</th>
                <th>Publish_date</th>
            </tr>
            @foreach ($books as $book)
                <tr>
                    <th>{{ $book->id }}</th>
                    <th>{{ $book->name }}</th>
                    <th>{{ $book->price }}</th>
                    <th>{{ $book->quantity }}</th>
                    <th>{{ $book->email }}</th>
                    <th>{{ $book->author }}</th>
                    <th>{{ $book->publish_date }}</th>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/menus/edit/{{$book->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a  class="btn btn-danger btn-sm" href="/admin/menus/destroy/{{$book->id}}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </thead>
                <tbody>
                </tbody>
        </table>
{{--        @include('pagination.default', ['paginator' => $books])--}}
        @endsection
