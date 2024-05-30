@auth
    <h4> Share yours ideas </h4>
    <div class="row">
        <form action="{{ route('idea.store') }}" method="post">
            @csrf {{-- Cross-site request forgery là một loại mã độc --}}
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
            </div>
            @error('content')
                <span class="fs-6 text-danger">{{ $message }}</span>
            @enderror
            <div class="">
                <button type="submit" class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth
@guest
    <h4> Login to share yours ideas </h4>
@endguest
