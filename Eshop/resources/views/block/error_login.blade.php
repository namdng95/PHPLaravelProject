@if ( Session::has('error_login') )
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ Session::get('error_login') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
@endif