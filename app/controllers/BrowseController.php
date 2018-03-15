<?php

class BrowseController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */


    public function submitshow()
    {
        return View::make('browse.Submit');
    }

    public function databaseshow()
    {

        $list=DB::table("lncRInter")
            ->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')
            ->select('lncRInter.all_id','lncRInter.lncr_name','lncRInter.lncr_id','lncRInter.partner_id',
                'lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.level','lncRInter.partner_type','taxonomy.tax_name')
            ->get();
        return View::make('browse.Database')->with('list',$list);
    }

    public function downloadshow()
    {
        return View::make('browse.Download');
    }


    public function methodshow()
    {
        return View::make('browse.Method');
    }
    public function methoddatashow()
    {
        return View::make('browse.documendata');
    }

    public function contactshow()
    {
        return View::make('browse.Contact');
    }

    public function CreateTxtFileshow()
    {
        $searchresult=DB::table('lncrinter_all')
            ->join('taxonomy', 'lncrinter_all.species', '=', 'taxonomy.tax_id')
            ->where(function($query1)
            {if( $name = $_GET['name']) {
                $query1->where('lncrinter_all.lncr_name','like',"%$name%")
                    ->orWhere('lncrinter_all.lncr_alias','like',"%$name%");
            }})
            ->where(function($query2)
            {if($interactant = $_GET['interactant'])
            {$query2->where('lncrinter_all.partner_name','like',"%$interactant%")
                ->orWhere('lncrinter_all.partner_alias','like',"%$interactant%")
            ;}})
            ->where(function($query3)
            {if( $type = $_GET['type'])
            {$query3->where('lncrinter_all.class',$type);}})
            ->where(function($query4)
            {if( $level = $_GET['level'])
            {$query4->where('lncrinter_all.level',$level);}})
            ->where(function($query5)
            {
                if( $_GET['organism'])
                {
                if( $_GET['organism']!="All Species")
            {
                if( $_GET['organism']=="Others")
                {
                    $query5->whereNotIn('lncrinter_all.species',array(9606,10090,7227,511145,3702,559292));
                }
                elseif($_GET['organism']=="Homo sapiens"){
                    $query5->where('lncrinter_all.species',9606);
                }
                elseif($_GET['organism']=="Drosophila melanogaster"){
                    $query5->where('lncrinter_all.species',7227);
                }
                elseif($_GET['organism']=="Saccharomyces cerevisiae"){
                    $query5->where('lncrinter_all.species',559292);
                }
                elseif($_GET['organism']=="Arabidopsis thaliana"){
                    $query5->where('lncrinter_all.species',3702);
                }
                elseif($_GET['organism']=="Escherichia coli"){
                    $query5->where('lncrinter_all.species',511145);
                }
                else{
                    $query5->where('lncrinter_all.species',10090);
                }}
            }})
            ->where(function($query8)
            {if($description = $_GET['description'])
            {$query8->where('lncrinter_all.description','like',"%$description%")
            ;}})
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

    public function CreateTxtFile2show()
    {
        $search=$_GET['search'];
        $searchresult=DB::table('lncrinter_all')
            ->join('taxonomy', 'lncrinter_all.species', '=', 'taxonomy.tax_id')
            ->where('lncrinter_all.lncr_name','like',"%$search%")
            ->orWhere('lncrinter_all.partner_name','like',"%$search%")
            ->orWhere('lncrinter_all.lncr_alias','like',"%$search%")
            ->orWhere('lncrinter_all.partner_alias','like',"%$search%")
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


    public function CreateTxtFile3show()
    {
        $gene_id=$_GET['gene_id'];
        if($gene_id!=0){
            $searchresult=DB::table('lncrinter_all')
                ->join('taxonomy', 'lncrinter_all.species', '=', 'taxonomy.tax_id')
                ->where('lncrinter_all.lncr_id',$_GET['gene_id'])
                ->orWhere('lncrinter_all.partner_id',$_GET['gene_id'])
                ->get();

        }
        else {
            $searchresult = DB::table('lncrinter_all')
                ->join('taxonomy', 'lncrinter_all.species', '=', 'taxonomy.tax_id')
                ->where(function ($juery) {
                    $juery->where('lncrinter_all.lncr_name', $_GET['lncr_name'])
                        ->where('lncrinter_all.species', $_GET['species']);
                })
                ->orWhere(function ($juery1) {
                    $juery1->where('lncrinter_all.partner_name', $_GET['lncr_name'])
                        ->where('lncrinter_all.species', $_GET['species']);
                })
                ->get();
        }
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


    public function browseshow()
    {
        foreach($_GET as $search){
            if(empty($search)) continue;
        if (!preg_match('/^[a-zA-Z0-9_\-\.\s]+$/', $search)) {
            echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
            exit;
        }
    }
        $species=Input::get('species');
        $class=Input::get('class');
        $level=Input::get('level');
        if(! $_GET ){return View::make('home.index');}
        $searchresult=DB::table('lncRInter')
            ->join('taxonomy','lncRInter.species','=','taxonomy.tax_id')
            ->where(function($query)
            {if( $_GET['level'])
            {   
                 $query->where('lncRInter.level', $_GET['level']);
            }})
            ->where(function($query)
            {if( $_GET['class'])
            {
                    $query->where('lncRInter.class', $_GET['class']);
            }})
            ->where(function($query)
            {if( $_GET['species']!="All Species")
            {
                if( $_GET['species']=="Others")
                {
                    $query->whereNotIn('lncRInter.species',array(9606,10090));
                }
                elseif($_GET['species']=="Homo sapiens"){
                    $query->where('lncRInter.species',9606);
                }
                elseif($_GET['species']=="Mus musculus"){
                    $query->where('lncRInter.species',10090);
                }
            }})
            ->select('lncRInter.lncr_id','lncRInter.lncr_name','lncRInter.partner_id',
                'lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.level','taxonomy.tax_name','lncRInter.all_id','lncRInter.partner_type')
            ->get();
        return View::make('browse.browse')->with('searchresult',$searchresult)->with('species',$species)->with('level',$level)->with('class',$class);
    }


}
