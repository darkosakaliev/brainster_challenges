@include('layouts.header')
@include('layouts.nav')

@if(Session::has('message'))
<div class="alert alert-{{Session::get('status')}} text-center" role="alert">
    {{ Session::get('message') }}
</div>
@endif


<h1 class="text-center py-5 mb-5">Најава</h1>
<form action="{{ route('userAuth') }}" method="POST" class="container mb-5 py-5">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Е-мејл</label>
        <input type="email" class="form-control" id="email" name="email">
        @error('email')
          <div class="alert alert-danger p-1">{{ $message }}</div>
          @enderror
      </div>
      <div class="mb-5">
        <label for="password" class="form-label">Пасворд</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
          <div class="alert alert-danger p-1">{{ $message }}</div>
          @enderror
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-warning">Најави се</button>
      </div>
</form>

@include('layouts.footer')
