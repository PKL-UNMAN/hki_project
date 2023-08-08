@extends('layouts.templateBaru',['title'=>'Dashboard HKI'])
@section('content')
<div class="container" style="background: white">
	<h1>Dashboard HKI</h1>
	@if (session()->has('success'))
    <div onload="alert()"></div>
	@endif
	
	<div class="container" data-aos="fade-up">
		<div class="row mt-4">
			<div class="col col-md-4">
				<div class="card">
					<div class="card-body">
						<h5>Akumulasi PO</h5>
						<h5>{{ $data['po'] }}</h5>
					</div>

				</div>
			</div>

			<div class="col col-md-4">
				<div class="card">
					<div class="card-body">
						<h5>Akumulasi Surat Jalan</h5>
						<h5>{{ $data['surat'] }}</h5>
					</div>

				</div>
			</div>

			<div class="col col-md-4">
				<div class="card">
					<div class="card-body">
						<h5>Surat Jalan On Progres</h5>
						<h5>{{ $data['suratOnProgres'] }}</h5>
					</div>
				</div>
			</div>
			<div class="col col-md-4">
				<div class="card">
					<div class="card-body">
						<h5>Surat Jalan Finish</h5>
						<h5>{{ $data['suratFinish'] }}</h5>
					</div>
				</div>
			</div>

		</div>
	  </div>
  
</div>
@endsection


<script>
	function alert(){
		Swal.fire(
                    {
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Item Berhasil Ditambahkan!'
                        }
                    )
	}
</script>