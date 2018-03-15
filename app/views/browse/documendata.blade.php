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
                    <h2 class="IndexSubTitle" ><strong>Data sources</strong></h2>
                    <p>
                        About lncRInter database, the original data  comes from four sources: data from LncRNADisease, NPinter and lncRNAdb databases, and abundant paper reading manually. As a result, we got a lot of lncRNA interactions.
                    </p>
                    <h2 class="IndexSubTitle" ><strong>Data processing</strong></h2>
                    <p>As indicated above, we got a lot of original data. However only a small portion of them that are what we need.  Then we filtered the original data by the following principles:</p>
                    <ul class="DoPr">
                        <li>The lncRNA interactions must be experimentally verified.</li>
                        <li>The lncRNA and its interaction partner must be interacted or regulated directly.</li>
			<li>The interactions must be lncRNAs interacting with other biological molecules including DNA, RNA, TF and Protein.</li>
                    </ul>

                        <h2 class="IndexSubTitle"><strong>Workflow</strong></h2>
                    <img src="home_picture/index.jpg">

                    <h2 class="IndexSubTitle" ><strong>Data statistics</strong></h2>
                    <p>
                        The lncRInter database presently contains 922 lncRNA interaction pairs among 276 lncRNAs and 597 partners distributed on 15 organisms, collected from 510 experimentally verified publications. According to current data, the total interactions are 922 interaction pairs from 1036 entries. Most of the lncRNA functional studies were focused on human and mouse, which comprised of more than 90% interaction pairs.
                    </p>
                    There are 15 organisms in lncRInter and the distribution of lncRNA interaction in each organism is as following.
                    <p ><img src="Documentpicture/species.jpg" style="display:block;margin: 0 auto"></p>

                    <p>The figures show the distribution of some lncRNAs and interacting partners in lncRInter. </p>
                    <p ><img src="Documentpicture/lncRNA.jpg" style="display:block;margin: 0 auto"></p>
                    <p ><img src="Documentpicture/partner.jpg" style="display:block;margin: 0 auto"></p>
                    <p>The figures show the distribution of interaction mode and class in lncRInter. Most of interaction classes are RNA–protein and RNA–TF interactions (59%), binding (75%) is a more common interaction mode than regulation..</p>
                    <p ><img src="Documentpicture/interaction.jpg" style="display:block;margin: 0 auto" ></p>
                </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
@stop
