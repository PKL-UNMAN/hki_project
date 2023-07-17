@extends('layouts.templateBaru',['title'=>'PO Supplier'])
@section('content')
<div class="container">
    <div class="header bg-primary text-light pb-3 pt-4 mb-3 rounded shadow">
        <h3><i class="fa-solid fa-cart-shopping fa-lg"></i> Production</h3>
    </div>
	@if ($message =session('success'))
        <script>
            window.onload = function () {
                    swal.fire("{{$message}}");
                };
        </script>
    @elseif($message =session('fail'))
    <script>
        window.onload = function () {
                swal.fire("{{$message}}");
            };
    </script>
    @endif
	
    <div class="mb-2" style="text-align: left">
        <a href="{{route('hki.production.export')}}" class="btn btn-primary shadow"><i class="fa-solid fa-square-plus"></i> Export</a>
        <button type="button" class="btn btn-info shadow" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: white"><i class="fa-sharp fa-solid fa-cloud-arrow-up"></i> Upload Production</button>
    </div>
      <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('hki.production.upload') }}"
            method="POST"
            enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" class="form-control">
          <input type="hidden" name="role" value="2">
          <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
        </div>
    </form>
      </div>
    </div>
  </div>

	
  
</div>

@endsection

