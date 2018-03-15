<?php

class ShowController extends BaseController {

        /*
        |--------------------------------------------------------------------------
        | Default Home Controller
        |--------------------------------------------------------------------------
        |
        | You may wish to use controllesrs instead of, or in addition to, Closure
        | based routes. That's great! Here is an example controller method to
        | get you started. To route to this controller, just add the route:
        |
        |       Route::get('/', 'HomeController@showWelcome');
        |
        */


	 public function showdetail(){
         foreach($_GET as $search){
             if(empty($search)) continue;
             if (!preg_match('/^[a-zA-Z0-9_\-\.\s\:]+$/', $search)) {
                 echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
                 exit;
             }
         }
             $id=$_GET['id'];
             $list1=DB::table("lncrinter_all")
                 ->join('taxonomy', 'lncrinter_all.species', '=', 'taxonomy.tax_id')
                 ->where('lncrinter_all.id',$id)
                 ->get();
         foreach($list1 as $tmp){
             $lncr_name=$tmp->lncr_name;
             $partner_name=$tmp->partner_name;
             $species=$tmp->species;
             $class=$tmp->class;
             $level=$tmp->level;
         }
         $list=DB::table("lncrinter_all")
             ->join('taxonomy', 'lncrinter_all.species', '=', 'taxonomy.tax_id')
             ->where('lncrinter_all.lncr_name',$lncr_name)
             ->where('lncrinter_all.partner_name',$partner_name)
             ->where('lncrinter_all.class',$class)
             ->where('lncrinter_all.level',$level)
             ->where('lncrinter_all.species',$species)
             ->get();
         $count=count($list);
		return View::make('detail.detail')->with('list',$list)->with('count',$count);
	}

	public function showdetail_rna(){
        foreach($_GET as $search){
            if(empty($search)) continue;
            if (!preg_match('/^[a-zA-Z0-9_\-\.\:\s]+$/', $search)) {
                echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
                exit;
            }
        }
        $rna_name=$_GET['rna_name'];
        $species=$_GET['species'];
        $gene_id=$_GET['gene_id'];
        if($gene_id!=0){
            $list=DB::table("lncRInter")->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')->where('lncRInter.lncr_id',$_GET['gene_id'])->orWhere('lncRInter.partner_id',$_GET['gene_id'])->select('lncRInter.all_id','lncRInter.lncr_name','lncRInter.lncr_id','lncRInter.partner_id','lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.species','lncRInter.partner_type','lncRInter.level','taxonomy.tax_name')
                ->get();

        }
        else{
        $list=DB::table("lncRInter")
            ->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')
            ->where(function($query1)
            {
                $query1->where('lncRInter.species',$_GET['species'])
                    ->where('lncr_name',$_GET['rna_name']);
            })
            ->orWhere(function($query2)
            {
                $query2->where('lncRInter.species',$_GET['species'])
                    ->where('partner_name',$_GET['rna_name']);
            })
            ->select('lncRInter.id','lncRInter.all_id','lncRInter.lncr_name','lncRInter.lncr_id','lncRInter.partner_id',
                'lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.species','lncRInter.level','lncRInter.partner_type','taxonomy.tax_name')
            ->get();
        }
        $list2=DB::table("gene_summary")
            ->join('taxonomy', 'gene_summary.species', '=', 'taxonomy.tax_id')
            ->where('gene_id',$gene_id)->get();

        $vertexes1 =array();
        $vertexes2 =array();
        $vertexes3=array();
        $vertexes4=array();
        foreach ($list as $tmp){
            $l="l";
            $vertexes1[$tmp->lncr_name.$l]=$tmp->lncr_name;
            $vertexes3[$tmp->lncr_name.$l]=$tmp->lncr_id;
            $vertexes4[$tmp->lncr_name.$l]=$tmp->species;
            $vertexes1[$tmp->partner_name.$tmp->partner_type]=$tmp->partner_name;
            $vertexes3[$tmp->partner_name.$tmp->partner_type]=$tmp->partner_id;
            $vertexes4[$tmp->partner_name.$tmp->partner_type]=$tmp->species;
        }
        foreach ($list as $tmp){
            $l="l";
            $vertexes2[$tmp->partner_name.$tmp->partner_type]=$tmp->lncr_name.$l;
            $vertexes5[$tmp->partner_name.$tmp->partner_type]=$tmp->all_id;
        }
        $vertexes1=array_unique($vertexes1);

        $arr1=array();

       foreach ($list2 as $tmp){
           $arr1[$tmp->id]=$tmp->linkout;
       }
        $count=count($list);
		return View::make('detail.detail_rna')->with('rna_name',$rna_name)->with('list',$list)->with('rna_id',$gene_id)->with('vertexes2',$vertexes2)->with('vertexes1',$vertexes1)->with('list2',$list2)->with('arr1',$arr1)->with('species',$species)->with('count',$count)->with('vertexes3',$vertexes3)->with('vertexes4',$vertexes4)->with('vertexes5',$vertexes5);
        }

