<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Expenses – Church Finance</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--gold:#C8972A;--gold-light:#F0C96B;--deep:#0D1B2A;--panel:#132235;--card:#1A2E44;--border:rgba(200,151,42,0.2);--text:#E8DCC8;--muted:#8A9BB0;--success:#2ECC8A;--danger:#E05555;--accent:#4A90D9;}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--deep);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;}
nav{background:var(--panel);border-bottom:1px solid var(--border);padding:0 2rem;display:flex;align-items:center;justify-content:space-between;height:64px;position:sticky;top:0;z-index:100;}
.nav-brand{display:flex;align-items:center;gap:12px;}
.nav-icon{width:36px;height:36px;background:linear-gradient(135deg,var(--gold),var(--gold-light));border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:18px;}
.nav-title{font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--gold-light);}
.nav-links{display:flex;gap:4px;}
.nav-links a{color:var(--muted);text-decoration:none;padding:8px 16px;border-radius:6px;font-size:0.88rem;font-weight:500;transition:all 0.2s;}
.nav-links a:hover,.nav-links a.active{background:rgba(200,151,42,0.12);color:var(--gold-light);}
.container{max-width:1200px;margin:0 auto;padding:2rem;}
.page-header{margin-bottom:1.5rem;}
.page-header h1{font-family:'Playfair Display',serif;font-size:1.9rem;color:var(--gold-light);margin-bottom:4px;}
.page-header p{color:var(--muted);font-size:0.9rem;}
.two-col{display:grid;grid-template-columns:380px 1fr;gap:1.5rem;align-items:start;}
@media(max-width:900px){.two-col{grid-template-columns:1fr;}}
.form-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.6rem;}
.form-card h2{font-family:'Playfair Display',serif;color:var(--gold-light);margin-bottom:1.4rem;font-size:1.1rem;}
.section-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:1.5rem;}
.section-card-header{font-family:'Playfair Display',serif;color:var(--gold-light);margin-bottom:1rem;font-size:1rem;display:flex;justify-content:space-between;align-items:center;}
.form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:1rem;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
@media(max-width:600px){.form-row{grid-template-columns:1fr;}}
label{font-size:0.8rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;}
input,textarea,select{background:#0F1E30;border:1px solid var(--border);color:var(--text);padding:10px 14px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.9rem;transition:border-color 0.2s;outline:none;width:100%;}
input:focus,textarea:focus,select:focus{border-color:var(--gold);}
textarea{resize:vertical;min-height:75px;}
select option{background:#1A2E44;}
.btn-primary{background:linear-gradient(135deg,var(--gold),var(--gold-light));color:#0D1B2A;border:none;padding:11px 28px;border-radius:8px;font-family:'DM Sans',sans-serif;font-weight:600;font-size:0.92rem;cursor:pointer;transition:opacity 0.2s;width:100%;}
.btn-primary:hover{opacity:0.88;}
.btn-sm{padding:5px 12px;border-radius:6px;font-size:0.8rem;font-family:'DM Sans',sans-serif;cursor:pointer;font-weight:500;border:none;display:inline-block;line-height:1.4;}
.btn-edit{background:rgba(74,144,217,0.15);color:#8EC5F5;border:1px solid rgba(74,144,217,0.2);}
.btn-edit:hover{background:rgba(74,144,217,0.28);}
.btn-del{background:rgba(224,85,85,0.12);color:var(--danger);border:1px solid rgba(224,85,85,0.2);}
.btn-del:hover{background:rgba(224,85,85,0.25);}
.btn-ghost{background:rgba(255,255,255,0.05);color:var(--muted);border:1px solid var(--border);text-decoration:none;display:inline-flex;align-items:center;}
.btn-ghost:hover{background:rgba(255,255,255,0.1);color:var(--text);}
.action-btns{display:flex;gap:5px;}
table{width:100%;border-collapse:collapse;}
th{text-align:left;font-size:0.74rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;padding:8px 10px;border-bottom:1px solid var(--border);}
td{padding:9px 10px;font-size:0.87rem;border-bottom:1px solid rgba(255,255,255,0.04);}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(200,151,42,0.03);}
.amount-neg{color:var(--danger);font-weight:500;}
.badge{display:inline-block;padding:2px 10px;border-radius:20px;font-size:0.75rem;font-weight:500;}
.badge-red{background:rgba(224,85,85,0.15);color:#FF9090;}
.empty-state{text-align:center;padding:2rem;color:var(--muted);font-size:0.9rem;}
.filter-bar{background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:10px;padding:14px 16px;margin-bottom:1.2rem;display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;}
.filter-group{display:flex;flex-direction:column;gap:5px;}
.filter-group label{font-size:0.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.7px;}
.filter-group input,.filter-group select{width:auto;padding:7px 12px;font-size:0.85rem;}
.filter-actions{display:flex;gap:8px;align-items:flex-end;}
.week-hint{font-size:0.75rem;color:var(--muted);margin-top:2px;}
.alert{padding:11px 16px;border-radius:8px;margin-bottom:1.2rem;font-size:0.88rem;display:flex;gap:10px;align-items:center;}
.alert.success{background:rgba(46,204,138,0.1);border:1px solid rgba(46,204,138,0.25);color:var(--success);}
.alert.error{background:rgba(224,85,85,0.1);border:1px solid rgba(224,85,85,0.25);color:var(--danger);}
.total-row{background:rgba(200,151,42,0.06);border-radius:8px;padding:10px 14px;margin-top:12px;display:flex;justify-content:space-between;align-items:center;font-size:0.9rem;}
.total-row strong{color:var(--gold-light);}
/* MODAL */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:500;display:none;align-items:center;justify-content:center;padding:1rem;}
.modal-overlay.open{display:flex;}
.modal{background:var(--panel);border:1px solid var(--border);border-radius:14px;padding:2rem;width:100%;max-width:520px;position:relative;max-height:90vh;overflow-y:auto;}
.modal h2{font-family:'Playfair Display',serif;color:var(--gold-light);margin-bottom:1.4rem;font-size:1.15rem;}
.modal-close{position:absolute;top:1rem;right:1rem;background:none;border:none;color:var(--muted);font-size:1.4rem;cursor:pointer;}
.modal-close:hover{color:var(--text);}
.modal .btn-primary{margin-top:0.5rem;}
</style>
</head>
<body>

<?php
include 'db.php';
$msg = ''; $msgType = '';

// ── UPDATE ──
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['edit_id'])) {
    try {
        $pdo->prepare("UPDATE expenses SET name=?, description=?, amount=?, date=?, category=? WHERE id=?")
            ->execute([$_POST['name'], $_POST['description'], (float)$_POST['amount'], $_POST['date'], $_POST['category'], (int)$_POST['edit_id']]);
        $msg = 'Expense updated.'; $msgType = 'success';
    } catch(Exception $e){ $msg='Error: '.$e->getMessage(); $msgType='error'; }
}
// ── DELETE ──
elseif ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['delete_id'])) {
    $pdo->prepare("DELETE FROM expenses WHERE id=?")->execute([(int)$_POST['delete_id']]);
    $msg = 'Expense deleted.'; $msgType = 'success';
}
// ── INSERT ──
elseif ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['name']) && !isset($_POST['edit_id'])) {
    try {
        $pdo->prepare("INSERT INTO expenses (name,description,amount,date,category) VALUES (?,?,?,?,?)")
            ->execute([$_POST['name'], $_POST['description'], (float)$_POST['amount'], $_POST['date'], $_POST['category']]);
        $msg = 'Expense saved!'; $msgType = 'success';
    } catch(Exception $e){ $msg='Error: '.$e->getMessage(); $msgType='error'; }
}

