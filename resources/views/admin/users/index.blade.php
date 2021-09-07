@extends('layouts.app')
@section('content')
{{--    The navbar should be removed --}}
    @include('layouts.navbar')
    <div class="container py-4">
        <form>
            @csrf
            <div class="mb-3">
                <label  class="form-label">Company Name</label>
                <input type="text" class="form-control" name="name" >
            </div>
            <h3>User creation</h3>
            <div class="mb-3">
                <label  class="form-label">User Email</label>
                <input type="email" class="form-control" name="email" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Temporary Password</label>
                <input type="text" class="form-control" name="password" >
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
