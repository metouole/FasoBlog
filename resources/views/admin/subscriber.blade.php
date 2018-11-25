@extends('layouts.backend.app')

@section('title', 'Subscriber')


@push('css')


    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets.backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush


@section('content')

<div class="container-fluid">

	<div class="block-header">
	   <a class="btn btn-primary waves-effect" href="{{ route('admin.post.create') }}">
	   	<i class="material-icons">add</i>
		<span>Add New Post</span>
	   </a>  
	</div>
	<!-- Exportable Table -->
	<div class="row clearfix">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <div class="card">
	            <div class="header">
	                <h2>
	                    All Subscribers
	                    <span class="badge bg-red">{{ $subscribers->count() }}</span>
	                </h2>
	               
	            </div>
	            <div class="body">
	                <div class="table-responsive">
	                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
	                        <thead>
	                            <tr>
	                                <th>ID</th>
	                                <th>Email</th>
	                                
	                                <th>Actions</th>
	                            </tr>
	                        </thead>
	                        <tfoot>
	                            <tr>
	                                <th>ID</th>
	                                <th>Email</th>
	                               
	                                <th>Actions</th>
	                            </tr>
	                        </tfoot>
	                       <tbody>
	                       	
	                       	@foreach($subscribers as $key=>$subscriber)
	                       	<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $subscriber->email }}</td>
							
								<td class="text-center">

								<button onclick="deleteSubscriber({{ $subscriber->id }})" class="btn btn-danger waves-effect" type="button">
									<i class="material-icons">delete</i>
								</button>
								<form id="delete-form-{{ $subscriber->id }}" action="{{ route('admin.subscriber.destroy', $subscriber->id) }}" method="POST" style="display: none;">
									@csrf
									@method('DELETE')
								</form>
								
								</td>

							</tr>
	                       	@endforeach
	                       	
	                       </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- #END# Exportable Table -->
	</div>

@endsection


@push('js')

	<!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>


<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->

	<script type="text/javascript">
		function deleteSubscriber(id){
			const swalWithBootstrapButtons = swal.mixin({
			  confirmButtonClass: 'btn btn-success',
			  cancelButtonClass: 'btn btn-danger',
			  buttonsStyling: false,
			})

			swalWithBootstrapButtons({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonText: 'Yes, delete it!',
			  cancelButtonText: 'No, cancel!',
			  reverseButtons: true
			}).then((result) => {
			  if (result.value) {
			  	event.preventDefault();
			  	document.getElementById('delete-form-'+id).submit();
			  
			  } else if (
			    // Read more about handling dismissals
			    result.dismiss === swal.DismissReason.cancel
			  ) {
			    swalWithBootstrapButtons(
			      'Cancelled',
			      'Your category is safe :)',
			      'error'
			    )
			  }
			})
		}

	</script>

	 


@endpush