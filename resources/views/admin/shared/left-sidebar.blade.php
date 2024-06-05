<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{ Route::is('admin.dashboard') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.dashboard') }}">
                    <span>Dashboard</span></a>

        </ul>
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{ Route::is('admin.users.index') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.users.index') }}">
                    <span>User</span></a>

        </ul>
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{ Route::is('admin.ideas.index') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.ideas.index') }}">
                    <span>Idea</span></a>

        </ul>
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{ Route::is('admin.comments.index') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.comments.index') }}">
                    <span>Comment</span></a>

        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{ route('profile') }}">View Profile </a>
    </div>
</div>
