@extends('layouts.templateBaru',['title'=>'Dashboard Subcon'])
@section('content')
<div class="container">
	<h1>Dashboard Subcon</h1>
	@if (session()->has('success'))
    <div onload="alert()"></div>
	@endif
	
	<div class="container" data-aos="fade-up">
		<div class="row mt-3">
			<div class="col col-md-4">
				<div class="card text-bg-primary">
					<div class="card-body">
						<h5>Akumulasi Purchasing Order</h5>
						<h5>{{ $data['po'] }}</h5>
					</div>

				</div>
			</div>
			<div class="col col-md-4">
				<div class="card text-bg-warning">
					<div class="card-body">
						<h5>Purchasing Order On Progres</h5>
						<h5>{{ $data['poOnProgres'] }}</h5>
					</div>

				</div>
			</div>
			<div class="col col-md-4">
				<div class="card text-bg-success">
					<div class="card-body">
						<h5>Purchasing Order Finish</h5>
						<h5>{{ $data['poFinish'] }}</h5>
					</div>

				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col col-md-4">
				<div class="card text-bg-primary">
					<div class="card-body">
						<h5>Akumulasi Surat Jalan</h5>
						<h5>{{ $data['surat'] }}</h5>
					</div>

				</div>
			</div>

			<div class="col col-md-4">
				<div class="card text-bg-warning">
					<div class="card-body">
						<h5>Surat Jalan On Progres</h5>
						<h5>{{ $data['suratOnProgres'] }}</h5>
					</div>
				</div>
			</div>
			<div class="col col-md-4">
				<div class="card text-bg-success">
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