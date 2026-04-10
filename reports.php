<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reports – Church Finance</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
:root{
  --gold:#C8972A;--gold-light:#F0C96B;--deep:#080F1A;--panel:#0F1C2E;
  --card:#142236;--card2:#192B40;--border:rgba(200,151,42,0.18);--border2:rgba(255,255,255,0.06);
  --text:#EAD9BE;--muted:#7A8FA8;--success:#27C98A;--danger:#E04F4F;
  --accent:#3A88D8;--purple:#8B5CF6;--pink:#E05DA0;--radius:14px;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--deep);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;overflow-x:hidden;}
body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:0;opacity:0.4;}

/* NAV */
nav{background:rgba(8,15,26,0.92);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);padding:0 2.5rem;display:flex;align-items:center;justify-content:space-between;height:62px;position:sticky;top:0;z-index:100;}
.nav-brand{display:flex;align-items:center;gap:14px;}
.nav-icon{width:38px;height:38px;background:linear-gradient(135deg,var(--gold),var(--gold-light));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;box-shadow:0 4px 16px rgba(200,151,42,0.3);}
.nav-title{font-family:'Cormorant Garamond',serif;font-size:1.25rem;color:var(--gold-light);letter-spacing:0.5px;}
.nav-links{display:flex;gap:2px;}
.nav-links a{color:var(--muted);text-decoration:none;padding:7px 15px;border-radius:7px;font-size:0.86rem;font-weight:500;transition:all 0.2s;}
.nav-links a:hover,.nav-links a.active{background:rgba(200,151,42,0.1);color:var(--gold-light);}

/* HERO */
.hero-strip{background:linear-gradient(135deg,rgba(200,151,42,0.07) 0%,rgba(14,28,48,0) 60%);border-bottom:1px solid var(--border2);padding:1.8rem 2.5rem 1.4rem;}
.hero-strip h1{font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--gold-light);font-weight:700;}
.hero-strip p{color:var(--muted);font-size:0.88rem;margin-top:3px;}

/* PERIOD TABS */
.period-tabs{display:flex;gap:6px;padding:1.2rem 2.5rem 0;flex-wrap:wrap;border-bottom:1px solid var(--border2);background:var(--panel);}
.ptab{padding:10px 26px;border-radius:8px 8px 0 0;border:1px solid transparent;border-bottom:none;background:transparent;color:var(--muted);cursor:pointer;font-family:'DM Sans',sans-serif;font-size:0.88rem;font-weight:500;transition:all 0.2s;margin-bottom:-1px;}
.ptab.active{background:var(--card);border-color:var(--border);color:var(--gold-light);font-weight:600;}
.ptab:hover:not(.active){color:var(--text);background:rgba(255,255,255,0.03);}
.period-panel{display:none;}
.period-panel.active{display:block;}

/* CONTAINER */
.container{max-width:1380px;margin:0 auto;padding:0 2.5rem 3rem;}