// ── FILTERS ──
$filterWeek = $_GET['week'] ?? '';
$filterFrom = $_GET['from'] ?? '';
$filterTo   = $_GET['to']   ?? '';
$filterCat  = $_GET['cat']  ?? '';
$searchQ    = trim($_GET['q'] ?? '');
$currentWeek = date('Y-\WW');

$w=[]; $p=[];
if ($filterWeek) {
    $weekDate = date('Y-m-d', strtotime($filterWeek));
    $w[]="YEARWEEK(date,1)=YEARWEEK(?,1)"; $p[]=$weekDate;
} else {
    if ($filterFrom){ $w[]="date >= ?"; $p[]=$filterFrom; }
    if ($filterTo)  { $w[]="date <= ?"; $p[]=$filterTo; }
}
if ($filterCat) { $w[]="category=?"; $p[]=$filterCat; }
if ($searchQ)   { $w[]="name LIKE ?"; $p[]="%$searchQ%"; }
$where = empty($w)?'':('WHERE '.implode(' AND ',$w));
$stmt = $pdo->prepare("SELECT * FROM expenses $where ORDER BY date DESC LIMIT 200");
$stmt->execute($p);
$expenses = $stmt->fetchAll();
$totalFiltered = array_sum(array_column($expenses,'amount'));

