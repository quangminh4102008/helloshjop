@extends('admin.main')

@section('content')
    <form action="" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Name</label>
                <input type="text" name="name" class="form-control"  placeholder="Enter  name">
            </div>

            <div class="form-group">
                <label>Surname </label>
                <textarea name="surname" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <textarea name="phone" id="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Email</label>
                <textarea name="email" id="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Username</label>
                <textarea name="username" id="username" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Password</label>
                <textarea name="password" id="password" class="form-control"></textarea>
            </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add user</button>
        </div>
        @csrf
    </form>
@endsection
