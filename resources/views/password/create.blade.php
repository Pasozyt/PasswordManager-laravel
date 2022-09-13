<x-app-layout>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Stwórz hasło</h2>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Error</strong> <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


        
    <form id="password-form" method="POST" action="{{ route('password.store') }}">
        @csrf
        
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">
                            Nazwa serwisu
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" aria-describedby="name-error">
                            @error('name')
                                <span id="name-error" class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">
                            Hasło
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" aria-describedby="password-error">
                            @error('password')
                                <span id="password-error" class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="confirm-password" class="col-sm-2 col-form-label">
                            Potwierdzenie hasła
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('confirm-password') is-invalid @enderror"
                                name="confirm-password" id="confirm-password" aria-describedby="confirm-password-error">
                            @error('confirm-password')
                                <span id="confirm-password-error" class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3 ">
                        <div class="btn-group" role="group" aria-label="Cancel or submit form">
                            <button type="submit" class="btn btn-primary">
                                Zapisz
                            </button>
                            <a class="btn btn-secondary" href="{{ route('password.index') }}">
                                Anuluj
                            </a>
                        </div>
                    </div>
</x-app-layout>