	public function showdetail_prot(){
        foreach($_GET as $search){
            if(empty($search)) continue;
            if (!preg_match('/^[a-zA-Z0-9_\-\.\:\s]+$/', $search)) {
                echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
                exit;
            }
        }
        $interactant=$_GET['interactant'];
        $species=$_GET['species'];
        $type=$_GET['type'];
        $gene_id=$_GET['gene_id'];
        if($gene_id!=0){
            $list=DB::table("lncRInter")->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')->where('lncRInter.lncr_id',$_GET['gene_id'])->orWhere('lncRInter.partner_id',$_GET['gene_id'])->select('lncRInter.all_id','lncRInter.lncr_name','lncRInter.lncr_id','lncRInter.partner_id','lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.species','lncRInter.partner_type','lncRInter.level','taxonomy.tax_name')
            ->get();

        }
        else{
        $list=DB::table("lncRInter")
            ->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')
            ->where(function($query1)
            {
                $query1->where('lncRInter.species',$_GET['species'])
                    ->where('lncr_name',$_GET['interactant']);
            })
            ->orWhere(function($query2)
            {
                $query2->where('lncRInter.species',$_GET['species'])
                    ->where('partner_name',$_GET['interactant']);
            })
            ->select('lncRInter.all_id','lncRInter.lncr_name','lncRInter.lncr_id','lncRInter.partner_id',
                'lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.species','lncRInter.partner_type','lncRInter.level','taxonomy.tax_name')
            ->get();
        }

        $list2=DB::table("gene_summary")
            ->join('taxonomy', 'gene_summary.species', '=', 'taxonomy.tax_id')
            ->where('gene_id',$gene_id)->get();
        $vertexes1 =array();
        $vertexes2 =array();
        $vertexes3=array();
        $vertexes4=array();
        foreach ($list as $tmp){
            $l="l";
            $vertexes1[$tmp->lncr_name.$l]=$tmp->lncr_name;
            $vertexes3[$tmp->lncr_name.$l]=$tmp->lncr_id;
            $vertexes4[$tmp->lncr_name.$l]=$tmp->species;
            $vertexes1[$tmp->partner_name.$tmp->partner_type]=$tmp->partner_name;
            $vertexes3[$tmp->partner_name.$tmp->partner_type]=$tmp->partner_id;
            $vertexes4[$tmp->partner_name.$tmp->partner_type]=$tmp->species;
        }
        foreach ($list as $tmp){
            $l="l";
            if($type=='p'){
                $vertexes2[$tmp->lncr_name.$l]=$tmp->partner_name.$tmp->partner_type;
                $vertexes5[$tmp->lncr_name.$l]=$tmp->all_id;
            }
            else{
                $vertexes2[$tmp->partner_name.$tmp->partner_type]=$tmp->lncr_name.$l;
                $vertexes5[$tmp->partner_name.$tmp->partner_type]=$tmp->all_id;
            }

        }
        $vertexes1=array_unique($vertexes1);

        $arr1=array();
        foreach ($list2 as $tmp){
            $arr1[$tmp->id]=$tmp->linkout;
        }

        $count=count($list);
            return View::make('detail.detail_prot')->with('interactant_id',$gene_id)->with('list',$list)->with('partner_name',$interactant)->with('vertexes1',$vertexes1)->with('vertexes2',$vertexes2)->with('list2',$list2)->with('arr1',$arr1)->with('species',$species)->with('count',$count)
                ->with('vertexes3',$vertexes3)->with('vertexes4',$vertexes4)->with('vertexes5',$vertexes5)->with('type',$type);
        }

