@extends('layout.mater2')

@section('nav')
    @parent
@stop
@section('content')
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
        <h2 class="subTitletext">Quickly search results</h2>
        <div class="SubContent" style="width: 980px;margin: 0 auto">
            <div class="row">
                <div class="col-xs-6">
                    <div class="holder" style="margin-left: 0px" ></div></div>
                <div class="col-xs-6">
                    <table class="TotalText">
                        <thead>
                        <th width="180px"></th>
                        <th width="350px">Total amount:{{$count}}</th>
                        <th width="100px">
                            {{Form::open(array('url'=>'/CreateTxtFile2','class'=>'form-horizontal','method'=>'get'))}}
                            <input type="hidden" name="search" id="search" value="{{$search}}">
                            <input type="submit" name="submit" value="Download" style="border: 0px;background-color: #ffffff;color:rgb(185,122,87)">
                            {{ Form::token() }}
                            {{ Form::close() }}
                        </th>
                        </thead>
                    </table>
                </div>
            </div>

            <table class="table-bordered  table-hover tablesorter" style="color:black">
                <thead>
                <tr style="height: 35px">
                    <th width="150">lncRNA</th>
                    <th >Interacting Partner</th>
                    <th width="140px">Interaction Class</th>
                    <th width="150px">Interaction Mode</th>
                    <th width="250px">Organism</th>
                    <th width="100px">Detail</th>
                </tr>
                </thead>
                <tbody id="rna_inter">
                @foreach($searchresult as $tmp)
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
                var count = "<?php echo $count; ?>";
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
                        <th width="180px">Total amount:{{$count}}</th>
                        <th width="120px">
                            {{Form::open(array('url'=>'/CreateTxtFile2','class'=>'form-horizontal','method'=>'get'))}}
                            <input type="hidden" name="search" id="search" value="{{$search}}">
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
@stop
