<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard – Church Finance</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@3"></script>
<style>
:root{
  --gold:#C8972A; --gold-light:#F0C96B; --gold-dim:rgba(200,151,42,0.15);
  --deep:#080F1A; --panel:#0F1C2E; --card:#142236; --card2:#192B40;
  --border:rgba(200,151,42,0.18); --border2:rgba(255,255,255,0.06);
  --text:#EAD9BE; --muted:#7A8FA8; --faint:#3A4F65;
  --success:#27C98A; --danger:#E04F4F; --accent:#3A88D8;
  --purple:#8B5CF6; --pink:#E05DA0;
  --radius:14px; --radius-sm:8px;
}
*{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{background:var(--deep);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;overflow-x:hidden;}

/* GRAIN OVERLAY */
body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:0;opacity:0.4;}

/* NAV */
nav{background:rgba(8,15,26,0.92);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);padding:0 2.5rem;display:flex;align-items:center;justify-content:space-between;height:62px;position:sticky;top:0;z-index:100;}
.nav-brand{display:flex;align-items:center;gap:14px;}
.nav-icon{width:38px;height:38px;background:linear-gradient(135deg,var(--gold),var(--gold-light));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;box-shadow:0 4px 16px rgba(200,151,42,0.3);}
.nav-title{font-family:'Cormorant Garamond',serif;font-size:1.25rem;color:var(--gold-light);letter-spacing:0.5px;}
.nav-links{display:flex;gap:2px;}
.nav-links a{color:var(--muted);text-decoration:none;padding:7px 15px;border-radius:7px;font-size:0.86rem;font-weight:500;transition:all 0.2s;letter-spacing:0.3px;}
.nav-links a:hover,.nav-links a.active{background:rgba(200,151,42,0.1);color:var(--gold-light);}

