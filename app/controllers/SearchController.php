<?php

class SearchController extends BaseController {

    public function show()
    {
        $list=DB::table("lncRInter")
            ->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')
            ->select('lncRInter.lncr_id','lncRInter.lncr_name','lncRInter.partner_id',
                'lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.level','taxonomy.tax_name','lncRInter.all_id','lncRInter.partner_type')
            ->get();
        return View::make('search.Search')->with('list',$list);
    }


    public function resultshow()
    {
        if(isset($_REQUEST['_token'])){
            if ($_REQUEST['_token'] != csrf_token())
            {
                #var_dump($_COOKIE['cookie']);
                echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
                exit;
            }
        }

        $title = [];
        $name = trim(Input::get('Name'));
        array_push($title,$name);
        $organism = $_GET['species'];
        array_push($title,$organism);
        $interactant = trim(Input::get('interactant'));
        array_push($title,$interactant);
        $type = trim(Input::get('type'));
        array_push($title,$type);
        $level = trim(Input::get('level'));
        array_push($title,$level);
        $description = trim(Input::get('description'));
        array_push($title,$description);
//        if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $name)||!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $organism)||!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $interactant)||!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $type)||!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $level)||!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $description)) {
//            echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
//            exit;
//        }

        $searchresult=DB::table("lncRInter")
            ->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')
            ->join('lncrinter_all', function($join)
            {
                $join->on('lncRInter.lncr_name', '=', 'lncrinter_all.lncr_name')
                    ->on('lncRInter.partner_name', '=', 'lncrinter_all.partner_name')
                    ->on('lncRInter.species', '=', 'lncrinter_all.species')
                    ->on('lncRInter.class', '=', 'lncrinter_all.class')
                    ->on('lncRInter.level', '=', 'lncrinter_all.level');
            })
            ->where(function($query1)
            {if( $name = trim(Input::get('Name')))
               {
                $query1->where('lncRInter.lncr_name','like',"%$name%")
                    ->orWhere('lncRInter.lncr_alias','like',"%$name%");
            }})
            ->where(function($query2)
            {if($interactant = trim(Input::get('interactant')))
            {$query2->where('lncRInter.partner_name','like',"%$interactant%")
                ->orWhere('lncRInter.partner_alias','like',"%$interactant%")
            ;}})
            ->where(function($query3)
            {if( $type = $_GET['type'])
            {$query3->where('lncRInter.class',$type);}})
            ->where(function($query4)
            {if( $level = $_GET['level'])
            {$query4->where('lncRInter.level',$level);}})
            ->where(function($query5)
            {if( $_GET['species']!="All Species")
            {
                if( $_GET['species']=="Others")
                {
                    $query5->whereNotIn('lncRInter.species',array(9606,10090,7227,511145,3702,559292));
                }
                elseif($_GET['species']=="Homo sapiens"){
                    $query5->where('lncRInter.species',9606);
                }
                elseif($_GET['species']=="Mus musculus"){
                    $query5->where('lncRInter.species',10090);
                }
                elseif($_GET['species']=="Drosophila melanogaster"){
                    $query5->where('lncRInter.species',7227);
                }
                elseif($_GET['species']=="Saccharomyces cerevisiae"){
                    $query5->where('lncRInter.species',559292);
                }
                elseif($_GET['species']=="Arabidopsis thaliana"){
                    $query5->where('lncRInter.species',3702);
                }
                elseif($_GET['species']=="Escherichia coli"){
                    $query5->where('lncRInter.species',511145);
                }
            }})
            ->where(function($query8)
            {if($description = trim(Input::get('description')))
            {$query8->where('lncrinter_all.description','like',"%$description%")
            ;}})
            ->select('lncRInter.lncr_id','lncRInter.lncr_name','lncRInter.partner_id',
'lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.level','taxonomy.tax_name','lncRInter.all_id','lncRInter.partner_type')
            ->distinct()
            ->get();
        $count=count($searchresult);
        return View::make('search.Search_result')->with('searchresult',$searchresult)->with('title',$title)
            ->with('name',$name)->with('organism',$organism)->with('interactant',$interactant)->with('type',$type)->with('level',$level)->with('description',$description)->with('count',$count);
    }

    public function quicklyresultshow()
    {	
        $search =trim(Input::get('search'));
//	$regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\=|\\\|\|/";

	if(isset($_REQUEST['_token'])){
	if ($_REQUEST['_token'] != csrf_token())
	{
		#var_dump($_COOKIE['cookie']);
        echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
        exit;
	}
}
        if (!preg_match('/^[a-zA-Z0-9_\-\.\:\s]+$/', $search)) {
            echo '<script>alert("No search condition! Please make sure the correct input.");history.back();</script>';
            exit;
        }
//	if (empty($search) || preg_match_all($regex,$search))
//	{
//		echo '<script>alert("Please make sure the correct input.");history.back();</script>';
//		exit;
//	}
        $searchresult=DB::table("lncRInter")
            ->join('taxonomy', 'lncRInter.species', '=', 'taxonomy.tax_id')
            ->where('lncRInter.lncr_name','like',"%$search%")
            ->orWhere('lncRInter.partner_name','like',"%$search%")
            ->orWhere('lncRInter.lncr_alias','like',"%$search%")
            ->orWhere('lncRInter.partner_alias','like',"%$search%")
            ->select('lncRInter.lncr_id','lncRInter.lncr_name','lncRInter.partner_id',
                'lncRInter.partner_name','lncRInter.species','lncRInter.class','lncRInter.level','taxonomy.tax_name','lncRInter.all_id','lncRInter.partner_type')
            ->get();
        $count=count($searchresult);
        return View::make('search.quicklyresult')->with('searchresult',$searchresult)->with('search',$search)->with('count',$count);
    }

}
