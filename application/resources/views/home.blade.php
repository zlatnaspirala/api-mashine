@extends('layouts.app')

@section('content')
<div style="display: flex;
            flex-direction: column;
            margin: auto;
            align-items: center;" >
    <!--div class="row justify-content-center"-->
        <div class="col-md-10">
            <passport-personal-access-tokens v-show="false"></passport-personal-access-tokens>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-clients></passport-clients>
            <posts-component></posts-component>
        </div>
    <!--/div-->
</div>
@endsection
