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
                        <th>Idea</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>
                                <a href="{{ route('users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                            </td>
                            <td>
                                <a href="{{ route('idea.show', $comment->idea) }}">{{ $comment->idea->id }}</a>
                            </td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="this.closet('form').submit(); return false;"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $comments->links() }}
            </div>
        </div>

    </div>
@endsection
