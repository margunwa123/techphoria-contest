@foreach( $errors->all() as $error)
  <div class="row alert alert-warning">
    <strong>{{ $error }}</strong>
  </div>
@endforeach