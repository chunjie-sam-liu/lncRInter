@extends('layout.master')

     @section('nav')
     @parent
     @stop
     @section('content')
     <div class="content">
          <div id="submit">
     <h2 class="subTitletext">Submit</h2>
                         {{Form::open(array('url'=>'/submit_result','class'=>'form-horizontal','method'=>'get'))}}
              {{ Form::token() }}
                         <div class="form-group">
                              {{Form::label('pubmed', 'Pubmed ID',array('class' => 'col-sm-3 control-label'));}}<i style="font-size: 24px">*</i>
                              <div class="col-sm-4 ">
                                   {{Form::text('pubmed','',array('class' => 'form-control'))}}
                              </div>
                         </div>

                              <div class="form-group">
                                   {{Form::label('lncRNA', 'lncRNA',array('class' => 'col-sm-3 control-label'));}}
                                   <div class="col-sm-4 ">
                                        {{Form::text('lncRNA','',array('class' => 'form-control'))}}
                                   </div>
                              </div>

                         <div class="form-group">
                              {{Form::label('interactant', 'Interacting Partner',array('class' => 'col-sm-3 control-label'));}}
                              <div class="col-sm-4 ">
                                   {{Form::text('interactant','',array('class' => 'form-control'))}}
                              </div>
                         </div>

                         <div class="form-group">
                              {{Form::label('organism', 'Organism',array('class' => 'col-sm-3 control-label'));}}
                              <div class="col-sm-4 ">
                                   {{Form::text('organism','',array('class' => 'form-control'))}}
                              </div>
                         </div>

                         <div class="form-group">
                              {{Form::label('level', 'Interaction Class',array('class' => 'col-sm-3 control-label'));}}

                              <div class="col-sm-4 ">
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

                         <div class="form-group">
                              {{Form::label('class', 'Interaction Mode',array('class' => 'col-sm-3 control-label'));}}
                              <div class="col-sm-4 ">
                                  <select class="form-control" is="type" name="class">
                                      <option></option>
                                      <option>Binding</option>
                                      <option>Regulation</option>
                                  </select>
                              </div>
                         </div>

               <div class="form-group">
                    {{Form::label('description', 'Description',array('class' => 'col-sm-3 control-label'));}}
                    <div class="col-sm-6 " >
                         {{Form::textarea('description','',array('class' => 'form-control','rows'=>'4'))}}
                    </div>
               </div>

               {{Form::submit('Submit',['class'=>'btn btn-warning'])}}
               {{Form::close()}}
          </div>
     </div>

     @stop
