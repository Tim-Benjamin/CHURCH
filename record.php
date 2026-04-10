<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Income – Church Finance</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --gold: #C8972A;
        --gold-light: #F0C96B;
        --deep: #0D1B2A;
        --panel: #132235;
        --card: #1A2E44;
        --border: rgba(200, 151, 42, 0.2);
        --text: #E8DCC8;
        --muted: #8A9BB0;
        --success: #2ECC8A;
        --danger: #E05555;
        --accent: #4A90D9;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--deep);
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
        display: flex;
    }

    /* SIDEBAR NAV */
    nav {
        background: var(--panel);
        border-right: 1px solid var(--border);
        width: 260px;
        min-height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding: 2rem 0;
        display: flex;
        flex-direction: column;
        z-index: 100;
    }

    .nav-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 1.5rem;
        margin-bottom: 2.5rem;
    }

    .nav-icon {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .nav-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        color: var(--gold-light);
        letter-spacing: 0.5px;
    }

    .nav-links {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 0 1rem;
    }

    .nav-links a {
        color: var(--muted);
        text-decoration: none;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav-links a:before {
        content: '';
        width: 6px;
        height: 6px;
        background: currentColor;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
        background: rgba(200, 151, 42, 0.12);
        color: var(--gold-light);
    }

    .nav-links a.active:before {
        opacity: 1;
    }

    /* LAYOUT */
    .main-content {
        margin-left: 260px;
        flex: 1;
        width: calc(100% - 260px);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* RESPONSIVE */
    @media(max-width:768px) {
        nav {
            width: 100%;
            min-height: auto;
            position: relative;
            border-right: none;
            border-bottom: 1px solid var(--border);
            padding: 1.5rem 0;
        }

        .nav-brand {
            margin-bottom: 1.5rem;
        }

        .nav-links {
            flex-direction: row;
            overflow-x: auto;
            padding: 0 1rem;
        }

        .nav-links a {
            white-space: nowrap;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
        }

        body {
            flex-direction: column;
        }
    }

    .page-header {
        margin-bottom: 1.5rem;
    }

    .page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.9rem;
        color: var(--gold-light);
        margin-bottom: 4px;
    }

    .page-header p {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .two-col {
        display: grid;
        grid-template-columns: 360px 1fr;
        gap: 1.5rem;
        align-items: start;
    }

    @media(max-width:900px) {
        .two-col {
            grid-template-columns: 1fr;
        }
    }

    /* TABS */
    .tabs {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 1.2rem;
    }

    .tab-btn {
        padding: 8px 18px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: transparent;
        color: var(--muted);
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .tab-btn.active {
        background: rgba(200, 151, 42, 0.15);
        color: var(--gold-light);
        border-color: var(--gold);
    }

    .tab-btn:hover:not(.active) {
        background: rgba(255, 255, 255, 0.04);
        color: var(--text);
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    /* CARDS */
    .form-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.6rem;
    }

    .form-card h2 {
        font-family: 'Playfair Display', serif;
        color: var(--gold-light);
        margin-bottom: 1.4rem;
        font-size: 1.1rem;
    }

    .section-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .section-card-header {
        font-family: 'Playfair Display', serif;
        color: var(--gold-light);
        margin-bottom: 1rem;
        font-size: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* FORM */
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 1rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media(max-width:600px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    label {
        font-size: 0.8rem;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    input,
    textarea,
    select {
        background: #0F1E30;
        border: 1px solid var(--border);
        color: var(--text);
        padding: 10px 14px;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        transition: border-color 0.2s;
        outline: none;
        width: 100%;
    }

    input:focus,
    textarea:focus,
    select:focus {
        border-color: var(--gold);
    }

    textarea {
        resize: vertical;
        min-height: 75px;
    }

    select option {
        background: #1A2E44;
    }

    /* BUTTONS */
    .btn-primary {
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        color: #0D1B2A;
        border: none;
        padding: 11px 28px;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.92rem;
        cursor: pointer;
        transition: opacity 0.2s;
        width: 100%;
    }

    .btn-primary:hover {
        opacity: 0.88;
    }

    .btn-sm {
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        font-weight: 500;
        border: none;
        display: inline-block;
        line-height: 1.5;
    }

    .btn-edit {
        background: rgba(74, 144, 217, 0.15);
        color: #8EC5F5;
        border: 1px solid rgba(74, 144, 217, 0.25);
    }

    .btn-edit:hover {
        background: rgba(74, 144, 217, 0.28);
    }

    .btn-del {
        background: rgba(224, 85, 85, 0.12);
        color: var(--danger);
        border: 1px solid rgba(224, 85, 85, 0.2);
    }

    .btn-del:hover {
        background: rgba(224, 85, 85, 0.25);
    }

    .btn-ghost {
        background: rgba(255, 255, 255, 0.05);
        color: var(--muted);
        border: 1px solid var(--border);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        padding: 7px 14px;
        border-radius: 7px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .btn-ghost:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text);
    }

    .action-btns {
        display: flex;
        gap: 5px;
    }

    /* TABLE */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        font-size: 0.74rem;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 8px 10px;
        border-bottom: 1px solid var(--border);
    }

    td {
        padding: 9px 10px;
        font-size: 0.87rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: rgba(200, 151, 42, 0.03);
    }

    .amount-pos {
        color: var(--success);
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--muted);
        font-size: 0.9rem;
    }

    /* FILTER BAR */
    .filter-bar {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 1.2rem;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .filter-group label {
        font-size: 0.75rem;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.7px;
    }

    .filter-group input,
    .filter-group select {
        width: auto;
        padding: 7px 12px;
        font-size: 0.85rem;
    }

    .filter-actions {
        display: flex;
        gap: 8px;
        align-items: flex-end;
    }

    .week-hint {
        font-size: 0.75rem;
        color: var(--muted);
        margin-top: 2px;
    }

    .or-sep {
        display: flex;
        align-items: center;
        color: var(--muted);
        font-size: 0.82rem;
        padding-bottom: 4px;
    }

    /* ALERT */
    .alert {
        padding: 11px 16px;
        border-radius: 8px;
        margin-bottom: 1.2rem;
        font-size: 0.88rem;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .alert.success {
        background: rgba(46, 204, 138, 0.1);
        border: 1px solid rgba(46, 204, 138, 0.25);
        color: var(--success);
    }

    .alert.error {
        background: rgba(224, 85, 85, 0.1);
        border: 1px solid rgba(224, 85, 85, 0.25);
        color: var(--danger);
    }

    /* MODAL */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 500;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal-overlay.open {
        display: flex;
    }

    .modal {
        background: var(--panel);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 2rem;
        width: 100%;
        max-width: 500px;
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal h2 {
        font-family: 'Playfair Display', serif;
        color: var(--gold-light);
        margin-bottom: 1.4rem;
        font-size: 1.15rem;
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        color: var(--muted);
        font-size: 1.4rem;
        cursor: pointer;
    }

    .modal-close:hover {
        color: var(--text);
    }

    .modal .btn-primary {
        margin-top: 0.5rem;
    }
    </style>
</head>

<body>

    <?php
include 'db.php';
$msg = ''; $msgType = '';

/* ═══ UPDATE ═══ */
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['edit_id'], $_POST['edit_table'])) {
    $et = $_POST['edit_table'];
    $allowed = ['main_offering','sunday_school','children_service','missions','contributions','tithes'];
    if (in_array($et, $allowed)) {
        try {
            if (in_array($et, ['main_offering','sunday_school','children_service','missions'])) {
                $pdo->prepare("UPDATE $et SET amount=?, date=? WHERE id=?")
                    ->execute([(float)$_POST['amount'], $_POST['date'], (int)$_POST['edit_id']]);
            } elseif ($et === 'contributions') {
                $pdo->prepare("UPDATE contributions SET name=?, amount=?, date=?, description=? WHERE id=?")
                    ->execute([$_POST['name'], (float)$_POST['amount'], $_POST['date'], $_POST['description'], (int)$_POST['edit_id']]);
            } elseif ($et === 'tithes') {
                $pdo->prepare("UPDATE tithes SET name=?, amount=?, date=? WHERE id=?")
                    ->execute([$_POST['name'], (float)$_POST['amount'], $_POST['date'], (int)$_POST['edit_id']]);
            }
            $msg = 'Entry updated.'; $msgType = 'success';
        } catch(Exception $e){ $msg='Error: '.$e->getMessage(); $msgType='error'; }
    }
}

/* ═══ DELETE ═══ */
elseif ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['delete_id'], $_POST['delete_table'])) {
    $dt = $_POST['delete_table'];
    $allowed = ['main_offering','sunday_school','children_service','missions','contributions','tithes'];
    if (in_array($dt, $allowed)) {
        $pdo->prepare("DELETE FROM $dt WHERE id=?")->execute([(int)$_POST['delete_id']]);
        $msg = 'Entry deleted.'; $msgType = 'success';
    }
}

/* ═══ INSERT ═══ */
elseif ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['source'])) {
    $source = $_POST['source'];
    try {
        if (in_array($source, ['main_offering','sunday_school','children_service','missions'])) {
            $pdo->prepare("INSERT INTO $source (amount, date) VALUES (?, ?)")
                ->execute([(float)$_POST['amount'], $_POST['date']]);
        } elseif ($source === 'contributions') {
            $pdo->prepare("INSERT INTO contributions (name, amount, date, description) VALUES (?,?,?,?)")
                ->execute([$_POST['name'], (float)$_POST['amount'], $_POST['date'], $_POST['description']]);
        } elseif ($source === 'tithes') {
            $pdo->prepare("INSERT INTO tithes (name, amount, date) VALUES (?,?,?)")
                ->execute([$_POST['name'], (float)$_POST['amount'], $_POST['date']]);
        }
        $msg = 'Entry saved!'; $msgType = 'success';
    } catch(Exception $e){ $msg='Error: '.$e->getMessage(); $msgType='error'; }
}

