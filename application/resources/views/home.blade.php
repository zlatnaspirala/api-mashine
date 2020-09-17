@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <passport-personal-access-tokens></passport-personal-access-tokens>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-clients></passport-clients>
            <my-component></my-component>
        </div>
    </div>
</div>
@endsection
