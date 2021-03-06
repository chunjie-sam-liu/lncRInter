
@include('templates.header')

@section('nav')
<div id="menu" class="navbar-collapse collapse">
<ul class="nav navbar-nav list-inline">
<li>{{HTML::link('/','Home')}}</li>
    <li>{{HTML::link('/Database','Browse')}}</li>
<li>{{HTML::link('/Search','Search')}}</li>
<li>{{HTML::link('/Submit','Submit')}}</li>

<li>{{HTML::link('/Download','Download')}}</li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Document <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li>{{HTML::link('/Document','Guide')}}</li>
            <li class="divider" style="margin: 0px"></li>
            <li>{{HTML::link('/Documentdata','Data statistics')}}</li>
        </ul>
    </li>
<li>{{HTML::link('/Contact','Contact us')}}</li>
</ul>
    <script>$(function ()
        { $("[data-toggle='popover']").popover({html : true });
        });
    </script>
{{Form::open(array('url'=>'/quicklyresult','class'=>'navbar-form navbar-right','method'=>'get'))}}
<div class="form-group" >
{{Form::text('search','H19',array('class' => 'col-sm form-control','placeholder'=>''))}}
    {{ Form::token() }}
    <input class="btn btn-default" type="submit" value="Search"
           data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover"
           data-content="<p style=''>Searched by  lncRNA/Interact Partner Symbol or  Alias, such as H19, LINC00008, MYC and c-Myc.</p>">
</div>
{{Form::close()}}
</div>
</div>
</div>
<div id="wrapper"  role="navigation" >
    <div class="container">
@show
@section('content')
@show
</div>
@include('templates.footer')
