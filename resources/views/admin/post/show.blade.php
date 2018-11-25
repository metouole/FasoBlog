@extends('layouts.backend.app')

@section('title', 'Post')


@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

@endpush


@section('content')

<div class="container-fluid">
<a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">Back</a>

    @if($post->is_approuved == false)
        <button type="button" class="btn btn-success pull-right" onclick="approvePost({{ $post->id }})">
            <i class="material-icons">done</i>
            <span>Approve</span>
        </button>
        <form method="POST" action="{{ route('admin.post.approve', $post->id) }}" id="approval-form" style="display: none;">
            @csrf
            @method('PUT')
        </form>
    @else
        <button type="button" class="btn btn-success pull-right" disabled>
            <i class="material-icons">done</i>
            <span>Approved</span>
        </button>
    @endif

<br>
<br>

    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $post->title }}
                        <small>Posted By <strong><a href="">{{ $post->user->name }}</a></strong> on {{ $post->created_at->toFormattedDateString() }} </small>
                    </h2>
                </div>

                <div class="body">
                        {!! $post->body !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        CATEGORIES
                    </h2>
                </div>

                <div class="body bg-cyan">
                    @foreach($post->categories as $category)
                        <span class="label bg-cyan"> {{ $category->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="header bg-green">
                    <h2>
                        TAGS
                    </h2>
                </div>

                <div class="body bg-green">
                    @foreach($post->tags as $tag)
                        <span class="label bg-cyan"> {{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="header bg-amber">
                    <h2>
                        FEATURES IMAGE
                    </h2>
                </div>

                <div class="body bg-amber">
                    <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">
                </div>
            </div>

        </div>

    </div>
    <!-- #END# Horizontal Layout -->

    </form>

</div>

@endsection




@push('js')
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function approvePost(id){
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: "You wan to approved this post!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('approval-form').submit();

            } else if (
                // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'Your post is not approve :)',
                    'error'
                )
            }
        })
        }

    </script>

@endpush