	public function download(){
        $searchresult=DB::table('lncrinter_all')
            ->join('taxonomy', 'lncrinter_all.species', '=', 'taxonomy.tax_id')
            ->where(function($query)
            {if( $_GET['species']!="Any Species")
            {
                if( $_GET['species']=="Others")
                {
                    $query->whereNotIn('lncrinter_all.species',array(9606,10090));
                }
                elseif($_GET['species']=="Homo sapiens"){
                    $query->where('lncrinter_all.species',9606);
                }
                elseif($_GET['species']=="Mus musculus"){
                    $query->where('lncrinter_all.species',10090);
                }
            }})
            ->get();
        $path="/home/gaocc/lncRInter/public/result.txt";
        $fp = fopen($path,'w');
        $write='';
        $write.='lncrna';$write.="\t";$write.='Interacting partner';$write.="\t";$write.='Interaction Class';$write.="\t";
        $write.='Interaction Mode';$write.="\t";$write.='Organism';$write.="\t";$write.='Description';$write.="\t";$write.='Tissue';$write.="\t";
        $write.='Phenotype';$write.="\t";$write.='Method';$write.="\t";$write.='Pubmed id';$write.="\n";
        foreach($searchresult as $rg){
            $write.=$rg->lncr_name;$write.="\t";$write.=$rg->partner_name;$write.="\t";$write.=$rg->level;$write.="\t";
            $write.=$rg->class;$write.="\t";
            $write.=$rg->tax_name;
            $write.="\t";
            $write.=$rg->description;$write.="\t";$write.=$rg->tissue;$write.="\t";
            $write.=$rg->phenotype;$write.="\t";$write.=$rg->method;$write.="\t";$write.=$rg->reference;$write.="\n";
        }
        fwrite($fp, $write);
        fclose($fp);
        return Response::download($path);
	}

    public function showsubmit_result(){
        if(isset($_REQUEST['_token'])){
            if ($_REQUEST['_token'] != csrf_token())
            {
                #var_dump($_COOKIE['cookie']);
                echo '<script>alert("Please make sure the correct input.");history.back();</script>';
                exit;
            }
        }
        $pubmed=$_GET['pubmed'];
        $lncRNA=$_GET['lncRNA'];
        $interactant=$_GET['interactant'];
        $organism=$_GET['organism'];
        $level=$_GET['level'];
        $class=$_GET['class'];
        $description=$_GET['description'];
        $time=date('Y-m-d H:i:s');
        if($_GET['pubmed'])
        {
            $path="/home/gaocc/lncRInter/public/submit.txt";
            fopen($path,"a");
            file_put_contents($path, $time,FILE_APPEND);
            file_put_contents($path, "\t",FILE_APPEND);
            file_put_contents($path, $pubmed,FILE_APPEND);
            file_put_contents($path, "\t",FILE_APPEND);
            file_put_contents($path, $lncRNA,FILE_APPEND);
            file_put_contents($path, "\t",FILE_APPEND);
            file_put_contents($path, $interactant,FILE_APPEND);
            file_put_contents($path, "\t",FILE_APPEND);
            file_put_contents($path, $organism,FILE_APPEND);
            file_put_contents($path, "\t",FILE_APPEND);
            file_put_contents($path, $level,FILE_APPEND);
            file_put_contents($path, "\t",FILE_APPEND);
            file_put_contents($path, $class,FILE_APPEND);
            file_put_contents($path, "\t",FILE_APPEND);
            file_put_contents($path, $description,FILE_APPEND);
            file_put_contents($path, "\n",FILE_APPEND);
            $result="Submit successfully!";
            $data = ['email'=>'gaoch@hust.edu.cn', 'name'=>'Gao Changhan', 'result'=>$result,'pubmed'=>$pubmed,'lncRNA'=>$lncRNA,'partner'=>$interactant,'level'=>$level,'class'=>$class,'description'=>$description,'species'=>$organism,'time'=>$time];
           Mail::send('browse.submit_result', $data, function($message)
            {
                $message->to('gaoch@hust.edu.cn','Gao Changhan')->cc('samliu@hust.edu.cn')->subject('Submit in lncRInter');

            });
            return View::make('browse.submit_result_show')->with('result',$result);
        }
        else
        {
            $result="Submit unsuccessfully! Please submit the Pubmed ID!";
            return View::make('browse.submit_result_show')->with('result',$result);
        }

    }

}


