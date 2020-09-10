@extends('layouts.master')
@section('content')
<div class="col-sm-9 padding-right">
    @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif(Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
</div>
@endsection