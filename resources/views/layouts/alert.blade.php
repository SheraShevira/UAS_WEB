@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show ms-2 position-absolute mt-3 start-50 translate-middle-x"
        role="alert">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show ms-2 position-absolute mt-3 start-50 translate-middle-x"
        role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