$weekLabel = '';
if ($filterWeek) {
    $wd = date('Y-m-d', strtotime($filterWeek));
    $ws = date('d M', strtotime('monday this week', strtotime($wd)));
    $we = date('d M Y', strtotime('sunday this week', strtotime($wd)));
    $weekLabel = "$ws – $we";
}

$categories = ['Utilities','Maintenance','Salaries','Outreach','Equipment','Food & Catering','Transport','Office Supplies','Missions Support','Other'];
?>

<nav>
  <div class="nav-brand">
    <div class="nav-icon">✝</div>
    <span class="nav-title">Church Finance</span>
  </div>
  <div class="nav-links">
    <a href="index.php">Dashboard</a>
    <a href="record.php">Record Income</a>
    <a href="expenses.php" class="active">Expenses</a>
    <a href="reports.php">Reports</a>
  </div>
</nav>

<div class="container">
  <div class="page-header">
    <h1>Expenses</h1>
    <p>Track, filter, edit and delete all church expenditures</p>
  </div>

  <?php if ($msg): ?>
    <div class="alert <?= $msgType ?>"><?= $msgType==='success'?'✅':'❌' ?> <?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <!-- FILTER BAR -->
  <form method="GET" id="filterForm">
    <div class="filter-bar">
      <div class="filter-group">
        <label>📅 Week</label>
        <input type="week" name="week" id="weekPicker" value="<?= htmlspecialchars($filterWeek) ?>" style="min-width:180px;">
        <?php if ($weekLabel): ?><span class="week-hint">Showing: <?= $weekLabel ?></span><?php endif; ?>
      </div>
      <div style="display:flex;align-items:center;gap:8px;align-self:center;margin-top:14px;color:var(--muted);font-size:0.82rem;">— or —</div>
      <div class="filter-group">
        <label>From</label>
        <input type="date" name="from" id="fromDate" value="<?= htmlspecialchars($filterFrom) ?>">
      </div>
      <div class="filter-group">
        <label>To</label>
        <input type="date" name="to" id="toDate" value="<?= htmlspecialchars($filterTo) ?>">
      </div>
      <div class="filter-group">
        <label>Category</label>
        <select name="cat">
          <option value="">All Categories</option>
          <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat ?>" <?= $filterCat===$cat?'selected':'' ?>><?= $cat ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="filter-group">
        <label>Search</label>
        <input type="text" name="q" value="<?= htmlspecialchars($searchQ) ?>" placeholder="Expense name..." style="min-width:150px;">
      </div>
      <div class="filter-actions">
        <button type="submit" class="btn-sm btn-ghost" style="padding:8px 16px;">Apply</button>
        <a href="expenses.php" class="btn-sm btn-ghost" style="padding:8px 16px;">Clear</a>
        <button type="button" class="btn-sm btn-ghost" style="padding:8px 16px;" onclick="thisWeek()">This Week</button>
      </div>
    </div>
  </form>

  <div class="two-col">
    <!-- ADD FORM -->
    <div class="form-card">
      <h2>➕ Add Expense</h2>
      <form method="POST">
        <div class="form-group"><label>Expense Name</label><input type="text" name="name" required placeholder="e.g. Generator fuel"></div>
        <div class="form-group">
          <label>Category</label>
          <select name="category">
            <?php foreach ($categories as $cat): ?><option value="<?= $cat ?>"><?= $cat ?></option><?php endforeach; ?>
          </select>
        </div>
        <div class="form-row">
          <div class="form-group"><label>Amount (GH₵)</label><input type="number" name="amount" step="0.01" min="0" required placeholder="0.00"></div>
          <div class="form-group"><label>Date</label><input type="date" name="date" required value="<?= date('Y-m-d') ?>"></div>
        </div>
        <div class="form-group"><label>Description (optional)</label><textarea name="description" placeholder="Any extra details..."></textarea></div>
        <button type="submit" class="btn-primary">Save Expense</button>
      </form>
    </div>

    <!-- EXPENSES TABLE -->
    <div class="section-card">
      <div class="section-card-header">
        Expenses
        <span style="font-size:0.78rem;color:var(--muted);font-family:'DM Sans',sans-serif;font-weight:400;"><?= count($expenses) ?> records</span>
      </div>
      <?php if (empty($expenses)): ?>
        <div class="empty-state">No expenses found<?= ($filterWeek||$filterFrom||$filterTo||$filterCat||$searchQ)?' for selected filter.':' yet.' ?></div>
      <?php else: ?>
      <table>
        <thead><tr><th>Name</th><th>Category</th><th>Amount</th><th>Date</th><th style="width:110px;">Actions</th></tr></thead>
        <tbody>
        <?php foreach ($expenses as $e): ?>
        <tr>
          <td>
            <div><?= htmlspecialchars($e['name']) ?></div>
            <?php if ($e['description']): ?><div style="font-size:0.76rem;color:var(--muted);margin-top:1px;"><?= htmlspecialchars(substr($e['description'],0,45)) ?><?= strlen($e['description'])>45?'…':'' ?></div><?php endif; ?>
          </td>
          <td><span class="badge badge-red"><?= htmlspecialchars($e['category']??'General') ?></span></td>
          <td class="amount-neg">GH₵ <?= number_format($e['amount'],2) ?></td>
          <td><?= date('d M Y', strtotime($e['date'])) ?></td>
          <td>
            <div class="action-btns">
              <button class="btn-sm btn-edit" onclick="openEdit(<?= $e['id'] ?>,'<?= addslashes($e['name']) ?>','<?= addslashes($e['description']??'') ?>',<?= $e['amount'] ?>,'<?= $e['date'] ?>','<?= addslashes($e['category']??'') ?>')">✏️</button>
              <form method="POST" onsubmit="return confirm('Delete this expense?')" style="display:inline">
                <input type="hidden" name="delete_id" value="<?= $e['id'] ?>">
                <button type="submit" class="btn-sm btn-del">🗑</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <div class="total-row">
        <span>Total shown</span>
        <strong>GH₵ <?= number_format($totalFiltered, 2) ?></strong>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- ══ EDIT MODAL ══ -->
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <button class="modal-close" onclick="document.getElementById('editModal').classList.remove('open')">✕</button>
    <h2>✏️ Edit Expense</h2>
    <form method="POST">
      <input type="hidden" name="edit_id" id="eId">
      <div class="form-group"><label>Name</label><input type="text" name="name" id="eName" required></div>
      <div class="form-group">
        <label>Category</label>
        <select name="category" id="eCat">
          <?php foreach ($categories as $cat): ?><option value="<?= $cat ?>"><?= $cat ?></option><?php endforeach; ?>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group"><label>Amount (GH₵)</label><input type="number" name="amount" id="eAmount" step="0.01" min="0" required></div>
        <div class="form-group"><label>Date</label><input type="date" name="date" id="eDate" required></div>
      </div>
      <div class="form-group"><label>Description</label><textarea name="description" id="eDesc"></textarea></div>
      <button type="submit" class="btn-primary">Update Expense</button>
    </form>
  </div>
</div>

<script>
function thisWeek() {
  document.getElementById('weekPicker').value = '<?= $currentWeek ?>';
  document.getElementById('fromDate').value = '';
  document.getElementById('toDate').value = '';
  document.getElementById('filterForm').submit();
}
document.getElementById('fromDate').addEventListener('change', () => document.getElementById('weekPicker').value='');
document.getElementById('toDate').addEventListener('change',   () => document.getElementById('weekPicker').value='');
document.getElementById('weekPicker').addEventListener('change', () => {
  document.getElementById('fromDate').value=''; document.getElementById('toDate').value='';
});
window.addEventListener('click', e => { if (e.target.classList.contains('modal-overlay')) e.target.classList.remove('open'); });

function openEdit(id, name, desc, amount, date, cat) {
  document.getElementById('eId').value = id;
  document.getElementById('eName').value = name;
  document.getElementById('eDesc').value = desc;
  document.getElementById('eAmount').value = amount;
  document.getElementById('eDate').value = date;
  const sel = document.getElementById('eCat');
  for (let o of sel.options) o.selected = (o.value === cat);
  document.getElementById('editModal').classList.add('open');
}
</script>
</body>
</html>