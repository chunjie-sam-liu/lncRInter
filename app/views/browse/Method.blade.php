@extends('layout.master')

@section('nav')
@parent
@stop
@section('content')
<div class="content">
    <div id="method">
        <h2 class="subTitletext">Document</h2>
<div class="SubContent" style="width: 980px;margin: 0 auto">
        <div  id="lncRNA">
            <h2 class="IndexSubTitle" ><strong>lncRInter</strong></h2>
            <p>lncRInter is a database of long non-coding RNA interaction. We only collected the experimentally supported lncRNA interactions from publications. Currently the database is publicly available and allows users to query and download all information. The database may serve as a resource of lncRNAs interaction or as a source data for lncRNA interaction prediction.
            </p>
            <h2 class="IndexSubTitle" ><strong>Guidelines</strong></h2>
            <ul>
                <li><strong>Browse by interaction class or species</strong></li>
                <p style="margin-top: 10px">
                    Users can browse data by clicking the logo of species or by clicking the name on the bottom of the logo in the home page; Users can browse data by clicking the name of the interaction class in the home page</li>
                </p>
                <li><strong>Search</strong></li>
                <ol>
                    <li>Users can perform quick search to retrieve entries by inputting the symbol or alias of an lncRNA or protein.</li>
                    <li>Advanced searching is available on the search page, user can input several conditions to search and filter records to get target entries. When users click one of the lncRNAs, a new window will be popped up to display basic information of the lncRNA and interaction network.</li>
                </ol>
                <li><strong>Submit</strong></li>
                <p>It is encouraged to submit new data to lncRInter:<a href="http://115.156.239.4/lncRInter/Submit"> Submit New LncRNA Interaction</a></p>
                <p style="margin-top: 10px">
                    Submitting new data, it includes Pubmed ID, lncRNA, Interacting Partner, Interaction Class, Interaction Mode, keywords and Organism. Some of them being empty is also allowed, except for Pubmed ID. And the Pubmed ID is not allowed to be empty.</p>
                <p style="margin-top: 10px">When users is warning "Submit unsuccessfully! Please submit the Pubmed ID!", you should submit the Pubmed ID in the submit page.</p>
                <li><strong>Browse</strong></li>
                <p style="margin-top: 10px">Users can browse the database of the lncRNA interaction in the browse page, including the lncRNA name, intact partner name, interaction level, interaction class, species and detail for the interaction. Clicking the detail can get more information about this interaction, including the method, description, phenotype, tissue and pubmed id linking to the NCBI. Besides, users can also download the interaction data by clicking the download.
                </p>
                <li><strong>Download</strong></li>
                <p style="margin-top: 10px">
                    Users can download the lncRNA interaction data in download page. There are four parts here, including all interaction data, human interaction data, mouse interaction data and the other species interaction data.
                </p>Link site:<a href="http://115.156.239.4/lncRInter/Download"> download</a></p>
                <li><strong>Annotation</strong></li>
                <p style="margin-top: 10px">
                    Click the lncRNA or Interacting Partner in any interaction table, users can go to the annotation page. There are three parts in the annotation.
                <ol>
                    <li>Basic information</li>
                    <p>Users can view the symbol name, alias, full name, gene type, organism and map location in this part. Besides, users can also get more gene information through linking to others website, including MGI ID, Ensembl ID,HGNC ID, and Lncipedia ID. In addition, summary about this gene is at bottom of this part.</p>
                    <li>Network</li>
                    <p>Users can view a network about the interactions in this part.The brown node represents lncRNA and the green one represents interact partner.And the line between two nodes represents the interaction of this two genes. Besides, clicking the brown node links to the basic information in lncRNA detail or the table's relative place in associated components part in interacting partner detail. Clicking the green node will present the opposite case.</p>
                    <li>Associated Components</li>
                    <p>Users can view the associated components about the gene in a table in this part. Besides, users can browse the database of the gene interaction , including partner name, interaction level, interaction class ,organism and detail for the interaction in a table. Clicking the detail can get more information about this interaction, including the method, description, phenotype, tissue and pubmed id linking to the NCBI.  At last, users can also download the interaction data by clicking the download.</p>
                </ol>
                </p>

            </ul>
        </div>
    </div>
        </div>
</div>
@stop