/* HERO STRIP */
.hero-strip{background:linear-gradient(135deg,rgba(200,151,42,0.08) 0%,rgba(14,28,48,0) 60%);border-bottom:1px solid var(--border2);padding:2rem 2.5rem 1.4rem;}
.hero-top{display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:1rem;margin-bottom:1.2rem;}
.hero-top h1{font-family:'Cormorant Garamond',serif;font-size:2.2rem;color:var(--gold-light);font-weight:700;line-height:1.1;}
.hero-top p{color:var(--muted);font-size:0.88rem;margin-top:4px;}
.month-picker{display:flex;align-items:center;gap:8px;}
.month-picker input{background:#0F1C2E;border:1px solid var(--border);color:var(--text);padding:8px 14px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.86rem;outline:none;}
.month-picker input:focus{border-color:var(--gold);}
.btn-go{background:linear-gradient(135deg,var(--gold),var(--gold-light));color:#080F1A;border:none;padding:8px 18px;border-radius:8px;font-family:'DM Sans',sans-serif;font-weight:600;font-size:0.86rem;cursor:pointer;}
.btn-ghost{background:rgba(255,255,255,0.05);color:var(--muted);border:1px solid var(--border2);padding:8px 14px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.86rem;cursor:pointer;text-decoration:none;display:inline-block;}
.btn-ghost:hover{background:rgba(255,255,255,0.09);color:var(--text);}

/* STAT CARDS */
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:1rem;margin-bottom:1.5rem;position:relative;z-index:1;}
.stat-card{background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);padding:1.3rem 1.4rem;position:relative;overflow:hidden;cursor:default;transition:transform 0.2s,box-shadow 0.2s;}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,0.35);}
.stat-card::after{content:'';position:absolute;top:0;left:0;right:0;height:2px;border-radius:var(--radius) var(--radius) 0 0;}
.stat-card.c-gold::after{background:linear-gradient(90deg,var(--gold),var(--gold-light));}
.stat-card.c-red::after{background:linear-gradient(90deg,var(--danger),#FF9090);}
.stat-card.c-green::after{background:linear-gradient(90deg,var(--success),#7EEDC4);}
.stat-card.c-blue::after{background:linear-gradient(90deg,var(--accent),#8EC5F5);}
.stat-card.c-purple::after{background:linear-gradient(90deg,var(--purple),#C5A0FF);}
.stat-label{font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;}
.stat-value{font-size:1.55rem;font-weight:600;line-height:1.1;margin-bottom:4px;}
.stat-value.pos{color:var(--success);}
.stat-value.neg{color:var(--danger);}
.stat-value.gold{color:var(--gold-light);}
.stat-value.blue{color:#8EC5F5;}
.stat-value.purple{color:#C5A0FF;}
.stat-sub{font-size:0.74rem;color:var(--muted);}
.stat-sparkline{position:absolute;bottom:0;right:0;width:80px;height:40px;opacity:0.5;}
.stat-icon{position:absolute;top:1.2rem;right:1.2rem;font-size:1.4rem;opacity:0.18;}

/* CONTAINER */
.container{max-width:1380px;margin:0 auto;padding:0 2.5rem 3rem;}

/* SECTION LABEL */
.section-label{font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:1rem;display:flex;align-items:center;gap:10px;}
.section-label::after{content:'';flex:1;height:1px;background:var(--border2);}

/* CHART GRID LAYOUTS */
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem;}
.grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.2rem;margin-bottom:1.2rem;}
.grid-3-1{display:grid;grid-template-columns:2fr 1fr;gap:1.2rem;margin-bottom:1.2rem;}
.grid-1-2{display:grid;grid-template-columns:1fr 2fr;gap:1.2rem;margin-bottom:1.2rem;}
@media(max-width:1100px){.grid-3{grid-template-columns:1fr 1fr;}.grid-3-1,.grid-1-2{grid-template-columns:1fr;}}
@media(max-width:700px){.grid-2,.grid-3,.grid-3-1,.grid-1-2{grid-template-columns:1fr;}}

/* CHART CARDS */
.chart-card{background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);padding:1.5rem;position:relative;overflow:hidden;}
.chart-card::before{content:'';position:absolute;top:0;left:0;bottom:0;width:3px;border-radius:var(--radius) 0 0 var(--radius);}
.chart-card.c-gold::before{background:linear-gradient(180deg,var(--gold),var(--gold-light));}
.chart-card.c-green::before{background:linear-gradient(180deg,var(--success),#7EEDC4);}
.chart-card.c-blue::before{background:linear-gradient(180deg,var(--accent),#8EC5F5);}
.chart-card.c-purple::before{background:linear-gradient(180deg,var(--purple),#C5A0FF);}
.chart-card.c-red::before{background:linear-gradient(180deg,var(--danger),#FF9090);}
.chart-card.c-pink::before{background:linear-gradient(180deg,var(--pink),#FFB0D0);}
.chart-card h3{font-family:'Cormorant Garamond',serif;font-size:1.05rem;color:var(--gold-light);margin-bottom:0.3rem;font-weight:600;}
.chart-card .chart-sub{font-size:0.76rem;color:var(--muted);margin-bottom:1rem;}
.chart-card.featured{border-color:rgba(200,151,42,0.25);background:linear-gradient(135deg,var(--card) 70%,rgba(200,151,42,0.04));}
.chart-card.featured h3{font-size:1.15rem;}

/* ALERT */
.alert{padding:11px 16px;border-radius:9px;margin-bottom:1rem;font-size:0.86rem;display:flex;gap:10px;align-items:center;border:1px solid;}
.alert.warn{background:rgba(240,180,0,0.08);border-color:rgba(240,180,0,0.25);color:#F0C96B;}
.alert.danger{background:rgba(224,79,79,0.08);border-color:rgba(224,79,79,0.25);color:#FF9090;}

/* TABLES */
.section-card{background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);padding:1.5rem;margin-bottom:1.2rem;}
.section-card h3{font-family:'Cormorant Garamond',serif;color:var(--gold-light);font-size:1.05rem;margin-bottom:1rem;font-weight:600;display:flex;justify-content:space-between;align-items:center;}
.section-card h3 a{font-family:'DM Sans',sans-serif;font-size:0.78rem;color:var(--gold);text-decoration:none;font-weight:500;}
table{width:100%;border-collapse:collapse;}
th{text-align:left;font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;padding:8px 10px;border-bottom:1px solid var(--border2);}
td{padding:9px 10px;font-size:0.86rem;border-bottom:1px solid rgba(255,255,255,0.03);}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(200,151,42,0.03);}
.badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:0.72rem;font-weight:500;}
.badge-gold{background:rgba(200,151,42,0.15);color:var(--gold-light);}
.badge-blue{background:rgba(58,136,216,0.15);color:#8EC5F5;}
.badge-green{background:rgba(39,201,138,0.15);color:var(--success);}
.badge-red{background:rgba(224,79,79,0.15);color:#FF9090;}
.badge-purple{background:rgba(139,92,246,0.15);color:#C5A0FF;}
.badge-pink{background:rgba(224,93,160,0.15);color:#FFB0D0;}
.amount-pos{color:var(--success);font-weight:500;}
.amount-neg{color:var(--danger);font-weight:500;}
.empty-state{text-align:center;padding:2rem;color:var(--muted);font-size:0.88rem;}

/* ANIMATE IN */
@keyframes fadeUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:translateY(0);}}
.stat-card{animation:fadeUp 0.4s ease both;}
.stat-card:nth-child(1){animation-delay:0.05s;}
.stat-card:nth-child(2){animation-delay:0.1s;}
.stat-card:nth-child(3){animation-delay:0.15s;}
.stat-card:nth-child(4){animation-delay:0.2s;}
.stat-card:nth-child(5){animation-delay:0.25s;}
.stat-card:nth-child(6){animation-delay:0.3s;}
.chart-card{animation:fadeUp 0.5s ease both;animation-delay:0.3s;}
</style>
</head>
<body>

<?php
include 'db.php';

$filterMonth    = $_GET['month'] ?? date('Y-m');
[$fY, $fM]      = explode('-', $filterMonth);
$fLabel         = date('F Y', mktime(0,0,0,(int)$fM,1,(int)$fY));
$isCurrentMonth = ($fY == date('Y') && $fM == date('m'));

function mSum($pdo,$table,$m,$y){
    return (float)$pdo->query("SELECT COALESCE(SUM(amount),0) as v FROM $table WHERE MONTH(date)=$m AND YEAR(date)=$y")->fetch()['v'];
}

$incomeTables = ['main_offering','sunday_school','children_service','missions','contributions','tithes'];

/* ── Monthly totals ── */
$src = [];
foreach(['main_offering','sunday_school','children_service','missions','contributions','tithes'] as $t)
    $src[$t] = mSum($pdo,$t,$fM,$fY);
$monthIncome  = array_sum($src);
$monthExpense = mSum($pdo,'expenses',$fM,$fY);
$balance      = $monthIncome - $monthExpense;
$tithe20      = round($src['tithes'] * 0.20, 2);
$sundayCore   = $src['main_offering'] + $src['sunday_school'] + $src['children_service'];

/* ── Week income ── */
$weekIncome = 0;
foreach($incomeTables as $t)
    $weekIncome += (float)$pdo->query("SELECT COALESCE(SUM(amount),0) as v FROM $t WHERE YEARWEEK(date,1)=YEARWEEK(CURDATE(),1)")->fetch()['v'];

/* ── Sunday count ── */
$sundayCount = (int)$pdo->query("SELECT COUNT(DISTINCT date) as c FROM main_offering WHERE MONTH(date)=$fM AND YEAR(date)=$fY")->fetch()['c'];

/* ── Alerts ── */
$alerts = [];
if ($isCurrentMonth) {
    $day = mktime(0,0,0,(int)$fM,1,(int)$fY);
    $today = strtotime('today');
    while ($day <= $today) {
        if (date('N',$day)==7) {
            $ds = date('Y-m-d',$day);
            $cnt = (int)$pdo->query("SELECT COUNT(*) as c FROM main_offering WHERE date='$ds'")->fetch()['c'];
            if (!$cnt) $alerts[] = ['warn','⚠️',"No offering recorded for <strong>".date('D, d M Y',$day)."</strong>"];
        }
        $day = strtotime('+1 day',$day);
    }
    if ($balance < 0) $alerts[] = ['danger','🔴',"Month running a <strong>deficit of GH&#8373; ".number_format(abs($balance),2)."</strong> — expenses exceed income"];
}

/* ── Last 8 months trend ── */
$trendLabels=[]; $trendIncome=[]; $trendExpense=[]; $trendNet=[];
for($i=7;$i>=0;$i--){
    $bm=date('m',strtotime("-$i months")); $by=date('Y',strtotime("-$i months"));
    $trendLabels[] = date("M 'y",strtotime("-$i months"));
    $inc=0; foreach($incomeTables as $t) $inc+=mSum($pdo,$t,$bm,$by);
    $exp=mSum($pdo,'expenses',$bm,$by);
    $trendIncome[]  = round($inc,2);
    $trendExpense[] = round($exp,2);
    $trendNet[]     = round($inc-$exp,2);
}

/* ── Income sources breakdown ── */
$srcLabels = ['Main Offering','Sunday School','Children Service','Missions','Contributions','Tithes'];
$srcKeys   = ['main_offering','sunday_school','children_service','missions','contributions','tithes'];
$srcData   = array_map(fn($k)=>round($src[$k],2), $srcKeys);

/* ── Expense by category ── */
$expCats = $pdo->query("SELECT category, COALESCE(SUM(amount),0) as total FROM expenses WHERE MONTH(date)=$fM AND YEAR(date)=$fY GROUP BY category ORDER BY total DESC")->fetchAll();
$expCatLabels = array_column($expCats,'category');
$expCatData   = array_map(fn($r)=>round($r['total'],2), $expCats);

/* ── Sunday by Sunday ── */
$sundays = $pdo->query("
  SELECT d.date,
    (SELECT COALESCE(SUM(amount),0) FROM main_offering WHERE date=d.date) as main_off,
    (SELECT COALESCE(SUM(amount),0) FROM sunday_school WHERE date=d.date) as school,
    (SELECT COALESCE(SUM(amount),0) FROM children_service WHERE date=d.date) as kids
  FROM (
    SELECT DISTINCT date FROM main_offering WHERE MONTH(date)=$fM AND YEAR(date)=$fY
    UNION SELECT DISTINCT date FROM sunday_school WHERE MONTH(date)=$fM AND YEAR(date)=$fY
    UNION SELECT DISTINCT date FROM children_service WHERE MONTH(date)=$fM AND YEAR(date)=$fY
  ) d ORDER BY date ASC
")->fetchAll();
$sundayDates  = array_map(fn($s)=>date('d M',strtotime($s['date'])), $sundays);
$sundayMain   = array_map(fn($s)=>round($s['main_off'],2), $sundays);
$sundaySchool = array_map(fn($s)=>round($s['school'],2), $sundays);
$sundayKids   = array_map(fn($s)=>round($s['kids'],2), $sundays);
$sundayTotals = array_map(fn($s)=>round($s['main_off']+$s['school']+$s['kids'],2), $sundays);

/* ── Yearly monthly totals for radar ── */
$radarInc=[]; $radarExp=[];
for($i=1;$i<=12;$i++){
    $inc2=0; foreach($incomeTables as $t){ $s=$pdo->query("SELECT COALESCE(SUM(amount),0) as v FROM $t WHERE YEAR(date)=$fY AND MONTH(date)=$i"); $inc2+=$s->fetch()['v']; }
    $radarInc[]=round($inc2,2);
    $radarExp[]=round(mSum($pdo,'expenses',$i,$fY),2);
}

/* ── Recent transactions ── */
$recent = $pdo->query("
  SELECT 'Main Offering' as source, amount, date FROM main_offering WHERE MONTH(date)=$fM AND YEAR(date)=$fY
  UNION ALL SELECT 'Sunday School', amount, date FROM sunday_school WHERE MONTH(date)=$fM AND YEAR(date)=$fY
  UNION ALL SELECT 'Children Service', amount, date FROM children_service WHERE MONTH(date)=$fM AND YEAR(date)=$fY
  UNION ALL SELECT 'Missions', amount, date FROM missions WHERE MONTH(date)=$fM AND YEAR(date)=$fY
  UNION ALL SELECT 'Contribution', amount, date FROM contributions WHERE MONTH(date)=$fM AND YEAR(date)=$fY
  UNION ALL SELECT 'Tithe', amount, date FROM tithes WHERE MONTH(date)=$fM AND YEAR(date)=$fY
  ORDER BY date DESC LIMIT 10
")->fetchAll();
$recentExp = $pdo->query("SELECT * FROM expenses WHERE MONTH(date)=$fM AND YEAR(date)=$fY ORDER BY date DESC LIMIT 8")->fetchAll();
?>

<!-- NAV -->
<nav>
  <div class="nav-brand">
    <div class="nav-icon">&#10011;</div>
    <span class="nav-title">Church Finance</span>
  </div>
  <div class="nav-links">
    <a href="index.php" class="active">Dashboard</a>
    <a href="record.php">Record Income</a>
    <a href="expenses.php">Expenses</a>
    <a href="reports.php">Reports</a>
  </div>
</nav>

<!-- HERO -->
<div class="hero-strip">
  <div class="hero-top">
    <div>
      <h1>Finance Dashboard</h1>
      <p>&#128336; <?= $fLabel ?> &nbsp;&bull;&nbsp; <?= $sundayCount ?> Sunday(s) recorded &nbsp;&bull;&nbsp; <?= date('l, d F Y') ?></p>
    </div>
    <form method="GET" class="month-picker">
      <input type="month" name="month" value="<?= $filterMonth ?>">
      <button type="submit" class="btn-go">Go</button>
      <?php if(!$isCurrentMonth): ?><a href="index.php" class="btn-ghost">&#8592; Now</a><?php endif; ?>
    </form>
  </div>

  <?php foreach($alerts as [$type,$icon,$msg]): ?>
  <div class="alert <?= $type ?>"><?= $icon ?> <span><?= $msg ?></span></div>
  <?php endforeach; ?>
</div>

<div class="container" style="padding-top:1.8rem;">

<!-- ══ STAT CARDS ══ -->
<div class="stats-row">
  <div class="stat-card c-gold">
    <div class="stat-icon">&#128181;</div>
    <div class="stat-label">Monthly Income</div>
    <div class="stat-value gold">GH&#8373; <?= number_format($monthIncome,2) ?></div>
    <div class="stat-sub"><?= $fLabel ?></div>
  </div>
  <div class="stat-card c-red">
    <div class="stat-icon">&#128203;</div>
    <div class="stat-label">Monthly Expenses</div>
    <div class="stat-value neg">GH&#8373; <?= number_format($monthExpense,2) ?></div>
    <div class="stat-sub"><?= $fLabel ?></div>
  </div>
  <div class="stat-card c-green">
    <div class="stat-icon">&#9878;</div>
    <div class="stat-label">Net Balance</div>
    <div class="stat-value <?= $balance>=0?'pos':'neg' ?>">GH&#8373; <?= number_format(abs($balance),2) ?></div>
    <div class="stat-sub"><?= $balance>=0?'Surplus &#9650;':'Deficit &#9660;' ?></div>
  </div>
  <div class="stat-card c-blue">
    <div class="stat-icon">&#128197;</div>
    <div class="stat-label">This Week</div>
    <div class="stat-value blue">GH&#8373; <?= number_format($weekIncome,2) ?></div>
    <div class="stat-sub">Current week income</div>
  </div>
  <div class="stat-card c-gold">
    <div class="stat-icon">&#9749;</div>
    <div class="stat-label">Core Sunday Income</div>
    <div class="stat-value gold">GH&#8373; <?= number_format($sundayCore,2) ?></div>
    <div class="stat-sub">Offering + School + Children</div>
  </div>
  <div class="stat-card c-purple">
    <div class="stat-icon">&#128200;</div>
    <div class="stat-label">20% Tithe Allocation</div>
    <div class="stat-value purple">GH&#8373; <?= number_format($tithe20,2) ?></div>
    <div class="stat-sub">GH&#8373;<?= number_format($src['tithes'],2) ?> &times; 20%</div>
  </div>
</div>

<!-- ══ CHART ROW 1: Area trend + Doughnut ══ -->
<div class="section-label">Income &amp; Expense Trends</div>
<div class="grid-3-1" style="margin-bottom:1.2rem;">
  <div class="chart-card c-gold featured">
    <h3>&#128202; 8-Month Income vs Expenses Trend</h3>
    <div class="chart-sub">Area chart showing revenue flow and expenditure over the last 8 months</div>
    <canvas id="areaChart" height="100"></canvas>
  </div>
  <div class="chart-card c-purple">
    <h3>&#129473; Income Sources</h3>
    <div class="chart-sub">Breakdown for <?= $fLabel ?></div>
    <canvas id="donutChart" height="210"></canvas>
  </div>
</div>

<!-- ══ CHART ROW 2: Horizontal bar + Net line + Expense donut ══ -->
<div class="section-label">Source &amp; Expense Breakdown</div>
<div class="grid-3" style="margin-bottom:1.2rem;">
  <div class="chart-card c-green">
    <h3>&#9646; Income by Source</h3>
    <div class="chart-sub">Horizontal bar — <?= $fLabel ?></div>
    <canvas id="horizBar" height="200"></canvas>
  </div>
  <div class="chart-card c-blue">
    <h3>&#128201; Net Balance Trend</h3>
    <div class="chart-sub">Surplus / deficit each month</div>
    <canvas id="netLine" height="200"></canvas>
  </div>
  <div class="chart-card c-red">
    <h3>&#128179; Expenses by Category</h3>
    <div class="chart-sub"><?= $fLabel ?></div>
    <?php if(empty($expCats)): ?>
      <div class="empty-state" style="padding:3rem 1rem;">No expenses recorded</div>
    <?php else: ?>
    <canvas id="expDonut" height="200"></canvas>
    <?php endif; ?>
  </div>
</div>

<!-- ══ CHART ROW 3: Sunday stacked bar + Radar ══ -->
<div class="section-label">Sunday Collections &amp; Yearly Pattern</div>
<div class="grid-3-1" style="margin-bottom:1.2rem;">
  <div class="chart-card c-pink">
    <h3>&#9749; Sunday-by-Sunday Collections — <?= $fLabel ?></h3>
    <div class="chart-sub">Stacked bar showing offering, school and children per Sunday</div>
    <?php if(empty($sundays)): ?>
      <div class="empty-state" style="padding:3rem 1rem;">No Sunday data for <?= $fLabel ?></div>
    <?php else: ?>
    <canvas id="sundayBar" height="110"></canvas>
    <?php endif; ?>
  </div>
  <div class="chart-card c-blue">
    <h3>&#127919; <?= $fY ?> Radar</h3>
    <div class="chart-sub">Income vs expenses by month</div>
    <canvas id="radarChart" height="210"></canvas>
  </div>
</div>

<!-- ══ CHART ROW 4: Tithe 20% visual ══ -->
<div class="section-label">Tithe Allocation</div>
<div class="grid-2" style="margin-bottom:1.5rem;">
  <div class="chart-card c-purple">
    <h3>&#128200; Tithe vs 20% Allocation — <?= $fLabel ?></h3>
    <div class="chart-sub">Total tithes collected vs designated 20% fund</div>
    <canvas id="titheBar" height="90"></canvas>
  </div>
  <div class="chart-card c-gold">
    <h3>&#128197; Monthly Income Composition — <?= $fY ?></h3>
    <div class="chart-sub">Stacked: all 6 sources per month this year</div>
    <canvas id="stackedBar" height="90"></canvas>
  </div>
</div>

<!-- ══ RECENT TABLES ══ -->
<div class="section-label">Recent Activity</div>
<div class="grid-2">
  <div class="section-card">
    <h3>Recent Income <a href="record.php">+ Record</a></h3>
    <?php if(empty($recent)): ?>
      <div class="empty-state">No income this month.</div>
    <?php else: ?>
    <?php $bMap=['Main Offering'=>'badge-gold','Sunday School'=>'badge-blue','Children Service'=>'badge-pink','Missions'=>'badge-purple','Contribution'=>'badge-green','Tithe'=>'badge-gold']; ?>
    <table>
      <thead><tr><th>Source</th><th>Amount</th><th>Date</th></tr></thead>
      <tbody>
      <?php foreach($recent as $r): ?>
      <tr>
        <td><span class="badge <?= $bMap[$r['source']]??'badge-gold' ?>"><?= htmlspecialchars($r['source']) ?></span></td>
        <td class="amount-pos">GH&#8373; <?= number_format($r['amount'],2) ?></td>
        <td style="color:var(--muted)"><?= date('d M Y',strtotime($r['date'])) ?></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>
  <div class="section-card">
    <h3>Recent Expenses <a href="expenses.php">Manage</a></h3>
    <?php if(empty($recentExp)): ?>
      <div class="empty-state">No expenses this month.</div>
    <?php else: ?>
    <table>
      <thead><tr><th>Name</th><th>Category</th><th>Amount</th><th>Date</th></tr></thead>
      <tbody>
      <?php foreach($recentExp as $e): ?>
      <tr>
        <td><?= htmlspecialchars($e['name']) ?></td>
        <td><span class="badge badge-red"><?= htmlspecialchars($e['category']?:'General') ?></span></td>
        <td class="amount-neg">GH&#8373; <?= number_format($e['amount'],2) ?></td>
        <td style="color:var(--muted)"><?= date('d M Y',strtotime($e['date'])) ?></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>
</div>

</div><!-- /container -->

<script>
Chart.defaults.color      = '#7A8FA8';
Chart.defaults.font.family = 'DM Sans';
Chart.defaults.font.size   = 11;

const G   = (ctx,c1,c2) => { const g=ctx.createLinearGradient(0,0,0,ctx.canvas.height); g.addColorStop(0,c1); g.addColorStop(1,c2); return g; };
const GH  = v => 'GH₵ '+Number(v).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});
const GRID = 'rgba(255,255,255,0.05)';
const yAxis = (ghc=true) => ({grid:{color:GRID},ticks:{color:'#7A8FA8',callback:ghc?v=>GH(v):undefined}});
const xAxis = () => ({grid:{color:GRID},ticks:{color:'#7A8FA8'}});

/* ── 1. AREA CHART — 8-month trend ── */
const aCtx = document.getElementById('areaChart').getContext('2d');
new Chart(aCtx, {
  type:'line',
  data:{
    labels:<?= json_encode($trendLabels) ?>,
    datasets:[
      {
        label:'Income',
        data:<?= json_encode($trendIncome) ?>,
        borderColor:'#C8972A', borderWidth:2.5, pointRadius:4,
        pointBackgroundColor:'#C8972A', pointBorderColor:'#080F1A', pointBorderWidth:2,
        fill:true,
        backgroundColor: function(ctx){ const c=ctx.chart.ctx; return G(c,'rgba(200,151,42,0.35)','rgba(200,151,42,0.02)'); },
        tension:0.4
      },
      {
        label:'Expenses',
        data:<?= json_encode($trendExpense) ?>,
        borderColor:'#E04F4F', borderWidth:2, pointRadius:4,
        pointBackgroundColor:'#E04F4F', pointBorderColor:'#080F1A', pointBorderWidth:2,
        fill:true,
        backgroundColor: function(ctx){ const c=ctx.chart.ctx; return G(c,'rgba(224,79,79,0.2)','rgba(224,79,79,0.01)'); },
        tension:0.4, borderDash:[5,3]
      }
    ]
  },
  options:{
    responsive:true, interaction:{mode:'index',intersect:false},
    plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:12,padding:16}},
             tooltip:{callbacks:{label:ctx=>ctx.dataset.label+': '+GH(ctx.parsed.y)}}},
    scales:{x:xAxis(), y:yAxis()}
  }
});

/* ── 2. DONUT — income sources ── */
new Chart(document.getElementById('donutChart'),{
  type:'doughnut',
  data:{
    labels:<?= json_encode($srcLabels) ?>,
    datasets:[{
      data:<?= json_encode($srcData) ?>,
      backgroundColor:['#C8972A','#3A88D8','#E05DA0','#8B5CF6','#27C98A','#F0C96B'],
      borderColor:'#142236', borderWidth:3, hoverBorderWidth:4,
      hoverOffset:8
    }]
  },
  options:{
    responsive:true, cutout:'66%',
    plugins:{
      legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:10,font:{size:10}}},
      tooltip:{callbacks:{label:ctx=>ctx.label+': '+GH(ctx.parsed)}}
    }
  }
});

/* ── 3. HORIZONTAL BAR — income by source ── */
new Chart(document.getElementById('horizBar'),{
  type:'bar',
  data:{
    labels:<?= json_encode($srcLabels) ?>,
    datasets:[{
      label:'GH₵',
      data:<?= json_encode($srcData) ?>,
      backgroundColor:['rgba(200,151,42,0.75)','rgba(58,136,216,0.75)','rgba(224,93,160,0.75)','rgba(139,92,246,0.75)','rgba(39,201,138,0.75)','rgba(240,201,107,0.75)'],
      borderRadius:5, borderSkipped:false
    }]
  },
  options:{
    indexAxis:'y', responsive:true,
    plugins:{legend:{display:false},tooltip:{callbacks:{label:ctx=>GH(ctx.parsed.x)}}},
    scales:{x:yAxis(), y:{...xAxis(),ticks:{color:'#EAD9BE',font:{size:10}}}}
  }
});

/* ── 4. NET LINE ── */
const netCtx = document.getElementById('netLine').getContext('2d');
new Chart(netCtx,{
  type:'line',
  data:{
    labels:<?= json_encode($trendLabels) ?>,
    datasets:[{
      label:'Net Balance',
      data:<?= json_encode($trendNet) ?>,
      borderColor:'#27C98A', borderWidth:2.5,
      pointRadius:5, pointBackgroundColor: function(ctx){ return ctx.parsed.y>=0?'#27C98A':'#E04F4F'; },
      pointBorderColor:'#142236', pointBorderWidth:2,
      fill:true,
      backgroundColor: function(ctx){ const c=ctx.chart.ctx; return G(c,'rgba(39,201,138,0.2)','rgba(39,201,138,0.02)'); },
      tension:0.4
    }]
  },
  options:{
    responsive:true,
    plugins:{legend:{display:false},tooltip:{callbacks:{label:ctx=>GH(ctx.parsed.y)}}},
    scales:{
      x:xAxis(),
      y:{...yAxis(),ticks:{callback:v=>'GH₵'+v.toLocaleString()},
         grid:{color:GRID},
         afterDataLimits:s=>{const m=Math.max(Math.abs(s.min),Math.abs(s.max)); s.min=-m*1.1; s.max=m*1.1;}
      }
    }
  }
});

/* ── 5. EXPENSE DONUT ── */
<?php if(!empty($expCats)): ?>
new Chart(document.getElementById('expDonut'),{
  type:'doughnut',
  data:{
    labels:<?= json_encode($expCatLabels) ?>,
    datasets:[{
      data:<?= json_encode($expCatData) ?>,
      backgroundColor:['#E04F4F','#E05DA0','#F08040','#8B5CF6','#3A88D8','#27C98A','#C8972A','#F0C96B','#7A8FA8','#60A0D0'],
      borderColor:'#142236', borderWidth:3, hoverOffset:8
    }]
  },
  options:{
    responsive:true, cutout:'60%',
    plugins:{
      legend:{position:'bottom',labels:{color:'#EAD9BE',boxWidth:10,padding:8,font:{size:10}}},
      tooltip:{callbacks:{label:ctx=>ctx.label+': '+GH(ctx.parsed)}}
    }
  }
});
<?php endif; ?>

/* ── 6. SUNDAY STACKED BAR ── */
<?php if(!empty($sundays)): ?>
new Chart(document.getElementById('sundayBar'),{
  type:'bar',
  data:{
    labels:<?= json_encode($sundayDates) ?>,
    datasets:[
      {label:'Main Offering',  data:<?= json_encode($sundayMain) ?>,   backgroundColor:'rgba(200,151,42,0.85)', borderRadius:{topLeft:0,topRight:0,bottomLeft:5,bottomRight:5}, borderSkipped:false},
      {label:'Sunday School',  data:<?= json_encode($sundaySchool) ?>, backgroundColor:'rgba(58,136,216,0.8)',  borderRadius:{topLeft:0,topRight:0}},
      {label:'Children Svc',   data:<?= json_encode($sundayKids) ?>,   backgroundColor:'rgba(224,93,160,0.8)',  borderRadius:{topLeft:5,topRight:5,bottomLeft:0,bottomRight:0}}
    ]
  },
  options:{
    responsive:true, interaction:{mode:'index',intersect:false},
    plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:12}},
             tooltip:{callbacks:{label:ctx=>ctx.dataset.label+': '+GH(ctx.parsed.y)}}},
    scales:{
      x:xAxis(),
      y:yAxis(),
      stacked:true
    }
  }
});
<?php endif; ?>

/* ── 7. RADAR — yearly income vs expenses ── */
new Chart(document.getElementById('radarChart'),{
  type:'radar',
  data:{
    labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets:[
      {label:'Income',  data:<?= json_encode($radarInc) ?>, borderColor:'#C8972A', backgroundColor:'rgba(200,151,42,0.15)', pointBackgroundColor:'#C8972A', pointRadius:3, borderWidth:2},
      {label:'Expenses',data:<?= json_encode($radarExp) ?>, borderColor:'#E04F4F', backgroundColor:'rgba(224,79,79,0.12)',  pointBackgroundColor:'#E04F4F', pointRadius:3, borderWidth:2}
    ]
  },
  options:{
    responsive:true,
    plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:10}}},
    scales:{r:{
      grid:{color:'rgba(255,255,255,0.08)'},
      angleLines:{color:'rgba(255,255,255,0.06)'},
      ticks:{display:false},
      pointLabels:{color:'#7A8FA8',font:{size:10}}
    }}
  }
});

/* ── 8. TITHE vs 20% bar ── */
new Chart(document.getElementById('titheBar'),{
  type:'bar',
  data:{
    labels:['Total Tithes','20% Allocation','Remaining 80%'],
    datasets:[{
      data:[<?= $src['tithes'] ?>, <?= $tithe20 ?>, <?= round($src['tithes']*0.80,2) ?>],
      backgroundColor:['rgba(200,151,42,0.6)','rgba(139,92,246,0.8)','rgba(200,151,42,0.2)'],
      borderColor:['#C8972A','#8B5CF6','rgba(200,151,42,0.4)'],
      borderWidth:1.5, borderRadius:8
    }]
  },
  options:{
    responsive:true,
    plugins:{legend:{display:false},tooltip:{callbacks:{label:ctx=>GH(ctx.parsed.y)}}},
    scales:{x:xAxis(), y:yAxis()}
  }
});

/* ── 9. STACKED BAR — all 6 sources per month this year ── */
<?php
$stackedMonths=[]; $stackedSets=[[],[],[],[],[],[]];
$stackKeys=['main_offering','sunday_school','children_service','missions','contributions','tithes'];
for($i=1;$i<=12;$i++){
    $stackedMonths[]=date('M',mktime(0,0,0,$i,1));
    foreach($stackKeys as $idx=>$t)
        $stackedSets[$idx][]=round(mSum($pdo,$t,$i,$fY),2);
}
?>
new Chart(document.getElementById('stackedBar'),{
  type:'bar',
  data:{
    labels:<?= json_encode($stackedMonths) ?>,
    datasets:[
      {label:'Main Offering',   data:<?= json_encode($stackedSets[0]) ?>, backgroundColor:'rgba(200,151,42,0.85)', borderRadius:0},
      {label:'Sunday School',   data:<?= json_encode($stackedSets[1]) ?>, backgroundColor:'rgba(58,136,216,0.8)'},
      {label:'Children Svc',    data:<?= json_encode($stackedSets[2]) ?>, backgroundColor:'rgba(224,93,160,0.8)'},
      {label:'Missions',        data:<?= json_encode($stackedSets[3]) ?>, backgroundColor:'rgba(139,92,246,0.8)'},
      {label:'Contributions',   data:<?= json_encode($stackedSets[4]) ?>, backgroundColor:'rgba(39,201,138,0.8)'},
      {label:'Tithes',          data:<?= json_encode($stackedSets[5]) ?>, backgroundColor:'rgba(240,201,107,0.8)', borderRadius:{topLeft:5,topRight:5}}
    ]
  },
  options:{
    responsive:true, interaction:{mode:'index',intersect:false},
    plugins:{legend:{labels:{color:'#EAD9BE',boxWidth:10,padding:8,font:{size:10}}}},
    scales:{x:{...xAxis(),stacked:true}, y:{...yAxis(),stacked:true}}
  }
});
</script>
</body>
</html>