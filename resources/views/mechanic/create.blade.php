@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create a Mechanic</div>
        <div class="card-body">

          <form method="POST" action="{{route('mechanic.store')}}">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="mechanic_name">

              <small class="form-text text-muted">Mechanic's name.</small>
            </div>
            <div class="form-group">
              <label>Surname</label>
              <input type="text" class="form-control" name="mechanic_surname">

              <small class="form-text text-muted">Mechanic's surname.</small>
            </div>

            @csrf
            <button type="submit" class="btn btn-success">ADD</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
