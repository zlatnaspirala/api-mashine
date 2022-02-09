@extends('layouts.app')

@section('content')
<div style="display: flex;
            flex-direction: column;
            margin: auto;
            align-items: center;" >

        <div class="col-md-10">
            <passport-personal-access-tokens v-show="true"></passport-personal-access-tokens>
            <passport-authorized-clients  v-show="true"></passport-authorized-clients>
            <passport-clients  v-show="true"></passport-clients>
            <posts-component></posts-component>
        </div>

</div>
@endsection
