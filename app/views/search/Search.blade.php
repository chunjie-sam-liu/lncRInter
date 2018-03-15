@extends('layout.master')

@section('nav')
@parent
@stop
@section('content')
    <script>$(function ()
        { $("[data-toggle='popover']").popover();
        });
    </script>
    <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="false" style="display: none"   >
        <div class="modal-dialog">
            <div class="modal-content" >
            </div>
        </div>
    </div>
    <script>
        $('#myModal').on('hidden.bs.modal', function (e) {
            $(this).removeData('bs.modal');
        })
    </script>
    <script>
        $(function(){
            $(".holder").jPages({
                containerID : "rna_inter",
                previous : "«",
                next : "»",
                perPage : 20,
                delay : 10
            });
        });
    </script>
<div class="content">
<div class="row" id="search">
    <h2 class="subTitletext"><strong>Search</strong></h2>
<div class="panel panel-warning">
    <div class="panel-body">
        {{Form::open(array('url'=>'/Search_result','class'=>'form-horizontal','method'=>'get'))}}
<!-- name-->
        {{ Form::token() }}
<div class="col-lg-6">
<div class="form-group">
    <label for="Name" class="col-sm-3 control-label">lncRNA</label>
<div class="col-sm-6 " data-container="body" data-toggle="popover" data-placement="top" data-trigger="focus"
     data-content="<p style=''>Searched by  lncRNA Symbol or  Alias e.g. H19 or LINC00008</p>">
{{Form::text('Name','',array('class' => 'form-control', 'placeholder'=>''))}}
</div>
    <!-- species-->
</div>

    <div class="form-group ">
        {{Form::label('description', 'Keywords',array('class' => 'col-sm-3 control-label'));}}
        <div class="col-sm-6 " data-container="body" data-toggle="popover" data-placement="right" data-trigger="focus"
             data-content="<p style=''>Searched by  keywords in the description of the publication e.g. bind; regulate</p>">
            {{Form::text('description','',array('class' => 'form-control'))}}
        </div>
    </div>

<div class="form-group">
{{Form::label('Species', 'Organism',array('class' => 'col-sm-3 control-label'));}}
<div class="col-sm-6">
<select class="form-control" id="species" name="species">
    <option>All Species</option>
  <option>Homo sapiens</option>
    <option>Mus musculus</option>
    <option>Drosophila melanogaster</option>
    <option>Saccharomyces cerevisiae</option>
    <option>Arabidopsis thaliana</option>
    <option>Escherichia coli</option>
    <option>Others</option>
</select>
</div>
</div>
    <!-- location-->

</div>
<div class="col-lg-6">
    <!-- intertant-->
<div class="form-group">
{{Form::label('interactant', 'Interacting Partner',array('class' => 'col-sm-5 control-label'));}}
<div class="col-sm-6 " data-container="body" data-toggle="popover" data-placement="top" data-trigger="focus"
     data-content="<p style=''>Searched by  Interact Partner Symbol or  Alias e.g. MYC or c-Myc</p>">
{{Form::text('interactant','',array('class' => 'form-control','placeholder'=>''))}}
</div>
</div>
<div class="form-group">
{{Form::label('interactant type ', 'Interaction Mode',array('class' => 'col-sm-5 control-label'));}}
<div class="col-sm-6">
<select class="form-control" is="type" name="type">
    <option></option>
    <option>Binding</option>
  <option>Regulation</option>
</select>
</div>
</div>
<div class="form-group">
{{Form::label('interactant level ', 'Interaction Class',array('class' => 'col-sm-5 control-label'));}}
<div class="col-sm-6">
<select class="form-control" id="level" name="level">
    <option></option>
    <option>RNA-Protein</option>
    <option>RNA-RNA</option>
    <option>RNA-TF</option>
    <option>RNA-DNA</option>
    <option>DNA-Protein</option>
    <option>DNA-DNA</option>
    <option>DNA-TF</option>
