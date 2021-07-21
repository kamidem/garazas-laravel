@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create a Truck</div>
        <div class="card-body">
          <form method="POST" action="{{route('truck.store')}}">
            <div class="form-group">

              <div class="form-group">
                <label>Maker</label>
                <input type="text" name="truck_maker" class="form-control">
                <small class="form-text text-muted">Truck maker</small>
              </div>
              <div class="form-group">
                <label>Plate</label>
                <input type="text" name="truck_plate" class="form-control">
                <small class="form-text text-muted">Truck number plate</small>
              </div>
              <div class="form-group">
                <label>Make Year</label>
                <input type="text" name="truck_make_year" class="form-control">
                <small class="form-text text-muted">Year the truck was made</small>
              </div>
              <div class="form-group">
                <label>Mechanic Notices</label>
                <textarea id="summernote" class="form-control" name="truck_mechanic_notices"></textarea>
                <small class="form-text text-muted">Truck's mechanic notices</small>
              </div>

              <label>Maker</label>
              <input type="text" class="form-control">
              <small class="form-text text-muted">Kažkoks parašymas.</small>
            </div>

            <select name="mechanic_id" class="form-control">

              @foreach ($mechanics as $mechanic)
              <option value="{{$mechanic->id}}">{{$mechanic->name}} {{$mechanic->surname}}</option>
              @endforeach
            </select>
            @csrf
            <button type="submit" class="btn btn-success">ADD</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#summernote').summernote();
  });

</script>
@endsection
