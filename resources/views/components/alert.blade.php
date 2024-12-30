@if (session('success'))
    <div class="alert alert-success text-right">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-right">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger text-right">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
