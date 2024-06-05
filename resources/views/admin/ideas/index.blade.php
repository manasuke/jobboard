@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h2>Users</h2>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ideas as $idea)
                        <tr>
                            <td>{{ $idea->id }}</td>
                            <td>
                                <a href="{{ route('users.show', $idea->user) }}"> {{ $idea->user->name }}</a>
                            </td>
                            <td>{{ $idea->content }}</td>
                            <td>{{ $idea->created_at }}</td>
                            <td>
                                <a href="{{ route('idea.show', $idea) }}">View</a>
                                <a href="{{ route('idea.edit', $idea) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $ideas->links() }}
            </div>
        </div>

    </div>
@endsection