/* ═══ FILTERS ═══ */
$activeTab   = $_GET['tab']  ?? 'main_offering';
$filterWeek  = $_GET['week'] ?? '';
$filterFrom  = $_GET['from'] ?? '';
$filterTo    = $_GET['to']   ?? '';
$searchQ     = trim($_GET['q'] ?? '');
$currentWeek = date('Y-\WW');

function buildWhere($week, $from, $to, $nameSearch='', $nameCol='') {
    $w=[]; $p=[];
    if ($week) {
        $weekDate = date('Y-m-d', strtotime($week));
        $w[] = "YEARWEEK(date,1) = YEARWEEK(?,1)";
        $p[] = $weekDate;
    } else {
        if ($from) { $w[]="date >= ?"; $p[]=$from; }
        if ($to)   { $w[]="date <= ?"; $p[]=$to; }
    }
    if ($nameSearch && $nameCol) { $w[]="$nameCol LIKE ?"; $p[]="%$nameSearch%"; }
    return [empty($w)?'':('WHERE '.implode(' AND ',$w)), $p];
}

function fetchFiltered($pdo, $table, $week, $from, $to, $q='', $nameCol='') {
    [$where, $params] = buildWhere($week, $from, $to, $q, $nameCol);
    $s = $pdo->prepare("SELECT * FROM $table $where ORDER BY date DESC LIMIT 100");
    $s->execute($params);
    return $s->fetchAll();
}

