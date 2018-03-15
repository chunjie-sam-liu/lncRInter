@extends('layout.master')

@section('nav')
@parent
@stop
@section('content')

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <div class="content">
        <h2 class="subTitletext">
            lncRNA: <?php echo $rna_name;?> </h2>
        <div class="panel panel-warning">
            <div id="basic" class="page-header">
                <h3>Basic information</h3>
            </div>
            <div class="panel-body">
                @if($rna_id!=0)
                <dl class="dl-horizontal">
                    @foreach($list2 as $tmp)
                    @endforeach
                    @if($tmp->symbol!='-')
                        <dt>lncRNA Symbol:</dt><dd>{{$tmp->symbol}}</dd>
                        @endif
                        @if($tmp->alias!="-")
                            <dt>Alias:</dt>
                            <?php $arr10=array();$arr10=preg_split("/[|;]/","$tmp->alias");?>
                            <dd>
                                @foreach($arr10 as $each=>$value)
                                    @if(count($arr10)<6)
                                        {{$value}};
                                    @elseif(count($arr10)>=6)
                                        @if($each<6)
                                            {{$value}};
                                        @elseif($each>=6)
                                            {{$value}};
                                        @endif
                                    @endif
                                @endforeach
                            </dd>
                        @endif
                        @if($tmp->full_name!="-")
                        <dt>Full Name:</dt><dd>{{$tmp->full_name}}</dd>
                        @endif
                        @if($tmp->gene_type!="-")
                        <dt>Gene type:</dt><dd>{{$tmp->gene_type}}</dd>
                        @endif
                        @if($tmp->species!="-")
                        <dt> Organism:</dt><dd>
                                {{$tmp->tax_name}}
                        </dd>
                        @endif
                        @if ($tmp->map_location!="-")
                            <dt> Map Location:</dt><dd>{{$tmp-> map_location}}</dd>
                        @endif
                        @if ($tmp->summary!="-")
                            <dt>Summary:</dt><dd>{{$tmp->summary}}</dd>
                        @endif
                        </dl>
                    @endif
                @if($rna_id==0)
                    {{$rna_name}} gene hasn't been annotated in NCBI until May 4th,2015.
                    @endif
                </div>
        </div>

        <div class="panel panel-warning">
            <div class="page-header">
                <h3>Network</h3>
            </div>
            <div class="panel-body">
                <div id="cytoscapeweb" style="width:1000px;height:400px;margin:20px auto">
                </div>
            </div>
        </div>

        <script type="text/javascript">
        <?php
        function JSONData($vertexes1,$vertexes2,$vertexes3,$vertexes4,$vertexes5){
        $nodes = array();
        $edges = array();
        //$i=0;
        foreach($vertexes1 as $tmp=>$each)
        {
            $node=array('id'=>$tmp,'label'=>$each,'gene_id'=>$vertexes3[$tmp],'species'=>$vertexes4[$tmp]);
            array_push($nodes,$node);
        }
        foreach($vertexes2 as $tmp=>$each)
        {
            //$i=$i+1;
            $edge=array('id'=>strval($vertexes5[$tmp]),'source'=>"$tmp",'target'=>"$each");
            array_push($edges,$edge);
        }
        $arr=array(
                'dataSchema'=>array(
                        'nodes'=>[array('name'=>"label",'type'=>"string"),
                        array('name'=>"gene_id",'type'=>"string"),
                        array('name'=>"species",'type'=>"string")],
                        'edges'=>[array('name'=>"label",'type'=>"string")]),
                "data"=>array(
                        'nodes'=>$nodes,
                        'edges'=>$edges
                )
        );
		// echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
        return $arr;
        }
        ?>


          function draw_module(networ_json) {
              var m=networ_json.data.nodes;
                var div_id = "cytoscapeweb";
                var options = {
                    swfPath: "swf/CytoscapeWeb",
                    flashInstallerPath: "swf/playerProductInstall"
                };
                var vis = new org.cytoscapeweb.Visualization(div_id, options);
                var style = {
                    global: {
                        backgroundColor: "#ffffff",
                        tooltipDelay: 1000

                    },
                    nodes: {
                        color: "green",
                        size: "auto",
                        borderColor: "green",
                        labelFontSize: 20,
                        labelFontColor: "white",

                        tooltipText: "<b>${label}</b>: ${weight}"
                    },
                    edges: {
                        width: 2,
                        mergeWidth: 2,
                        weight: 7,
                        opacity: 1,
                        label: { passthroughMapper: { attrName: "id" } },
                        labelFontSize:18,
                        labelFontWeight: "bold"
                    }
                };
              var bypass = {nodes: {}};

              var value;
              for(i=0;i< m.length;i++){
                  var str=m[i].id;
                  if(str.substr(str.length-1,1)=="l"){
                      value=str;
                      bypass.nodes[value] = {  color: "rgb(185,122,87)", size: "auto", borderColor: "rgb(185,122,87)",labelFontSize:20 };
                  }
              }

                var layout = {
                    fitToScreen: true,
                    autoStabilize: true,
                    restLength:100
                };
                vis.ready(function() {
                    vis.layout({ name: "ForceDirected", options: layout });
                    vis.visualStyle(style);
                    vis.visualStyleBypass(bypass);
                    vis.addListener("click", "nodes", function(evt) {
                        var nodes = evt.target;
                        var str = nodes.data.id;
                        if(str.substr(str.length-1,1)=="l"){
                            window.location = 'http://115.156.239.4/lncRInter/Detail_rna?rna_name='+nodes.data.label+'&species='+nodes.data.species+'&gene_id='+nodes.data.gene_id+'#basic';
                        }
                        else{
                            window.location = 'http://115.156.239.4/lncRInter/Detail_prot?interactant='+nodes.data.label+'&species='+'{{$species}}'+'&type=p'+'&gene_id='+nodes.data.gene_id+'#basic';
                        }
                    });
                    vis.addListener("click", "edges", function(evt) {
                        var edge = evt.target;
                        var url='/lncRInter/Detail?id='+edge.data.id;
                        $("#myModal").modal({
                            remote: url
                        });
                    });
                });
                vis.draw({ network: networ_json });
            }
            $(document).ready(function() {
                var networ_json = <?php echo json_encode(JSONData($vertexes1,$vertexes2,$vertexes3,$vertexes4,$vertexes5)) ?>;

               draw_module(networ_json);
            })
        </script>

                            <div class="panel panel-warning">
                                <div class="page-header">
                                    <h3> LncRNA Interaction</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="holder" style="margin-left: 0px"></div></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <<div class="col-md-8">Total amount:{{$count}}</div>
                                                <div class="col-md-3">
                                                    {{Form::open(array('url'=>'/CreateTxtFile3','class'=>'form-horizontal','method'=>'get'))}}
                                                    <input type="hidden" name="lncr_name" id="lncr_name" value="{{$rna_name}}">
                                                    <input type="hidden" name="gene_id" id="lncr_name" value="{{$rna_id}}">
                                                    <input type="hidden" name="species" id="organism" value="{{$species}}">
                                                    <input type="submit" name="submit" value="Download" style="border: 0px;background-color: #ffffff;color:rgb(185,122,87);font-weight: bold">
                                                    {{ Form::token() }}
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                <table class="table-bordered  table-hover tablesorter">
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
                    <tbody id="lncRNA">
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
                        var count = "<?php echo $count; ?>";
                        if(count<10)
                            $("#bottom").hide();
                        else $("#bottom").show();
                    });
                </script>
                <div id="bottom">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="holder" style="margin-left: 0px"></div></div>
                        <div class="col-xs-6">
                            <table class="TotalText">
                                <thead>
                                <th width="180px"></th>
                                <th width="180px">Total amount:{{$count}}</th>
                                <th width="100px">
                                    {{Form::open(array('url'=>'/CreateTxtFile','class'=>'form-horizontal','method'=>'get'))}}
                                    <input type="hidden" name="name" id="name" value="{{$rna_id}}">
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
                                @foreach($arr1 as $each=>$linkout)
                                    @if ($linkout!="-")
                                        <div class="panel panel-warning">
                                            <div class="page-header">
                                                <h3>Related links</h3>
                                            </div>
                                            <div class="panel-body">
                                                <dl class="dl-horizontal">
                                                    <?php $arr1= explode("|","$linkout");
                                                    $arr1=array_unique($arr1);
                                                    ?>
                                                    @foreach($arr1 as $each=>$linkout)
                                                        <?php
                                                        $arr1=explode(":", "$linkout", 2);
                                                        $arr2=array();$arr2[$arr1[0]]=$arr1[1];
                                                        ?>
                                                        @foreach($arr2 as $each=>$value)
                                                            @if($each=='non')
                                                                <dt>NONCODE ID:</dt><dd><a href="http://www.noncode.org/show_rna.php?id={{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                                @if($each=='lncRNAD')
                                                                    <dt>LncRNADisease ID:</dt><dd><a href="http://www.cuilab.cn/lncrnadisease#fragment-2" target="_blank"> {{$value}}</a></dd>
                                                                @endif
                                                            @if($each=='Ensembl')
                                                                <dt>{{$each}} ID:</dt><dd><a href="http://www.ensembl.org/id/{{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                            @if($each=='HGNC')
                                                                <dt>{{$each}} ID:</dt><dd><a href="http://www.genenames.org/cgi-bin/gene_symbol_report?hgnc_id={{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                            @if($each=='MGI')
                                                                <dt>{{$each}} ID:</dt><dd><a href="http://www.informatics.jax.org/marker/{{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif

                                                            @if($each=='MIM')
                                                                <dt>{{$each}} ID:</dt><dd><a href="http://www.ncbi.nlm.nih.gov/omim/{{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                            @if($each=='Vega')
                                                                <dt>{{$each}} ID:</dt><dd><a href="http://vega.sanger.ac.uk/id/{{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                            @if($each=='HPRD')
                                                                <dt>{{$each}} ID:</dt><dd><a href=" http://www.hprd.org/protein/{{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                            @if($each=='miRBase')
                                                                <dt>{{$each}} ID:</dt><dd><a href="http://www.mirbase.org/cgi-bin/mirna_entry.pl?acc={{$value}}" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                            @if($each=='IMGT/GENE-DB')
                                                                <dt>{{$each}} ID:</dt><dd><a href=" http://www.imgt.org/genedb/individualEntry?name={{$value}}&species=<?php
                                                                    if($tmp-> species==9606) {echo "Homo sapiens";}
                                                                    elseif($tmp-> species==10090){echo "Mus musculus";}?>" target="_blank"> {{$value}}</a></dd>
                                                            @endif
                                                            @if($each=='lnci')
                                                                <dt>Lncipedia ID:</dt>
                                                                <?php $value=explode(";",$value);?>
                                                                    <dd> @foreach($value as $each=>$value)
                                                                    <a href="http://www.lncipedia.org/db/transcript/{{$value}}" target="_blank"> {{$value}}</a>;
                                                                    @endforeach</dd>
                                                                @endif
                                                                @endforeach
                                                                @endforeach

                                                </dl>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
    </div>
@stop
