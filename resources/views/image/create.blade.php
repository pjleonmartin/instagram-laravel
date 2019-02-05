@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir nueva imagen</div>
            </div>
            
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection