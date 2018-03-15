@extends('layout.master')

@section('nav')
@parent
@stop
@section('content')
<div class="content">
	<div class="blockInnertext">
	<div id="Introduction">
<h2 class="IndexSubTitle" ><strong>Introduction</strong></h2>
<p>
	Noncoding regions are the major component of human genomes and the long noncoding RNA (lncRNA) is a class of pervasive genes located in noncoding regions. lncRNAs play a wide range of regulatory roles in gene transcription, translation, epigenetic modification and protein function by interacting with different types of molecules including DNA, RNA and protein. The diverse interacting partners of lncRNAs pose a challenge to unveil the functional significance of most lncRNAs. Due to the different interacting molecule types and binding modes, the prediction of lncRNA interaction partner is still very difficult. Fortunately, mounting experimental studies reported the function and interaction partners of different lncRNAs during the recent decade. Thus, collecting and integrating these lncRNA interaction data is a primary step to decipher the code of lncRNA interaction.
	
</p>
<p><strong>lncRInter</strong> is reliable and high quality lncRNA interaction database containing experimentally validated data. The lncRNA interaction datasets are all extractd from peer-reviewed publications by our curators with strict criteria that there were certain experimental evidence (e.g. RNA pull-down, luciferase reporter assay, in vitro binding assay, etc.) for direct lncRNA interactions.
</p>
	</div>
		<div id="BrowseType">
			<h2 class="IndexSubTitle"><strong>Browse by Interaction Class</strong></h2>
			<div class="row">
				<a href="/lncRInter/browse?species=&amp;class=&amp;level=RNA-TF">
					<div class="col-sm-3">
						<div class="thumbnail"><img src="home_picture/rna-tf.jpg" data-holder-rendered="true" style="height:100px;width=100%;"></div>
						<div class="caption"><p class="text-center">RNA-TF</p></div>
					</div>
				</a>
				<a href="/lncRInter/browse?species=&amp;class=&amp;level=RNA-Protein">
					<div class="col-sm-3">
						<div class="thumbnail"><img src="home_picture/rna-protein.jpg" data-holder-rendered="true" style="height:100px;width=100%;"></div>
						<div class="caption"><p class="text-center">RNA-Protein</p></div>
					</div>
				</a>
				<a href="/lncRInter/browse?species=&amp;class=&amp;level=RNA-RNA">
					<div class="col-sm-3">
						<div class="thumbnail"><img src="home_picture/rna-rna.jpg" data-holder-rendered="true" style="height:100px;width=100%;"></div>
						<div class="caption"><p class="text-center">RNA-RNA</p></div>
					</div>
				</a>
				<a href="/lncRInter/browse?species=&amp;class=&amp;level=RNA-DNA">
					<div class="col-sm-3">
						<div class="thumbnail"><img src="home_picture/rna-dna.jpg" data-holder-rendered="true" style="height:100px;width=100%;"></div>
						<div class="caption"><p class="text-center">RNA-DNA</p></div>
					</div>
				</a>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<a href="/lncRInter/browse?species=&amp;class=&amp;level=DNA-TF">
						<div class="thumbnail"><img src="home_picture/dna-tf.jpg" data-holder-rendered="true" style="height:100px;width=100%;"></div>
						<div class="caption"><p class="text-center">DNA-TF</p></div>
					</a>
				</div>
				<a href="/lncRInter/browse?species=&amp;class=&amp;level=DNA-Protein">
					<div class="col-sm-3">
						<div class="thumbnail"><img src="home_picture/dna-protein.jpg" data-holder-rendered="true" style="height:100px;width=100%;"></div>
						<div class="caption"><p class="text-center">DNA-Protein</p></div>
					</div>
				</a>
				<a href="/lncRInter/browse?species=&amp;class=&amp;level=DNA-DNA">
					<div class="col-sm-3">
						<div class="thumbnail"><img src="home_picture/dna-dna.jpg" data-holder-rendered="true" style="height:100px;width=100%;"></div>
						<div class="caption"><p class="text-center">DNA-DNA</p></div>
					</div>
				</a>
			</div>
		</div>
		<div id="BrowseSpecies">
			<h2 class="IndexSubTitle"><strong>Browse by species</strong></h2>
			<div id="row" style="margin-left: 30px">
				<a href="/lncRInter/browse?species=Homo sapiens&class=&level=">
				<div class="col-sm-3">
					<div class="thumbnail">
							<img src="home_picture/human.jpg"  class="text-center" >
						</div>
					<div class="caption">
						<p class="text-center">Homo sapiens</p>
						</div>
				</div>
					</a>
				<a href="/lncRInter/browse?species=Mus musculus&class=&level=">
				<div class="col-sm-3">
						<div class="thumbnail">
								<img src="home_picture/mouse.jpg" >
						</div>
						<div class="caption">
							<p class="text-center">Mus musculus</p>
						</div>
				</div>
				</a>
				<a href="/lncRInter/browse?species=Others&class=&level=">
					<div class="col-sm-3">
						<div class="thumbnail">
								<img src="home_picture/others.png">
						</div>
						<div class="caption">
							<p class="text-center">Others</p>
						</div>
					</div>
				</a>
				<a href="/lncRInter/browse?species=All Species&class=&level=">
					<div class="col-sm-3">
						<div class="thumbnail">
								<img src="home_picture/any.png">
						</div>
						<div class="caption">
							<p class="text-center">All Species</p></a>
						</div>
					</div>
		</a>
			</div>
		</div>



<div style="margin-top: 100px">
<p>
Publication for more information and for citing this work:
<br>
<strong><a style="color:black" href="http://www.sciencedirect.com/science/article/pii/S167385271730019X" target="_blank">lncRInter: A database of experimentally validated long non-coding RNA interaction
</a></strong>
<br>
Chun-Jie Liu;Changhan Gao;Zhaowu Ma;Renhuai Cong;Qiong Zhang*;An-yuan Guo*
<br>
Journal of Genetics and Genomics 2017;doi:10.1016/j.jgg.2017.01.004
</p>

</div>
<div id="Histroy" style="margin-top: 10px">
	<h2 class="IndexSubTitle"><strong>History</strong></h2>
	<ul>
		<li>July, 2015, the first version of lncRInter database was released.</li>
	</ul>

	</div>


	</div>
</div>
	</div>

@stop