/* TOOLBAR */
.toolbar{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;padding:1.4rem 0 1rem;}
.toolbar-left{display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap;}
.toolbar-right{display:flex;gap:8px;}
.filter-group{display:flex;flex-direction:column;gap:5px;}
.filter-group label{font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;}
.filter-group input,.filter-group select{background:#0F1C2E;border:1px solid var(--border);color:var(--text);padding:8px 14px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.87rem;outline:none;cursor:pointer;min-width:170px;}
.filter-group input:focus,.filter-group select:focus{border-color:var(--gold);}
select option{background:#142236;}
.week-hint{font-size:0.72rem;color:var(--muted);}
.btn-export{background:rgba(39,201,138,0.12);color:var(--success);border:1px solid rgba(39,201,138,0.25);padding:8px 16px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.85rem;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:5px;transition:background 0.2s;}
.btn-export:hover{background:rgba(39,201,138,0.22);}
.btn-print{background:rgba(255,255,255,0.05);color:var(--muted);border:1px solid var(--border2);padding:8px 14px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.85rem;cursor:pointer;display:inline-flex;align-items:center;gap:5px;}
.btn-print:hover{color:var(--text);background:rgba(255,255,255,0.08);}
.btn-week{background:rgba(255,255,255,0.05);color:var(--muted);border:1px solid var(--border2);padding:8px 14px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.85rem;cursor:pointer;transition:all 0.2s;}
.btn-week:hover{color:var(--text);}

/* STAT CARDS */
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(175px,1fr));gap:1rem;margin-bottom:1.5rem;}
.sum-card{background:var(--card);border:1px solid var(--border2);border-radius:12px;padding:1.2rem;position:relative;overflow:hidden;transition:transform 0.2s;}
.sum-card:hover{transform:translateY(-2px);}
.sum-card::after{content:'';position:absolute;top:0;left:0;right:0;height:2.5px;border-radius:12px 12px 0 0;}
.sum-card.c-gold::after{background:linear-gradient(90deg,var(--gold),var(--gold-light));}
.sum-card.c-red::after{background:linear-gradient(90deg,var(--danger),#FF8A8A);}
.sum-card.c-green::after{background:linear-gradient(90deg,var(--success),#7EEDC4);}
.sum-card.c-blue::after{background:linear-gradient(90deg,var(--accent),#8EC5F5);}
.sum-card.c-purple::after{background:linear-gradient(90deg,var(--purple),#C5A0FF);}
.sum-label{font-size:0.71rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.9px;margin-bottom:7px;}
.sum-val{font-size:1.28rem;font-weight:600;}
.sum-val.pos{color:var(--success);}
.sum-val.neg{color:var(--danger);}
.sum-val.gold{color:var(--gold-light);}
.sum-val.purple{color:#C5A0FF;}
.sum-val.blue{color:#8EC5F5;}
.sum-sub{font-size:0.72rem;color:var(--muted);margin-top:4px;}

/* 20% TITHE CALLOUT */
.tithe-callout{background:linear-gradient(135deg,rgba(139,92,246,0.1),rgba(200,151,42,0.06));border:1px solid rgba(139,92,246,0.28);border-radius:var(--radius);padding:1.4rem 2rem;margin-bottom:1.4rem;display:flex;align-items:center;gap:2rem;flex-wrap:wrap;}
.tc-block{min-width:130px;}
.tc-label{font-size:0.71rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:5px;}
.tc-val{font-size:1.6rem;font-weight:700;}
.tc-val.tithes{color:var(--gold-light);}
.tc-val.alloc{color:#C5A0FF;}
.tc-desc{font-size:0.76rem;color:var(--muted);margin-top:3px;}
.tc-op{font-size:2rem;color:rgba(139,92,246,0.4);font-weight:300;}

/* CHART GRIDS */
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem;}
.grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.2rem;margin-bottom:1.2rem;}
.grid-3-1{display:grid;grid-template-columns:2fr 1fr;gap:1.2rem;margin-bottom:1.2rem;}
.grid-1-2{display:grid;grid-template-columns:1fr 2fr;gap:1.2rem;margin-bottom:1.2rem;}
@media(max-width:1100px){.grid-3{grid-template-columns:1fr 1fr;}.grid-3-1,.grid-1-2{grid-template-columns:1fr;}}
@media(max-width:700px){.grid-2,.grid-3{grid-template-columns:1fr;}}

/* CHART CARDS */
.chart-card{background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);padding:1.5rem;position:relative;}
.chart-card::before{content:'';position:absolute;top:0;left:0;bottom:0;width:3px;border-radius:var(--radius) 0 0 var(--radius);}
.chart-card.c-gold::before{background:linear-gradient(180deg,var(--gold),var(--gold-light));}
.chart-card.c-green::before{background:linear-gradient(180deg,var(--success),#7EEDC4);}
.chart-card.c-blue::before{background:linear-gradient(180deg,var(--accent),#8EC5F5);}
.chart-card.c-purple::before{background:linear-gradient(180deg,var(--purple),#C5A0FF);}
.chart-card.c-red::before{background:linear-gradient(180deg,var(--danger),#FF9090);}
.chart-card.c-pink::before{background:linear-gradient(180deg,var(--pink),#FFB0D0);}
.chart-card h3{font-family:'Cormorant Garamond',serif;font-size:1.05rem;color:var(--gold-light);margin-bottom:3px;font-weight:600;}
.chart-card .csub{font-size:0.74rem;color:var(--muted);margin-bottom:1rem;}
.chart-card.highlight{border-color:rgba(139,92,246,0.3);background:linear-gradient(135deg,var(--card),rgba(139,92,246,0.04));}
.chart-card.highlight h3{color:#C5A0FF;}

/* SECTION LABEL */
.section-label{font-size:0.71rem;color:var(--muted);text-transform:uppercase;letter-spacing:1.2px;margin:1.6rem 0 1rem;display:flex;align-items:center;gap:10px;}
.section-label::after{content:'';flex:1;height:1px;background:var(--border2);}

/* TABLES */
.section-card{background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);padding:1.5rem;margin-bottom:1.2rem;}
.section-card h3{font-family:'Cormorant Garamond',serif;color:var(--gold-light);font-size:1.05rem;font-weight:600;margin-bottom:1rem;display:flex;justify-content:space-between;align-items:center;}
.section-card h3 a{font-family:'DM Sans',sans-serif;font-size:0.76rem;color:var(--gold);text-decoration:none;font-weight:500;}
table{width:100%;border-collapse:collapse;}
th{text-align:left;font-size:0.71rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;padding:8px 10px;border-bottom:1px solid var(--border2);}
td{padding:9px 10px;font-size:0.86rem;border-bottom:1px solid rgba(255,255,255,0.03);}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(200,151,42,0.03);}
.tfoot-row td{border-top:2px solid var(--border2);font-weight:600;background:rgba(200,151,42,0.04);color:var(--gold-light);}
.tfoot-row.t20 td{background:rgba(139,92,246,0.06);color:#C5A0FF;}
.badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:0.71rem;font-weight:500;}
.badge-gold{background:rgba(200,151,42,0.15);color:var(--gold-light);}
.badge-blue{background:rgba(58,136,216,0.15);color:#8EC5F5;}
.badge-green{background:rgba(39,201,138,0.15);color:var(--success);}
.badge-red{background:rgba(224,79,79,0.15);color:#FF9090;}
.badge-purple{background:rgba(139,92,246,0.15);color:#C5A0FF;}
.badge-pink{background:rgba(224,93,160,0.15);color:#FFB0D0;}
.amount-pos{color:var(--success);font-weight:500;}
.amount-neg{color:var(--danger);font-weight:500;}
.amount-purple{color:#C5A0FF;font-weight:600;}
.empty-state{text-align:center;padding:2.5rem;color:var(--muted);font-size:0.88rem;}
.tithe-row td:last-child{color:#C5A0FF;font-weight:600;}
.tithe-row{background:rgba(139,92,246,0.04);}

@media print{nav,.toolbar-right,.period-tabs,.ptab{display:none!important;}.period-panel{display:block!important;}}
</style>
</head>
<body>

<?php
include 'db.php';

function gSum($pdo,$table,$where){return (float)$pdo->query("SELECT COALESCE(SUM(amount),0) as v FROM $table $where")->fetch()['v'];}
function gRows($pdo,$table,$where,$ord='ORDER BY date DESC'){return $pdo->query("SELECT * FROM $table $where $ord")->fetchAll();}

$incomeTables=['main_offering','sunday_school','children_service','missions','contributions','tithes'];
$srcLabels   =['Main Offering','Sunday School','Children Service','Missions','Contributions','Tithes'];
$srcKeys     =['main_offering','sunday_school','children_service','missions','contributions','tithes'];

/* ═══ WEEKLY ═══ */
$selWeek  = $_GET['week'] ?? date('Y-\WW');
$wDate    = date('Y-m-d', strtotime($selWeek));
$wMon     = date('Y-m-d', strtotime('monday this week', strtotime($wDate)));
$wSun     = date('Y-m-d', strtotime('sunday this week', strtotime($wDate)));
$wLabel   = date('d M',strtotime($wMon)).' – '.date('d M Y',strtotime($wSun));
$wWhere   = "WHERE date BETWEEN '$wMon' AND '$wSun'";

$w=[];
foreach(['main'=>'main_offering','school'=>'sunday_school','kids'=>'children_service','missions'=>'missions','contrib'=>'contributions','tithes'=>'tithes'] as $k=>$t)
    $w[$k]=gSum($pdo,$t,$wWhere);
$w['income'] =array_sum($w); $w['expense']=gSum($pdo,'expenses',$wWhere); $w['net']=$w['income']-$w['expense']; $w['tithe20']=round($w['tithes']*0.20,2);

/* ═══ MONTHLY ═══ */
$selMonth=$_GET['month']??date('Y-m');
[$selY,$selM]=explode('-',$selMonth);
$mWhere="WHERE MONTH(date)=$selM AND YEAR(date)=$selY";
$mLabel=date('F Y',mktime(0,0,0,(int)$selM,1,(int)$selY));
$m=[];
foreach(['main'=>'main_offering','school'=>'sunday_school','kids'=>'children_service','missions'=>'missions','contrib'=>'contributions','tithes'=>'tithes'] as $k=>$t)
    $m[$k]=gSum($pdo,$t,$mWhere);
$m['income']=array_sum($m); $m['expense']=gSum($pdo,'expenses',$mWhere); $m['net']=$m['income']-$m['expense']; $m['tithe20']=round($m['tithes']*0.20,2);
$mExpRows =gRows($pdo,'expenses',    $mWhere);
$mContribs=gRows($pdo,'contributions',$mWhere);
$mTithes  =gRows($pdo,'tithes',      $mWhere);

// Month-by-month for sparklines inside the month panel (last 6 months ending at selMonth)
$mTrend=[]; $mTrendLabels=[];
for($i=5;$i>=0;$i--){
    $mm=date('m',strtotime("-$i months", mktime(0,0,0,(int)$selM,1,(int)$selY)));
    $my=date('Y',strtotime("-$i months", mktime(0,0,0,(int)$selM,1,(int)$selY)));
    $mTrendLabels[]=date("M 'y",mktime(0,0,0,$mm,1,$my));
    $inc=0; foreach($incomeTables as $t) $inc+=gSum($pdo,$t,"WHERE MONTH(date)=$mm AND YEAR(date)=$my");
    $mTrend['income'][]=round($inc,2);
    $mTrend['expense'][]=round(gSum($pdo,'expenses',"WHERE MONTH(date)=$mm AND YEAR(date)=$my"),2);
    $mTrend['tithe'][]=round(gSum($pdo,'tithes',"WHERE MONTH(date)=$mm AND YEAR(date)=$my"),2);
    $mTrend['tithe20'][]=round(gSum($pdo,'tithes',"WHERE MONTH(date)=$mm AND YEAR(date)=$my")*0.20,2);
}

// Expense by category for month
$mExpCats=$pdo->query("SELECT category,COALESCE(SUM(amount),0) as total FROM expenses $mWhere GROUP BY category ORDER BY total DESC")->fetchAll();
$mExpCatLabels=array_column($mExpCats,'category');
$mExpCatData=array_map(fn($r)=>round($r['total'],2),$mExpCats);

/* ═══ YEARLY ═══ */
$selYear=(int)($_GET['year']??date('Y'));
$yWhere="WHERE YEAR(date)=$selYear";
$y=[];
foreach(['main'=>'main_offering','school'=>'sunday_school','kids'=>'children_service','missions'=>'missions','contrib'=>'contributions','tithes'=>'tithes'] as $k=>$t)
    $y[$k]=gSum($pdo,$t,$yWhere);
$y['income']=array_sum($y); $y['expense']=gSum($pdo,'expenses',$yWhere); $y['net']=$y['income']-$y['expense']; $y['tithe20']=round($y['tithes']*0.20,2);

$yMonthLabels=[]; $yMonthInc=[]; $yMonthExp=[]; $yMonthTithe=[]; $yMonthTithe20=[]; $yMonthNet=[];
$yStackedSets=[[],[],[],[],[],[]];
for($i=1;$i<=12;$i++){
    $yMonthLabels[]=date('M',mktime(0,0,0,$i,1));
    $inc=0; foreach($incomeTables as $idx=>$t){
        $v=gSum($pdo,$t,"WHERE YEAR(date)=$selYear AND MONTH(date)=$i");
        $inc+=$v;
        $yStackedSets[$idx][]=$v;
    }
    $exp=gSum($pdo,'expenses',"WHERE YEAR(date)=$selYear AND MONTH(date)=$i");
    $mT =gSum($pdo,'tithes',  "WHERE YEAR(date)=$selYear AND MONTH(date)=$i");
    $yMonthInc[]    =round($inc,2);
    $yMonthExp[]    =round($exp,2);
    $yMonthTithe[]  =round($mT,2);
    $yMonthTithe20[]=round($mT*0.20,2);
    $yMonthNet[]    =round($inc-$exp,2);
}
$yTitheBreakdown=[];
for($i=1;$i<=12;$i++){
    $mT=gSum($pdo,'tithes',"WHERE YEAR(date)=$selYear AND MONTH(date)=$i");
    $yTitheBreakdown[]=['month'=>date('F',mktime(0,0,0,$i,1)),'tithe'=>$mT,'alloc'=>round($mT*0.20,2)];
}

// Yearly expense by category
$yExpCats=$pdo->query("SELECT category,COALESCE(SUM(amount),0) as total FROM expenses $yWhere GROUP BY category ORDER BY total DESC")->fetchAll();
$yExpCatLabels=array_column($yExpCats,'category');
$yExpCatData=array_map(fn($r)=>round($r['total'],2),$yExpCats);

/* ═══ CSV EXPORT ═══ */
if(isset($_GET['export'])){
    $ep=$_GET['export'];
    header('Content-Type:text/csv');
    header('Content-Disposition:attachment;filename="church_finance_'.$ep.'_'.date('Ymd').'.csv"');
    $out=fopen('php://output','w');
    if($ep==='weekly'){
        fputcsv($out,['Weekly Report — '.$wLabel]);
        fputcsv($out,['Source','Amount (GH₵)']);
        foreach(['Main Offering'=>$w['main'],'Sunday School'=>$w['school'],'Children Service'=>$w['kids'],'Missions'=>$w['missions'],'Contributions'=>$w['contrib'],'Tithes'=>$w['tithes']] as $k=>$v) fputcsv($out,[$k,number_format($v,2)]);
        fputcsv($out,['TOTAL INCOME',number_format($w['income'],2)]);
        fputcsv($out,['TOTAL EXPENSES',number_format($w['expense'],2)]);
        fputcsv($out,['NET',number_format($w['net'],2)]);
        fputcsv($out,['20% TITHE ALLOCATION',number_format($w['tithe20'],2)]);
    } elseif($ep==='monthly'){
        fputcsv($out,['Monthly Report — '.$mLabel]);
        fputcsv($out,['Source','Amount (GH₵)']);
        foreach(['Main Offering'=>$m['main'],'Sunday School'=>$m['school'],'Children Service'=>$m['kids'],'Missions'=>$m['missions'],'Contributions'=>$m['contrib'],'Tithes'=>$m['tithes']] as $k=>$v) fputcsv($out,[$k,number_format($v,2)]);
        fputcsv($out,['TOTAL INCOME',number_format($m['income'],2)]);fputcsv($out,['TOTAL EXPENSES',number_format($m['expense'],2)]);fputcsv($out,['NET',number_format($m['net'],2)]);
        fputcsv($out,['TOTAL TITHES',number_format($m['tithes'],2)]);fputcsv($out,['20% ALLOCATION',number_format($m['tithe20'],2)]);
        fputcsv($out,[]);fputcsv($out,['-- TITHES --']);fputcsv($out,['Name','Amount','Date']);
        foreach($mTithes as $t) fputcsv($out,[$t['name'],$t['amount'],$t['date']]);
        fputcsv($out,[]);fputcsv($out,['-- CONTRIBUTIONS --']);fputcsv($out,['Name','Amount','Date','Description']);
        foreach($mContribs as $c) fputcsv($out,[$c['name'],$c['amount'],$c['date'],$c['description']??'']);
        fputcsv($out,[]);fputcsv($out,['-- EXPENSES --']);fputcsv($out,['Name','Category','Amount','Date']);
        foreach($mExpRows as $e) fputcsv($out,[$e['name'],$e['category'],$e['amount'],$e['date']]);
    } elseif($ep==='yearly'){
        fputcsv($out,['Yearly Report — '.$selYear]);
        fputcsv($out,['Source','Amount (GH₵)']);
        foreach(['Main Offering'=>$y['main'],'Sunday School'=>$y['school'],'Children Service'=>$y['kids'],'Missions'=>$y['missions'],'Contributions'=>$y['contrib'],'Tithes'=>$y['tithes']] as $k=>$v) fputcsv($out,[$k,number_format($v,2)]);
        fputcsv($out,['TOTAL INCOME',number_format($y['income'],2)]);fputcsv($out,['TOTAL EXPENSES',number_format($y['expense'],2)]);fputcsv($out,['NET',number_format($y['net'],2)]);
        fputcsv($out,['TOTAL TITHES',number_format($y['tithes'],2)]);fputcsv($out,['20% ANNUAL ALLOCATION',number_format($y['tithe20'],2)]);
        fputcsv($out,[]);fputcsv($out,['Month','Total Tithes','20% Allocation']);
        foreach($yTitheBreakdown as $r) fputcsv($out,[$r['month'],number_format($r['tithe'],2),number_format($r['alloc'],2)]);
    }
    fclose($out); exit;
}
$currentWeek=date('Y-\WW');
?>

<!-- NAV -->
<nav>
  <div class="nav-brand">
    <div class="nav-icon">&#10011;</div>
    <span class="nav-title">Church Finance</span>
  </div>
  <div class="nav-links">
    <a href="index.php">Dashboard</a>
    <a href="record.php">Record Income</a>
    <a href="expenses.php">Expenses</a>
    <a href="reports.php" class="active">Reports</a>
  </div>
</nav>

<div class="hero-strip">
  <h1>Financial Reports</h1>
  <p>Comprehensive graphical breakdowns — Weekly, Monthly &amp; Yearly &bull; 20% Tithe allocation calculated automatically</p>
</div>

<!-- PERIOD TABS -->
<div class="period-tabs">
  <button class="ptab active" onclick="showPeriod('weekly',this)">&#128197; Weekly</button>
  <button class="ptab"        onclick="showPeriod('monthly',this)">&#128198; Monthly</button>
  <button class="ptab"        onclick="showPeriod('yearly',this)">&#128202; Yearly</button>
</div>

<div class="container">

<!-- ══════════════════════════════════════
     WEEKLY PANEL
══════════════════════════════════════ -->
<div class="period-panel active" id="panel-weekly">
  <div class="toolbar">
    <div class="toolbar-left">
      <form method="GET" style="display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap;">
        <input type="hidden" name="month" value="<?= $selMonth ?>">
        <input type="hidden" name="year"  value="<?= $selYear ?>">
        <div class="filter-group">
          <label>Select Week</label>
          <input type="week" name="week" value="<?= htmlspecialchars($selWeek) ?>" onchange="this.form.submit()">
          <span class="week-hint">&#128197; <?= $wLabel ?></span>
        </div>
        <button type="button" class="btn-week" onclick="goNow()">This Week</button>
      </form>
    </div>
    <div class="toolbar-right">
      <a href="?export=weekly&week=<?= urlencode($selWeek) ?>&month=<?= $selMonth ?>&year=<?= $selYear ?>" class="btn-export">&#8659; CSV</a>
      <button onclick="window.print()" class="btn-print">&#128424; Print</button>
    </div>
  </div>

  <!-- STAT CARDS -->
  <div class="stats-row">
    <div class="sum-card c-gold"><div class="sum-label">Week Income</div><div class="sum-val gold">GH&#8373; <?= number_format($w['income'],2) ?></div><div class="sum-sub"><?= $wLabel ?></div></div>
    <div class="sum-card c-red"><div class="sum-label">Week Expenses</div><div class="sum-val neg">GH&#8373; <?= number_format($w['expense'],2) ?></div></div>
    <div class="sum-card c-green"><div class="sum-label">Net</div><div class="sum-val <?= $w['net']>=0?'pos':'neg' ?>">GH&#8373; <?= number_format(abs($w['net']),2) ?></div><div class="sum-sub"><?= $w['net']>=0?'Surplus':'Deficit' ?></div></div>
    <div class="sum-card c-gold"><div class="sum-label">Tithes</div><div class="sum-val gold">GH&#8373; <?= number_format($w['tithes'],2) ?></div></div>
    <div class="sum-card c-purple"><div class="sum-label">20% Tithe Alloc.</div><div class="sum-val purple">GH&#8373; <?= number_format($w['tithe20'],2) ?></div><div class="sum-sub">Tithes &times; 20%</div></div>
  </div>

  <div class="section-label">Visual Breakdown — <?= $wLabel ?></div>
  <div class="grid-3">
    <div class="chart-card c-gold">
      <h3>&#128202; Income vs Expenses</h3>
      <div class="csub">Comparison for the week</div>
      <canvas id="wBar" height="200"></canvas>
    </div>
    <div class="chart-card c-purple">
      <h3>&#129473; Income Sources</h3>
      <div class="csub">Doughnut by source</div>
      <canvas id="wPie" height="200"></canvas>
    </div>
    <div class="chart-card c-blue highlight">
      <h3>&#128200; Tithe vs 20% Allocation</h3>
      <div class="csub">Tithes &times; 20% = designated fund</div>
      <canvas id="wTithe" height="200"></canvas>
    </div>
  </div>

  <!-- BREAKDOWN TABLE -->
  <div class="section-card">
    <h3>Weekly Breakdown</h3>
    <?php $wSrc=[['Main Offering','badge-gold',$w['main']],['Sunday School','badge-blue',$w['school']],['Children Service','badge-pink',$w['kids']],['Missions','badge-purple',$w['missions']],['Contributions','badge-green',$w['contrib']],['Tithes','badge-gold',$w['tithes']]]; ?>
    <table>
      <thead><tr><th>Source</th><th>Amount</th><th>% of Income</th></tr></thead>
      <tbody>
      <?php foreach($wSrc as [$l,$b,$v]): $p=$w['income']>0?round($v/$w['income']*100,1):0; ?>
      <tr><td><span class="badge <?= $b ?>"><?= $l ?></span></td><td class="amount-pos">GH&#8373; <?= number_format($v,2) ?></td><td style="color:var(--muted)"><?= $p ?>%</td></tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="tfoot-row"><td>Total Income</td><td class="amount-pos">GH&#8373; <?= number_format($w['income'],2) ?></td><td></td></tr>
        <tr class="tfoot-row"><td>Total Expenses</td><td class="amount-neg">GH&#8373; <?= number_format($w['expense'],2) ?></td><td></td></tr>
        <tr class="tfoot-row t20"><td>&#128200; 20% Tithe Allocation</td><td class="amount-purple">GH&#8373; <?= number_format($w['tithe20'],2) ?></td><td style="color:var(--muted);font-size:0.8rem;">GH&#8373;<?= number_format($w['tithes'],2) ?> &times; 20%</td></tr>
      </tfoot>
    </table>
  </div>
</div><!-- /weekly -->

<!-- ══════════════════════════════════════
     MONTHLY PANEL
══════════════════════════════════════ -->
<div class="period-panel" id="panel-monthly">
  <div class="toolbar">
    <div class="toolbar-left">
      <form method="GET" style="display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap;">
        <input type="hidden" name="week" value="<?= htmlspecialchars($selWeek) ?>">
        <input type="hidden" name="year" value="<?= $selYear ?>">
        <div class="filter-group">
          <label>Select Month</label>
          <select name="month" onchange="this.form.submit()">
            <?php for($i=0;$i<24;$i++):$v=date('Y-m',strtotime("-$i months"));$l=date('F Y',strtotime("-$i months"));?>
            <option value="<?= $v ?>" <?= $v===$selMonth?'selected':'' ?>><?= $l ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </form>
    </div>
    <div class="toolbar-right">
      <a href="?export=monthly&month=<?= $selMonth ?>&week=<?= urlencode($selWeek) ?>&year=<?= $selYear ?>" class="btn-export">&#8659; CSV</a>
      <button onclick="window.print()" class="btn-print">&#128424; Print</button>
    </div>
  </div>

  <!-- STAT CARDS -->
  <div class="stats-row">
    <div class="sum-card c-gold"><div class="sum-label">Total Income</div><div class="sum-val gold">GH&#8373; <?= number_format($m['income'],2) ?></div><div class="sum-sub"><?= $mLabel ?></div></div>
    <div class="sum-card c-red"><div class="sum-label">Total Expenses</div><div class="sum-val neg">GH&#8373; <?= number_format($m['expense'],2) ?></div></div>
    <div class="sum-card c-green"><div class="sum-label">Net Balance</div><div class="sum-val <?= $m['net']>=0?'pos':'neg' ?>">GH&#8373; <?= number_format(abs($m['net']),2) ?></div><div class="sum-sub"><?= $m['net']>=0?'Surplus &#9650;':'Deficit &#9660;' ?></div></div>
    <div class="sum-card c-blue"><div class="sum-label">Core Sunday</div><div class="sum-val blue">GH&#8373; <?= number_format($m['main']+$m['school']+$m['kids'],2) ?></div></div>
    <div class="sum-card c-gold"><div class="sum-label">Total Tithes</div><div class="sum-val gold">GH&#8373; <?= number_format($m['tithes'],2) ?></div><div class="sum-sub"><?= count($mTithes) ?> record(s)</div></div>
    <div class="sum-card c-purple"><div class="sum-label">20% Tithe Alloc.</div><div class="sum-val purple">GH&#8373; <?= number_format($m['tithe20'],2) ?></div><div class="sum-sub">Designated fund</div></div>
  </div>

  <!-- 20% TITHE CALLOUT -->
  <div class="tithe-callout">
    <div class="tc-block">
      <div class="tc-label">Total Tithes — <?= $mLabel ?></div>
      <div class="tc-val tithes">GH&#8373; <?= number_format($m['tithes'],2) ?></div>
      <div class="tc-desc"><?= count($mTithes) ?> tithe record(s)</div>
    </div>
    <div class="tc-op">&times;&nbsp;20%&nbsp;=</div>
    <div class="tc-block">
      <div class="tc-label">Monthly 20% Allocation</div>
      <div class="tc-val alloc">GH&#8373; <?= number_format($m['tithe20'],2) ?></div>
      <div class="tc-desc">Designated fund for <?= $mLabel ?></div>
    </div>
    <?php if($m['tithes']>0): ?>
    <div style="flex:1;min-width:200px;max-width:280px;">
      <canvas id="mGauge" height="120"></canvas>
    </div>
    <?php endif; ?>
  </div>

  <!-- CHART ROW 1: Area + Sources donut -->
  <div class="section-label">Income &amp; Expense Trend</div>
  <div class="grid-3-1">
    <div class="chart-card c-gold">
      <h3>&#128202; 6-Month Income vs Expenses Trend</h3>
      <div class="csub">Area chart leading up to <?= $mLabel ?></div>
      <canvas id="mArea" height="110"></canvas>
    </div>
    <div class="chart-card c-purple">
      <h3>&#129473; Income Sources</h3>
      <div class="csub"><?= $mLabel ?></div>
      <canvas id="mPie" height="220"></canvas>
    </div>
  </div>

  <!-- CHART ROW 2: Horiz bar + Expense donut + Tithe bar -->
  <div class="section-label">Source &amp; Expense Analysis</div>
  <div class="grid-3">
    <div class="chart-card c-green">
      <h3>&#9646; Income by Source</h3>
      <div class="csub">Horizontal — <?= $mLabel ?></div>
      <canvas id="mHoriz" height="200"></canvas>
    </div>
    <div class="chart-card c-red">
      <h3>&#128179; Expenses by Category</h3>
      <div class="csub"><?= $mLabel ?></div>
      <?php if(empty($mExpCats)): ?><div class="empty-state">No expenses</div>
      <?php else: ?><canvas id="mExpPie" height="200"></canvas><?php endif; ?>
    </div>
    <div class="chart-card c-blue highlight">
      <h3>&#128200; Tithe vs 20% Allocation</h3>
      <div class="csub">6-month tithe trend &amp; allocation</div>
      <canvas id="mTitheArea" height="200"></canvas>
    </div>
  </div>

  <!-- DETAIL TABLES -->
  <?php if(!empty($mTithes)): ?>
  <div class="section-card">
    <h3>Tithes — <?= $mLabel ?> <a href="record.php?tab=tithes">&#9998; Manage</a></h3>
    <table>
      <thead><tr><th>Member</th><th>Amount</th><th>Date</th></tr></thead>
      <tbody>
      <?php foreach($mTithes as $t): ?>
      <tr><td><?= htmlspecialchars($t['name']) ?></td><td class="amount-pos">GH&#8373; <?= number_format($t['amount'],2) ?></td><td style="color:var(--muted)"><?= date('d M Y',strtotime($t['date'])) ?></td></tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="tfoot-row"><td>Total Tithes</td><td class="amount-pos">GH&#8373; <?= number_format($m['tithes'],2) ?></td><td></td></tr>
        <tr class="tfoot-row t20"><td>20% Allocation</td><td class="amount-purple">GH&#8373; <?= number_format($m['tithe20'],2) ?></td><td style="color:var(--muted);font-size:0.8rem;">Designated fund</td></tr>
      </tfoot>
    </table>
  </div>
  <?php endif; ?>

  <?php if(!empty($mContribs)): ?>
  <div class="section-card">
    <h3>Contributions — <?= $mLabel ?> <a href="record.php?tab=contributions">&#9998; Manage</a></h3>
    <table>
      <thead><tr><th>Name</th><th>Amount</th><th>Date</th><th>Note</th></tr></thead>
      <tbody>
      <?php foreach($mContribs as $c): ?>
      <tr><td><?= htmlspecialchars($c['name']) ?></td><td class="amount-pos">GH&#8373; <?= number_format($c['amount'],2) ?></td><td style="color:var(--muted)"><?= date('d M Y',strtotime($c['date'])) ?></td><td style="color:var(--muted);font-size:0.8rem"><?= htmlspecialchars(substr($c['description']??'',0,45)) ?></td></tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>

  <?php if(!empty($mExpRows)): ?>
  <div class="section-card">
    <h3>Expenses — <?= $mLabel ?> <a href="expenses.php">&#9998; Manage</a></h3>
    <table>
      <thead><tr><th>Name</th><th>Category</th><th>Amount</th><th>Date</th></tr></thead>
      <tbody>
      <?php foreach($mExpRows as $e): ?>
      <tr><td><?= htmlspecialchars($e['name']) ?></td><td><span class="badge badge-red"><?= htmlspecialchars($e['category']??'General') ?></span></td><td class="amount-neg">GH&#8373; <?= number_format($e['amount'],2) ?></td><td style="color:var(--muted)"><?= date('d M Y',strtotime($e['date'])) ?></td></tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot><tr class="tfoot-row"><td>Total</td><td></td><td class="amount-neg">GH&#8373; <?= number_format($m['expense'],2) ?></td><td></td></tr></tfoot>
    </table>
  </div>
  <?php endif; ?>
</div><!-- /monthly -->

<!-- ══════════════════════════════════════
     YEARLY PANEL
══════════════════════════════════════ -->
<div class="period-panel" id="panel-yearly">
  <div class="toolbar">
    <div class="toolbar-left">
      <form method="GET" style="display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap;">
        <input type="hidden" name="week"  value="<?= htmlspecialchars($selWeek) ?>">
        <input type="hidden" name="month" value="<?= $selMonth ?>">
        <div class="filter-group">
          <label>Select Year</label>
          <select name="year" onchange="this.form.submit()">
            <?php for($i=0;$i<6;$i++):$yr=date('Y')-$i;?><option value="<?= $yr ?>" <?= $yr===$selYear?'selected':'' ?>><?= $yr ?></option><?php endfor; ?>
          </select>
        </div>
      </form>
    </div>
    <div class="toolbar-right">
      <a href="?export=yearly&year=<?= $selYear ?>&week=<?= urlencode($selWeek) ?>&month=<?= $selMonth ?>" class="btn-export">&#8659; CSV</a>
      <button onclick="window.print()" class="btn-print">&#128424; Print</button>
    </div>
  </div>

  <!-- STAT CARDS -->
  <div class="stats-row">
    <div class="sum-card c-gold"><div class="sum-label"><?= $selYear ?> Income</div><div class="sum-val gold">GH&#8373; <?= number_format($y['income'],2) ?></div></div>
    <div class="sum-card c-red"><div class="sum-label"><?= $selYear ?> Expenses</div><div class="sum-val neg">GH&#8373; <?= number_format($y['expense'],2) ?></div></div>
    <div class="sum-card c-green"><div class="sum-label">Net Balance</div><div class="sum-val <?= $y['net']>=0?'pos':'neg' ?>">GH&#8373; <?= number_format(abs($y['net']),2) ?></div></div>
    <div class="sum-card c-gold"><div class="sum-label">Annual Tithes</div><div class="sum-val gold">GH&#8373; <?= number_format($y['tithes'],2) ?></div></div>
    <div class="sum-card c-purple"><div class="sum-label">Annual 20% Alloc.</div><div class="sum-val purple">GH&#8373; <?= number_format($y['tithe20'],2) ?></div><div class="sum-sub">GH&#8373;<?= number_format($y['tithes'],2) ?> &times; 20%</div></div>
  </div>

  <!-- CHART ROW 1: Area + Pie -->
  <div class="section-label">Annual Income &amp; Expenses</div>
  <div class="grid-3-1">
    <div class="chart-card c-gold">
      <h3>&#128202; Monthly Income vs Expenses — <?= $selYear ?></h3>
      <div class="csub">Area chart across all 12 months</div>
      <canvas id="yArea" height="110"></canvas>
    </div>
    <div class="chart-card c-purple">
      <h3>&#129473; Annual Income Sources</h3>
      <div class="csub"><?= $selYear ?> breakdown</div>
      <canvas id="yPie" height="220"></canvas>
    </div>
  </div>

  <!-- CHART ROW 2: Stacked + Net + Expense pie -->
  <div class="section-label">Composition &amp; Categories</div>
  <div class="grid-3">
    <div class="chart-card c-green">
      <h3>&#9646; Stacked Income by Source</h3>
      <div class="csub">All 6 sources per month — <?= $selYear ?></div>
      <canvas id="yStacked" height="200"></canvas>
    </div>
    <div class="chart-card c-blue">
      <h3>&#128201; Monthly Net Balance</h3>
      <div class="csub">Surplus / deficit each month</div>
      <canvas id="yNet" height="200"></canvas>
    </div>
    <div class="chart-card c-red">
      <h3>&#128179; Expenses by Category</h3>
      <div class="csub"><?= $selYear ?></div>
      <?php if(empty($yExpCats)): ?><div class="empty-state">No expenses</div>
      <?php else: ?><canvas id="yExpPie" height="200"></canvas><?php endif; ?>
    </div>
  </div>

  <!-- CHART ROW 3: Tithe charts -->
  <div class="section-label">20% Tithe Allocation — <?= $selYear ?></div>
  <div class="grid-2">
    <div class="chart-card c-purple highlight">
      <h3>&#128200; Monthly Tithe Collection vs 20% Allocation</h3>
      <div class="csub">Grouped bar — total tithes &amp; 20% designated fund per month</div>
      <canvas id="yTitheBar" height="120"></canvas>
    </div>
    <div class="chart-card c-blue">
      <h3>&#128201; 20% Allocation Trend Line</h3>
      <div class="csub">Monthly allocation curve with tithe baseline</div>
      <canvas id="yTitheArea" height="120"></canvas>
    </div>
  </div>

  <!-- TITHE BREAKDOWN TABLE -->
  <div class="section-card" style="border-color:rgba(139,92,246,0.25);">
    <h3 style="color:#C5A0FF;">&#128200; Monthly 20% Tithe Allocation Breakdown — <?= $selYear ?></h3>
    <table>
      <thead><tr><th>Month</th><th>Tithes Collected</th><th>20% Allocation</th><th>Status</th></tr></thead>
      <tbody>
      <?php $annT=0;$annA=0; foreach($yTitheBreakdown as $r): $annT+=$r['tithe'];$annA+=$r['alloc']; ?>
      <tr class="<?= $r['tithe']>0?'tithe-row':'' ?>">
        <td><?= $r['month'] ?></td>
        <td><?= $r['tithe']>0?'<span class="amount-pos">GH&#8373; '.number_format($r['tithe'],2).'</span>':'<span style="color:var(--muted)">—</span>' ?></td>
        <td><?= $r['alloc']>0?'<span class="amount-purple">GH&#8373; '.number_format($r['alloc'],2).'</span>':'<span style="color:var(--muted)">—</span>' ?></td>
        <td><?= $r['tithe']>0?'<span class="badge badge-purple">Calculated</span>':'<span class="badge" style="background:rgba(255,255,255,0.04);color:var(--muted)">No record</span>' ?></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="tfoot-row"><td>Annual Total</td><td class="amount-pos">GH&#8373; <?= number_format($annT,2) ?></td><td class="amount-purple">GH&#8373; <?= number_format($annA,2) ?></td><td></td></tr>
      </tfoot>
    </table>
  </div>

  <!-- ANNUAL BREAKDOWN TABLE -->
  <div class="section-card">
    <h3>Annual Income Breakdown — <?= $selYear ?></h3>
    <?php $ySrc=[['Main Offering','badge-gold',$y['main']],['Sunday School','badge-blue',$y['school']],['Children Service','badge-pink',$y['kids']],['Missions','badge-purple',$y['missions']],['Contributions','badge-green',$y['contrib']],['Tithes','badge-gold',$y['tithes']]]; ?>
    <table>
      <thead><tr><th>Source</th><th>Amount</th><th>% of Income</th></tr></thead>
      <tbody>
      <?php foreach($ySrc as [$l,$b,$v]): $p=$y['income']>0?round($v/$y['income']*100,1):0; ?>
      <tr><td><span class="badge <?= $b ?>"><?= $l ?></span></td><td class="amount-pos">GH&#8373; <?= number_format($v,2) ?></td><td style="color:var(--muted)"><?= $p ?>%</td></tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr class="tfoot-row"><td>Total Income</td><td class="amount-pos">GH&#8373; <?= number_format($y['income'],2) ?></td><td></td></tr>
        <tr class="tfoot-row"><td>Total Expenses</td><td class="amount-neg">GH&#8373; <?= number_format($y['expense'],2) ?></td><td></td></tr>
        <tr class="tfoot-row"><td>Net Balance</td><td class="<?= $y['net']>=0?'amount-pos':'amount-neg' ?>">GH&#8373; <?= number_format(abs($y['net']),2) ?></td><td></td></tr>
        <tr class="tfoot-row t20"><td>&#128200; 20% Annual Tithe Allocation</td><td class="amount-purple">GH&#8373; <?= number_format($y['tithe20'],2) ?></td><td style="color:var(--muted);font-size:0.8rem;">GH&#8373;<?= number_format($y['tithes'],2) ?> &times; 20%</td></tr>
      </tfoot>
    </table>
  </div>
</div><!-- /yearly -->
</div><!-- /container -->

<script>
Chart.defaults.color='#7A8FA8'; Chart.defaults.font.family='DM Sans'; Chart.defaults.font.size=11;
const GH=v=>'GH₵ '+Number(v).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});
const GRID='rgba(255,255,255,0.05)';
const COLORS=['#C8972A','#3A88D8','#E05DA0','#8B5CF6','#27C98A','#F0C96B'];
const G=(ctx,c1,c2)=>{const g=ctx.createLinearGradient(0,0,0,ctx.canvas.height);g.addColorStop(0,c1);g.addColorStop(1,c2);return g;};
const xAx=()=>({grid:{color:GRID},ticks:{color:'#7A8FA8'}});
const yAx=()=>({grid:{color:GRID},ticks:{color:'#7A8FA8',callback:v=>GH(v)}});

/* ── WEEKLY ── */
new Chart('wBar',{type:'bar',data:{labels:['Income','Expenses'],datasets:[{data:[<?= $w['income']?>,<?= $w['expense'] ?>],backgroundColor:['rgba(200,151,42,0.75)','rgba(224,79,79,0.7)'],borderRadius:8}]},options:{responsive:true,plugins:{legend:{display:false},tooltip:{callbacks:{label:c=>GH(c.parsed.y)}}},scales:{x:xAx(),y:yAx()}}});
new Chart('wPie',{type:'doughnut',data:{labels:<?= json_encode($srcLabels) ?>,datasets:[{data:[<?= $w['main']?>,<?= $w['school']?>,<?= $w['kids']?>,<?= $w['missions']?>,<?= $w['contrib']?>,<?= $w['tithes'] ?>],backgroundColor:COLORS,borderColor:'#142236',borderWidth:3,hoverOffset:8}]},options:{responsive:true,cutout:'65%',plugins:{legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:8,font:{size:10}}},tooltip:{callbacks:{label:c=>c.label+': '+GH(c.parsed)}}}}});
new Chart('wTithe',{type:'bar',data:{labels:['Total Tithes','20% Allocation'],datasets:[{data:[<?= $w['tithes']?>,<?= $w['tithe20'] ?>],backgroundColor:['rgba(200,151,42,0.65)','rgba(139,92,246,0.8)'],borderColor:['#C8972A','#8B5CF6'],borderWidth:1.5,borderRadius:10}]},options:{responsive:true,plugins:{legend:{display:false},tooltip:{callbacks:{label:c=>GH(c.parsed.y)}}},scales:{x:xAx(),y:yAx()}}});

/* ── MONTHLY AREA ── */
const mACtx=document.getElementById('mArea').getContext('2d');
new Chart(mACtx,{type:'line',data:{labels:<?= json_encode($mTrendLabels) ?>,datasets:[{label:'Income',data:<?= json_encode($mTrend['income']) ?>,borderColor:'#C8972A',borderWidth:2.5,pointRadius:4,pointBackgroundColor:'#C8972A',pointBorderColor:'#142236',pointBorderWidth:2,fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(200,151,42,0.3)','rgba(200,151,42,0.01)');},tension:0.4},{label:'Expenses',data:<?= json_encode($mTrend['expense']) ?>,borderColor:'#E04F4F',borderWidth:2,pointRadius:4,pointBackgroundColor:'#E04F4F',pointBorderColor:'#142236',pointBorderWidth:2,fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(224,79,79,0.18)','rgba(224,79,79,0.01)');},tension:0.4,borderDash:[5,3]}]},options:{responsive:true,interaction:{mode:'index',intersect:false},plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:12}},tooltip:{callbacks:{label:c=>c.dataset.label+': '+GH(c.parsed.y)}}},scales:{x:xAx(),y:yAx()}}});

/* Monthly pie, horiz, expense pie */
new Chart('mPie',{type:'doughnut',data:{labels:<?= json_encode($srcLabels) ?>,datasets:[{data:[<?= $m['main']?>,<?= $m['school']?>,<?= $m['kids']?>,<?= $m['missions']?>,<?= $m['contrib']?>,<?= $m['tithes'] ?>],backgroundColor:COLORS,borderColor:'#142236',borderWidth:3,hoverOffset:8}]},options:{responsive:true,cutout:'65%',plugins:{legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:8,font:{size:10}}},tooltip:{callbacks:{label:c=>c.label+': '+GH(c.parsed)}}}}});
new Chart('mHoriz',{type:'bar',data:{labels:<?= json_encode($srcLabels) ?>,datasets:[{label:'GH₵',data:[<?= $m['main']?>,<?= $m['school']?>,<?= $m['kids']?>,<?= $m['missions']?>,<?= $m['contrib']?>,<?= $m['tithes'] ?>],backgroundColor:COLORS.map(c=>c+'CC'),borderRadius:5,borderSkipped:false}]},options:{indexAxis:'y',responsive:true,plugins:{legend:{display:false},tooltip:{callbacks:{label:c=>GH(c.parsed.x)}}},scales:{x:yAx(),y:{...xAx(),ticks:{color:'#EAD9BE',font:{size:10}}}}}});
<?php if(!empty($mExpCats)): ?>
new Chart('mExpPie',{type:'doughnut',data:{labels:<?= json_encode($mExpCatLabels) ?>,datasets:[{data:<?= json_encode($mExpCatData) ?>,backgroundColor:['#E04F4F','#E05DA0','#F08040','#8B5CF6','#3A88D8','#27C98A','#C8972A','#F0C96B'],borderColor:'#142236',borderWidth:3,hoverOffset:8}]},options:{responsive:true,cutout:'58%',plugins:{legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:8,font:{size:10}}},tooltip:{callbacks:{label:c=>c.label+': '+GH(c.parsed)}}}}});
<?php endif; ?>

/* Monthly tithe area */
const mTACtx=document.getElementById('mTitheArea').getContext('2d');
new Chart(mTACtx,{type:'line',data:{labels:<?= json_encode($mTrendLabels) ?>,datasets:[{label:'Total Tithes',data:<?= json_encode($mTrend['tithe']) ?>,borderColor:'#C8972A',borderWidth:2,pointRadius:4,pointBackgroundColor:'#C8972A',fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(200,151,42,0.25)','rgba(200,151,42,0.01)');},tension:0.4},{label:'20% Allocation',data:<?= json_encode($mTrend['tithe20']) ?>,borderColor:'#8B5CF6',borderWidth:2.5,pointRadius:4,pointBackgroundColor:'#8B5CF6',fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(139,92,246,0.3)','rgba(139,92,246,0.01)');},tension:0.4}]},options:{responsive:true,interaction:{mode:'index',intersect:false},plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:10}},tooltip:{callbacks:{label:c=>c.dataset.label+': '+GH(c.parsed.y)}}},scales:{x:xAx(),y:yAx()}}});

/* Monthly tithe gauge */
<?php if($m['tithes']>0): ?>
new Chart('mGauge',{type:'doughnut',data:{labels:['20% Allocation','Remaining 80%'],datasets:[{data:[<?= $m['tithe20']?>,<?= round($m['tithes']*0.80,2) ?>],backgroundColor:['rgba(139,92,246,0.85)','rgba(200,151,42,0.2)'],borderColor:['#8B5CF6','rgba(200,151,42,0.4)'],borderWidth:2}]},options:{responsive:true,cutout:'68%',plugins:{legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:6,font:{size:9}}},tooltip:{callbacks:{label:c=>c.label+': '+GH(c.parsed)}}}}});
<?php endif; ?>

/* ── YEARLY AREA ── */
const yACtx=document.getElementById('yArea').getContext('2d');
new Chart(yACtx,{type:'line',data:{labels:<?= json_encode($yMonthLabels) ?>,datasets:[{label:'Income',data:<?= json_encode($yMonthInc) ?>,borderColor:'#C8972A',borderWidth:2.5,pointRadius:3,pointBackgroundColor:'#C8972A',fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(200,151,42,0.3)','rgba(200,151,42,0.01)');},tension:0.4},{label:'Expenses',data:<?= json_encode($yMonthExp) ?>,borderColor:'#E04F4F',borderWidth:2,pointRadius:3,pointBackgroundColor:'#E04F4F',fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(224,79,79,0.15)','rgba(224,79,79,0.01)');},tension:0.4,borderDash:[5,3]}]},options:{responsive:true,interaction:{mode:'index',intersect:false},plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:12}},tooltip:{callbacks:{label:c=>c.dataset.label+': '+GH(c.parsed.y)}}},scales:{x:xAx(),y:yAx()}}});

/* Yearly pie */
new Chart('yPie',{type:'doughnut',data:{labels:<?= json_encode($srcLabels) ?>,datasets:[{data:[<?= $y['main']?>,<?= $y['school']?>,<?= $y['kids']?>,<?= $y['missions']?>,<?= $y['contrib']?>,<?= $y['tithes'] ?>],backgroundColor:COLORS,borderColor:'#142236',borderWidth:3,hoverOffset:8}]},options:{responsive:true,cutout:'65%',plugins:{legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:8,font:{size:10}}},tooltip:{callbacks:{label:c=>c.label+': '+GH(c.parsed)}}}}});

/* Stacked */
new Chart('yStacked',{type:'bar',data:{labels:<?= json_encode($yMonthLabels) ?>,datasets:[
  {label:'Main Offering', data:<?= json_encode($yStackedSets[0]) ?>,backgroundColor:'rgba(200,151,42,0.85)',borderRadius:0},
  {label:'Sunday School', data:<?= json_encode($yStackedSets[1]) ?>,backgroundColor:'rgba(58,136,216,0.8)'},
  {label:'Children Svc',  data:<?= json_encode($yStackedSets[2]) ?>,backgroundColor:'rgba(224,93,160,0.8)'},
  {label:'Missions',      data:<?= json_encode($yStackedSets[3]) ?>,backgroundColor:'rgba(139,92,246,0.8)'},
  {label:'Contributions', data:<?= json_encode($yStackedSets[4]) ?>,backgroundColor:'rgba(39,201,138,0.8)'},
  {label:'Tithes',        data:<?= json_encode($yStackedSets[5]) ?>,backgroundColor:'rgba(240,201,107,0.8)',borderRadius:{topLeft:5,topRight:5}}
]},options:{responsive:true,interaction:{mode:'index',intersect:false},plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:8,padding:8,font:{size:9}}}},scales:{x:{...xAx(),stacked:true},y:{...yAx(),stacked:true}}}});

/* Net balance bar */
new Chart('yNet',{type:'bar',data:{labels:<?= json_encode($yMonthLabels) ?>,datasets:[{label:'Net Balance',data:<?= json_encode($yMonthNet) ?>,backgroundColor:<?= json_encode($yMonthNet) ?>.map(v=>v>=0?'rgba(39,201,138,0.75)':'rgba(224,79,79,0.75)'),borderColor:<?= json_encode($yMonthNet) ?>.map(v=>v>=0?'#27C98A':'#E04F4F'),borderWidth:1.5,borderRadius:5}]},options:{responsive:true,plugins:{legend:{display:false},tooltip:{callbacks:{label:c=>GH(c.parsed.y)}}},scales:{x:xAx(),y:{...yAx()}}}});

/* Yearly expense donut */
<?php if(!empty($yExpCats)): ?>
new Chart('yExpPie',{type:'doughnut',data:{labels:<?= json_encode($yExpCatLabels) ?>,datasets:[{data:<?= json_encode($yExpCatData) ?>,backgroundColor:['#E04F4F','#E05DA0','#F08040','#8B5CF6','#3A88D8','#27C98A','#C8972A','#F0C96B'],borderColor:'#142236',borderWidth:3,hoverOffset:8}]},options:{responsive:true,cutout:'58%',plugins:{legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:8,font:{size:10}}},tooltip:{callbacks:{label:c=>c.label+': '+GH(c.parsed)}}}}});
<?php endif; ?>

/* Yearly tithe grouped bar */
new Chart('yTitheBar',{type:'bar',data:{labels:<?= json_encode($yMonthLabels) ?>,datasets:[{label:'Total Tithes',data:<?= json_encode($yMonthTithe) ?>,backgroundColor:'rgba(200,151,42,0.65)',borderColor:'#C8972A',borderWidth:1.5,borderRadius:5},{label:'20% Allocation',data:<?= json_encode($yMonthTithe20) ?>,backgroundColor:'rgba(139,92,246,0.8)',borderColor:'#8B5CF6',borderWidth:1.5,borderRadius:5}]},options:{responsive:true,interaction:{mode:'index',intersect:false},plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:10}},tooltip:{callbacks:{label:c=>c.dataset.label+': '+GH(c.parsed.y)}}},scales:{x:xAx(),y:yAx()}}});

/* Yearly tithe area */
const yTACtx=document.getElementById('yTitheArea').getContext('2d');
new Chart(yTACtx,{type:'line',data:{labels:<?= json_encode($yMonthLabels) ?>,datasets:[{label:'Tithes',data:<?= json_encode($yMonthTithe) ?>,borderColor:'#C8972A',borderWidth:2,pointRadius:3,pointBackgroundColor:'#C8972A',fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(200,151,42,0.2)','rgba(200,151,42,0.01)');},tension:0.4},{label:'20% Allocation',data:<?= json_encode($yMonthTithe20) ?>,borderColor:'#8B5CF6',borderWidth:2.5,pointRadius:3,pointBackgroundColor:'#8B5CF6',fill:true,backgroundColor:function(c){return G(c.chart.ctx,'rgba(139,92,246,0.3)','rgba(139,92,246,0.01)');},tension:0.4}]},options:{responsive:true,interaction:{mode:'index',intersect:false},plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:10}},tooltip:{callbacks:{label:c=>c.dataset.label+': '+GH(c.parsed.y)}}},scales:{x:xAx(),y:yAx()}}});

/* ── TAB SWITCHER ── */
function showPeriod(id,btn){
  document.querySelectorAll('.period-panel').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.ptab').forEach(b=>b.classList.remove('active'));
  document.getElementById('panel-'+id).classList.add('active');
  btn.classList.add('active');
}
function goNow(){const u=new URL(window.location);u.searchParams.set('week','<?= $currentWeek ?>');window.location=u;}
</script>
</body>
</html>