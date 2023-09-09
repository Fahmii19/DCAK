<div class="container">
    <h1>Login</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('message') }}
        </div>
    @endif
    <form action="{{ route('loginProcess') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
