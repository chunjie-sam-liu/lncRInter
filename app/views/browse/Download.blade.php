@extends('layout.master')

@section('nav')
@parent
@stop
@section('content')
<div class="content">
	<h2 class="subTitletext">Download</h2>
	<p style="width: 1000px;margin:0px auto">LncRInter download files are for non-commercial use only. The interaction data are divided into four parts which are all interaction data, human interaction data, mouse interaction data and the rest species interaction data.</p>
	<div class="download" style="margin: 20px 50px">
	<h2 class="IndexSubTitle" ><strong>Download database</strong></h2>
	<table class="table table-bordered" style="margin: 0px">
		<thead>
		<tr><th style="width: 200px">Database</th>
			<th style="width: 400px">Download</th>
		</tr>
		</thead>
		<tbody>
		<tr><td>All species in lncRInter</td>
		<td><a href="/lncRInter/Waiting?species=Any Species">All species in lncRInter</a></td></tr>
		<tr><td>Homo sapiens in lncRInter</td>
			<td><a href="/lncRInter/Waiting?species=Homo sapiens">Homo sapiens in lncRInter</a></td></tr>
		<tr><td>Mus musculus in lncRInter</td>
			<td><a href="/lncRInter/Waiting?species=Mus musculus">Mus musculus in lncRInter</a></td></tr>
		<tr><td>Other species in lncRInter</td>
		<td><a href="/lncRInter/Waiting?species=Others">Other species in lncRInter</a></td></tr>
		</tbody>
	</table>
		</div>
</div>
</div>
@stop
