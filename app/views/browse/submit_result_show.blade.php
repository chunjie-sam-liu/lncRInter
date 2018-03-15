@extends('layout.master')

@section('nav')
    @parent
@stop
@section('content')
    <div class="content">
        <div id="submit">
            <h2 class="subTitletext">Submit</h2>
            <h3 style="margin-bottom:20px;margin-left: 50px" >{{$result}}</h3>

        </div>
    </div>
@stop