<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">
        <strong>The interaction of  @foreach($list as $tmp)
        @endforeach
        {{$tmp->lncr_name}} and {{$tmp->partner_name}}
            </strong>
    </h4>
</div>
<div class="modal-body">
    <dl class="dl-horizontal">
        @foreach($list as $tmp)
        @endforeach
        <dt>LncRNA Name:</dt><dd><a href="/lncRInter/Detail_rna?rna_name={{$tmp->lncr_name}}&species={{$tmp->species}}&gene_id={{$tmp->lncr_id}}"  style="cursor:hand;">{{$tmp->lncr_name}}</a></dd>
        <dt>Interacting partner:</dt><dd><a href="/lncRInter/Detail_prot?interactant={{$tmp->partner_name}}&species={{$tmp->species}}&type={{$tmp->partner_type}}&gene_id={{$tmp->partner_id}}"  style="cursor:hand;">{{$tmp->partner_name}}</a></dd>
        <dt>Organism:</dt><dd>{{$tmp->tax_name}}</dd>
        <dt>Interaction Class</dt><dd>{{$tmp->level}}</dd>
        <dt>Interaction Mode</dt><dd>{{$tmp->class}}</dd>
        <br>
        @foreach($list as $tmp)
                @if($tmp->method!="NULL")
                    <dt>Method:</dt><dd>{{$tmp->method}}</dd>
                @endif
                    @if($tmp->tissue!="NULL")
                        <dt>Tissue:</dt><dd>{{$tmp->tissue}}</dd>
                    @endif
                @if($tmp->phenotype!="NULL")
                    <dt>Phenotype:</dt><dd>{{$tmp->phenotype}}</dd>
                @endif
            <dt>Description</dt><dd>{{$tmp->description}}</dd>
            <dt>Pubmed</dt><dd><a href="http://www.ncbi.nlm.nih.gov/pubmed/{{$tmp->reference}}" target="_blank">{{$tmp->reference}}</a></dd>
            <br>
        @endforeach
    </dl>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
</div>



