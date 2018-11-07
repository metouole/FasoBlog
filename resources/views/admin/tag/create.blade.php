@extends('layouts.backend.app')

@section('title', 'Tag')


@push('css')

@endpush


@section('content')

<div class="container-fluid">

    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADD NEW TAG
                    </h2>
                </div>

                <div class="body">
                    <form method="POST" action="{{ route('admin.tag.store') }}">
                    	@csrf
                           
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Tag Name" >
                            </div>
                        </div>

                    	<a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tag.index') }}" >BACK</a>

                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
   
</div>

@endsection


@push('js')


@endpush