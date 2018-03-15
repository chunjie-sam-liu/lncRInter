@extends('layout.master')

@section('nav')
@parent
@stop
@section('content')
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			</div>
		</div>
	</div>

	<script>
		$('#myModal').on('hidden.bs.modal', function (e) {
			$(this).removeData('bs.modal');
		});

	</script>

<div class="content">
<h2 class="subTitletext">Browse</h2>

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


	<div class="row">
		<div class="col-xs-6">
	<div class="holder"></div></div>
		<div class="col-xs-5">
			<table class="TotalText">
				<thead>
				<th width="180px"></th>
				<th width="350px">Total amount:{{count($list)}}</th>
				<th width="100px">
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
	<div class="row">
		<div class="col-xs-6">
			<div class="holder"></div></div>
		<div class="col-xs-6">
			<table class="TotalText">
				<thead>
				<th width="180px"></th>
				<th width="180px">Total amount:{{count($list)}}</th>
				<th width="100px">
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
@stop
