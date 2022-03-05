@if(session('message'))
<div class="card-header p-2">
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>Notify!!</strong> {{ session('message') }}
    </div>
</div><!-- /.card-header -->
@endif