</select>
</div>
</div>
{{Form::submit('Search',['class'=>'btn btn-primary'])}}
{{Form::close()}}
<br>
</div>
</div>
</div>

</div>
    <div class="SubContent" style="width: 950px;margin: 0 auto">
        <div class="row">
            <div class="col-xs-6">
                <div class="holder" style="margin-left: 0px" ></div></div>
            <div class="col-xs-6">
                <table class="TotalText">
                    <thead>
                    <th width="160px"></th>
                    <th width="180px">Total amount:{{count($list)}}</th>
                    <th width="120px">
                        {{Form::open(array('url'=>'/CreateTxtFile','class'=>'form-horizontal','method'=>'get'))}}
                        <input type="hidden" name="name" id="name" value="">
                        <input type="hidden" name="organism" id="organism" value="">
                        <input type="hidden" name="interactant" id="interactant" value="">
                        <input type="hidden" name="type" id="type" value="">
                        <input type="hidden" name="level" id="level" value="">
                        <input type="hidden" name="description" id="description" value="">
                        <input type="submit" name="submit" value="Download" style="border: 0px;background-color: #ffffff;color:rgb(185,122,87)">
                        {{ Form::token() }}
                        {{ Form::close() }}
                    </th>
                    </thead>
                </table>
            </div>
        </div>

        <table class="table-bordered  table-hover tablesorter">
            <thead>
            <tr style="height: 35px">
                <th width="150">lncRNA</th>
                <th >Interact Partner</th>
                <th width="150px">Interaction Class</th>
                <th width="150px">Interaction Mode</th>
                <th width="250px">Organism</th>
                <th width="100px">Detail</th>
            </tr>
            </thead>
            <tbody id="rna_inter">
            @foreach($list as $tmp)
                <tr>
                    <td><a href="/lncRInter/Detail_rna?rna_name={{$tmp->lncr_name}}&species={{$tmp->species}}&gene_id={{$tmp->lncr_id}}"  style="cursor:hand;">{{$tmp->lncr_name}}</a></td>
                    <td><a href="/lncRInter/Detail_prot?interactant={{$tmp->partner_name}}&species={{$tmp->species}}&type={{$tmp->partner_type}}&gene_id={{$tmp->partner_id}}"  style="cursor:hand;">{{$tmp->partner_name}}</a></td>
                    <td>{{$tmp->level}}</td>
                    <td>{{$tmp->class}}</td>
                    <td>{{$tmp->tax_name}}</td>
                    <td><a  data-target="#myModal" data-toggle="modal" class="btn btn-normal" href="/lncRInter/Detail?id={{$tmp->all_id}}">detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <script type="text/javascript">
            $(document).ready(function(){
                var count = "<?php echo count($list); ?>";
                if(count<10)
                    $("#bottom").hide();
                else $("#bottom").show();
            });
        </script>
        <div id="bottom">
            <div class="row">
                <div class="col-xs-6">
                    <div class="holder" style="margin-left: 0px" ></div></div>
                <div class="col-xs-6">
                    <table class="TotalText">
                        <thead>
                        <th width="160px"></th>
                        <th width="180px">Total amount:{{count($list)}}</th>
                        <th width="120px">
                            {{Form::open(array('url'=>'/CreateTxtFile','class'=>'form-horizontal','method'=>'get'))}}
                            <input type="hidden" name="name" id="name" value="">
                            <input type="hidden" name="organism" id="organism" value="">
                            <input type="hidden" name="interactant" id="interactant" value="">
                            <input type="hidden" name="type" id="type" value="">
                            <input type="hidden" name="level" id="level" value="">
                            <input type="hidden" name="description" id="description" value="">
                            <input type="submit" name="submit" value="Download" style="border: 0px;background-color: #ffffff;color:rgb(185,122,87)">
                            {{ Form::token() }}
                            {{ Form::close() }}
                        </th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