$rows = [
    'main_offering'    => fetchFiltered($pdo,'main_offering',   $filterWeek,$filterFrom,$filterTo),
    'sunday_school'    => fetchFiltered($pdo,'sunday_school',   $filterWeek,$filterFrom,$filterTo),
    'children_service' => fetchFiltered($pdo,'children_service',$filterWeek,$filterFrom,$filterTo),
    'missions'         => fetchFiltered($pdo,'missions',        $filterWeek,$filterFrom,$filterTo),
    'contributions'    => fetchFiltered($pdo,'contributions',   $filterWeek,$filterFrom,$filterTo,$searchQ,'name'),
    'tithes'           => fetchFiltered($pdo,'tithes',          $filterWeek,$filterFrom,$filterTo,$searchQ,'name'),
];

$weekLabel = '';
if ($filterWeek) {
    $wd = date('Y-m-d', strtotime($filterWeek));
    $ws = date('d M', strtotime('monday this week', strtotime($wd)));
    $we = date('d M Y', strtotime('sunday this week', strtotime($wd)));
    $weekLabel = "$ws – $we";
}
?>

    <!-- NAV -->
    <nav>
        <div class="nav-brand">
            <div class="nav-icon">&#10011;</div>
            <span class="nav-title">CCC Portal</span>
        </div>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="record.php" class="active">Record Income</a>
            <a href="expenses.php">Expenses</a>
            <a href="reports.php">Reports</a>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <div class="page-header">
                <h1>Record Income</h1>
                <p>Add, filter by week or date, edit and delete all income entries</p>
            </div>

            <?php if ($msg): ?>
            <div class="alert <?= $msgType ?>">
                <?= $msgType==='success' ? '&#10003;' : '&#10007;' ?> <?= htmlspecialchars($msg) ?>
            </div>
            <?php endif; ?>

            <!-- SOURCE TABS -->
            <div class="tabs">
                <?php
    $tabDefs = [
      'main_offering'    => 'Main Offering',
      'sunday_school'    => 'Sunday School',
      'children_service' => 'Children Service',
      'missions'         => 'Missions',
      'contributions'    => 'Contributions',
      'tithes'           => 'Tithes',
    ];
    foreach ($tabDefs as $key => $label):
    ?>
                <button class="tab-btn <?= $activeTab===$key?'active':'' ?>" onclick="switchTab('<?= $key ?>',this)">
                    <?= $label ?>
                    <span style="font-size:0.72rem;opacity:0.55;margin-left:3px;">(<?= count($rows[$key]) ?>)</span>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- FILTER BAR -->
            <form method="GET" id="filterForm">
                <input type="hidden" name="tab" id="tabHidden" value="<?= htmlspecialchars($activeTab) ?>">
                <div class="filter-bar">
                    <div class="filter-group">
                        <label>Week Picker</label>
                        <input type="week" name="week" id="weekPicker" value="<?= htmlspecialchars($filterWeek) ?>"
                            style="min-width:180px;">
                        <?php if ($weekLabel): ?>
                        <span class="week-hint">Showing: <?= $weekLabel ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="or-sep">— or —</div>

                    <div class="filter-group">
                        <label>From Date</label>
                        <input type="date" name="from" id="fromDate" value="<?= htmlspecialchars($filterFrom) ?>">
                    </div>
                    <div class="filter-group">
                        <label>To Date</label>
                        <input type="date" name="to" id="toDate" value="<?= htmlspecialchars($filterTo) ?>">
                    </div>
                    <div class="filter-group">
                        <label>Search Name</label>
                        <input type="text" name="q" value="<?= htmlspecialchars($searchQ) ?>"
                            placeholder="Member / contributor..." style="min-width:160px;">
                    </div>
                    <div class="filter-actions">
                        <button type="submit" class="btn-ghost">Apply</button>
                        <a href="record.php?tab=<?= $activeTab ?>" class="btn-ghost">Clear</a>
                        <button type="button" class="btn-ghost" onclick="thisWeek()">This Week</button>
                    </div>
                </div>
            </form>

            <?php
  /* ═══ SIMPLE TABS (amount + date only) ═══ */
  $simpleTabs = [
    'main_offering'    => 'Main Offering',
    'sunday_school'    => 'Sunday School',
    'children_service' => 'Children Service',
    'missions'         => 'Missions',
  ];
  foreach ($simpleTabs as $key => $label):
    $tabRows = $rows[$key];
  ?>
            <div class="tab-panel <?= $activeTab===$key?'active':'' ?>" id="tab-<?= $key ?>">
                <div class="two-col">

                    <!-- ADD FORM -->
                    <div class="form-card">
                        <h2><?= $label ?></h2>
                        <form method="POST">
                            <input type="hidden" name="source" value="<?= $key ?>">
                            <div class="form-group">
                                <label>Amount (GH&#8373;)</label>
                                <input type="number" name="amount" step="0.01" min="0" required placeholder="0.00">
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" required value="<?= date('Y-m-d') ?>">
                            </div>
                            <button type="submit" class="btn-primary">Save Entry</button>
                        </form>
                    </div>

                    <!-- RECORDS TABLE -->
                    <div class="section-card">
                        <div class="section-card-header">
                            Records
                            <span
                                style="font-size:0.78rem;color:var(--muted);font-family:'DM Sans',sans-serif;font-weight:400;">
                                <?= count($tabRows) ?> entries
                            </span>
                        </div>
                        <?php if (empty($tabRows)): ?>
                        <div class="empty-state">No records
                            found<?= ($filterWeek||$filterFrom||$filterTo)?' for selected filter.':' yet.' ?></div>
                        <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th style="width:110px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tabRows as $r): ?>
                                <tr>
                                    <td class="amount-pos">GH&#8373; <?= number_format($r['amount'],2) ?></td>
                                    <td><?= date('D, d M Y', strtotime($r['date'])) ?></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn-sm btn-edit"
                                                onclick="openSimple('<?= $key ?>',<?= $r['id'] ?>,<?= $r['amount'] ?>,'<?= $r['date'] ?>')">
                                                Edit
                                            </button>
                                            <form method="POST" onsubmit="return confirm('Delete this entry?')"
                                                style="display:inline">
                                                <input type="hidden" name="delete_id" value="<?= $r['id'] ?>">
                                                <input type="hidden" name="delete_table" value="<?= $key ?>">
                                                <button type="submit" class="btn-sm btn-del">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>

            <!-- ═══ CONTRIBUTIONS TAB ═══ -->
            <div class="tab-panel <?= $activeTab==='contributions'?'active':'' ?>" id="tab-contributions">
                <div class="two-col">
                    <div class="form-card">
                        <h2>Contributions</h2>
                        <form method="POST">
                            <input type="hidden" name="source" value="contributions">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" required placeholder="Contributor name">
                                </div>
                                <div class="form-group">
                                    <label>Amount (GH&#8373;)</label>
                                    <input type="number" name="amount" step="0.01" min="0" required placeholder="0.00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" required value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="form-group">
                                <label>Description (optional)</label>
                                <textarea name="description" placeholder="Purpose or notes..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="section-card">
                        <div class="section-card-header">
                            Contributions
                            <span
                                style="font-size:0.78rem;color:var(--muted);font-family:'DM Sans',sans-serif;font-weight:400;">
                                <?= count($rows['contributions']) ?> entries
                            </span>
                        </div>
                        <?php if (empty($rows['contributions'])): ?>
                        <div class="empty-state">No contributions found.</div>
                        <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                    <th style="width:110px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows['contributions'] as $c): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($c['name']) ?></strong></td>
                                    <td class="amount-pos">GH&#8373; <?= number_format($c['amount'],2) ?></td>
                                    <td><?= date('d M Y', strtotime($c['date'])) ?></td>
                                    <td style="color:var(--muted);font-size:0.8rem;">
                                        <?= htmlspecialchars(substr($c['description']??'',0,35)) ?>
                                        <?= strlen($c['description']??'')>35?'&hellip;':'' ?>
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn-sm btn-edit"
                                                onclick="openContrib(<?= $c['id'] ?>,'<?= addslashes(htmlspecialchars($c['name'])) ?>',<?= $c['amount'] ?>,'<?= $c['date'] ?>','<?= addslashes(htmlspecialchars($c['description']??'')) ?>')">
                                                Edit
                                            </button>
                                            <form method="POST" onsubmit="return confirm('Delete?')"
                                                style="display:inline">
                                                <input type="hidden" name="delete_id" value="<?= $c['id'] ?>">
                                                <input type="hidden" name="delete_table" value="contributions">
                                                <button type="submit" class="btn-sm btn-del">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ═══ TITHES TAB ═══ -->
            <div class="tab-panel <?= $activeTab==='tithes'?'active':'' ?>" id="tab-tithes">
                <div class="two-col">
                    <div class="form-card">
                        <h2>Tithes</h2>
                        <form method="POST">
                            <input type="hidden" name="source" value="tithes">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Member Name</label>
                                    <input type="text" name="name" required placeholder="Full name">
                                </div>
                                <div class="form-group">
                                    <label>Amount (GH&#8373;)</label>
                                    <input type="number" name="amount" step="0.01" min="0" required placeholder="0.00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" required value="<?= date('Y-m-d') ?>">
                            </div>
                            <button type="submit" class="btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="section-card">
                        <div class="section-card-header">
                            Tithes
                            <span
                                style="font-size:0.78rem;color:var(--muted);font-family:'DM Sans',sans-serif;font-weight:400;">
                                <?= count($rows['tithes']) ?> entries
                            </span>
                        </div>
                        <?php if (empty($rows['tithes'])): ?>
                        <div class="empty-state">No tithes found.</div>
                        <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th style="width:110px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows['tithes'] as $t): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($t['name']) ?></strong></td>
                                    <td class="amount-pos">GH&#8373; <?= number_format($t['amount'],2) ?></td>
                                    <td><?= date('d M Y', strtotime($t['date'])) ?></td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn-sm btn-edit"
                                                onclick="openTithe(<?= $t['id'] ?>,'<?= addslashes(htmlspecialchars($t['name'])) ?>',<?= $t['amount'] ?>,'<?= $t['date'] ?>')">
                                                Edit
                                            </button>
                                            <form method="POST" onsubmit="return confirm('Delete?')"
                                                style="display:inline">
                                                <input type="hidden" name="delete_id" value="<?= $t['id'] ?>">
                                                <input type="hidden" name="delete_table" value="tithes">
                                                <button type="submit" class="btn-sm btn-del">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ═══ MODAL: Edit Simple (amount + date) ═══ -->
    <div class="modal-overlay" id="modalSimple">
        <div class="modal">
            <button class="modal-close" onclick="closeModal('modalSimple')">&#10005;</button>
            <h2>Edit Entry</h2>
            <form method="POST">
                <input type="hidden" name="edit_id" id="msId">
                <input type="hidden" name="edit_table" id="msTable">
                <div class="form-group">
                    <label>Amount (GH&#8373;)</label>
                    <input type="number" name="amount" id="msAmount" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" id="msDate" required>
                </div>
                <button type="submit" class="btn-primary">Update Entry</button>
            </form>
        </div>
    </div>

    <!-- ═══ MODAL: Edit Contribution ═══ -->
    <div class="modal-overlay" id="modalContrib">
        <div class="modal">
            <button class="modal-close" onclick="closeModal('modalContrib')">&#10005;</button>
            <h2>Edit Contribution</h2>
            <form method="POST">
                <input type="hidden" name="edit_id" id="mcId">
                <input type="hidden" name="edit_table" value="contributions">
                <div class="form-row">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="mcName" required>
                    </div>
                    <div class="form-group">
                        <label>Amount (GH&#8373;)</label>
                        <input type="number" name="amount" id="mcAmount" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" id="mcDate" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="mcDesc"></textarea>
                </div>
                <button type="submit" class="btn-primary">Update</button>
            </form>
        </div>
    </div>

    <!-- ═══ MODAL: Edit Tithe ═══ -->
    <div class="modal-overlay" id="modalTithe">
        <div class="modal">
            <button class="modal-close" onclick="closeModal('modalTithe')">&#10005;</button>
            <h2>Edit Tithe</h2>
            <form method="POST">
                <input type="hidden" name="edit_id" id="mtId">
                <input type="hidden" name="edit_table" value="tithes">
                <div class="form-row">
                    <div class="form-group">
                        <label>Member Name</label>
                        <input type="text" name="name" id="mtName" required>
                    </div>
                    <div class="form-group">
                        <label>Amount (GH&#8373;)</label>
                        <input type="number" name="amount" id="mtAmount" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" id="mtDate" required>
                </div>
                <button type="submit" class="btn-primary">Update</button>
            </form>
        </div>
    </div>

    <script>
    /* ── Tab switching ── */
    function switchTab(id, btn) {
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + id).classList.add('active');
        btn.classList.add('active');
        document.getElementById('tabHidden').value = id;
    }

    /* ── This week shortcut ── */
    function thisWeek() {
        document.getElementById('weekPicker').value = '<?= $currentWeek ?>';
        document.getElementById('fromDate').value = '';
        document.getElementById('toDate').value = '';
        document.getElementById('filterForm').submit();
    }

    /* ── Mutual exclusivity: week vs date range ── */
    document.getElementById('weekPicker').addEventListener('change', function() {
        if (this.value) {
            document.getElementById('fromDate').value = '';
            document.getElementById('toDate').value = '';
        }
    });
    document.getElementById('fromDate').addEventListener('change', function() {
        if (this.value) document.getElementById('weekPicker').value = '';
    });
    document.getElementById('toDate').addEventListener('change', function() {
        if (this.value) document.getElementById('weekPicker').value = '';
    });

    /* ── Modal helpers ── */
    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }
    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) e.target.classList.remove('open');
    });

    function openSimple(table, id, amount, date) {
        document.getElementById('msTable').value = table;
        document.getElementById('msId').value = id;
        document.getElementById('msAmount').value = amount;
        document.getElementById('msDate').value = date;
        document.getElementById('modalSimple').classList.add('open');
    }

    function openContrib(id, name, amount, date, desc) {
        document.getElementById('mcId').value = id;
        document.getElementById('mcName').value = name;
        document.getElementById('mcAmount').value = amount;
        document.getElementById('mcDate').value = date;
        document.getElementById('mcDesc').value = desc;
        document.getElementById('modalContrib').classList.add('open');
    }

    function openTithe(id, name, amount, date) {
        document.getElementById('mtId').value = id;
        document.getElementById('mtName').value = name;
        document.getElementById('mtAmount').value = amount;
        document.getElementById('mtDate').value = date;
        document.getElementById('modalTithe').classList.add('open');
    }
    </script>
</body>

</html>