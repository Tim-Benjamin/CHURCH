<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sunday Entry – Church Finance</title>
<link rel="stylesheet" href="shared.css">
</head>
<body>
<?php
include 'db.php';
$activePage = 'sunday';
include 'nav.php';

$msg = ''; $msgType = '';

/* DELETE */
if (isset($_GET['delete_date'])) {
    $dd = $_GET['delete_date'];
    foreach (['main_offering','sunday_school','children_service','missions'] as $t)
        $pdo->prepare("DELETE FROM $t WHERE date=?")->execute([$dd]);
    $msg = "Entry for ".date('D, d M Y',strtotime($dd))." deleted."; $msgType = 'success';
}

/* EDIT LOAD */
$editMode = false; $editData = [];
if (isset($_GET['edit_date'])) {
    $ed = $_GET['edit_date'];
    $editMode = true;
    $get = fn($t) => (float)($pdo->query("SELECT COALESCE(SUM(amount),0) as v FROM $t WHERE date='$ed'")->fetch()['v']);
    $editData = ['date'=>$ed,'main'=>$get('main_offering'),'school'=>$get('sunday_school'),
        'kids'=>$get('children_service'),'missions'=>$get('missions')];
}

/* SAVE / UPDATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sunday_date'])) {
    $date   = $_POST['sunday_date'];
    $isEdit = ($_POST['mode'] === 'edit');
    try {
        if ($isEdit) {
            foreach (['main_offering','sunday_school','children_service','missions'] as $t)
                $pdo->prepare("DELETE FROM $t WHERE date=?")->execute([$date]);
        }
        $ins = fn($t,$amt) => $pdo->prepare("INSERT INTO $t (amount,date) VALUES (?,?)")->execute([$amt,$date]);
        if ((float)$_POST['main']     > 0) $ins('main_offering',   (float)$_POST['main']);
        if ((float)$_POST['school']   > 0) $ins('sunday_school',   (float)$_POST['school']);
        if ((float)$_POST['kids']     > 0) $ins('children_service',(float)$_POST['kids']);
        if ((float)$_POST['missions'] > 0) $ins('missions',        (float)$_POST['missions']);
        if ((float)$_POST['contrib_amt'] > 0 && !empty(trim($_POST['contrib_name']))) {
            $pdo->prepare("INSERT INTO contributions (name,amount,date,description) VALUES (?,?,?,?)")
                ->execute([trim($_POST['contrib_name']),(float)$_POST['contrib_amt'],$date,trim($_POST['contrib_desc'])]);
        }
        if ((float)$_POST['tithe_amt'] > 0 && !empty(trim($_POST['tithe_name']))) {
            $pdo->prepare("INSERT INTO tithes (name,amount,date) VALUES (?,?,?)")
                ->execute([trim($_POST['tithe_name']),(float)$_POST['tithe_amt'],$date]);
        }
        $msg = $isEdit ? "Entry for $date updated!" : "Sunday entry for $date saved!";
        $msgType = 'success'; $editMode = false; $editData = [];
    } catch (Exception $e) {
        $msg = 'Error: '.$e->getMessage(); $msgType = 'danger';
    }
}

/* HISTORY */
$history = $pdo->query("
  SELECT date,
    (SELECT COALESCE(SUM(amount),0) FROM main_offering m  WHERE m.date=d.date) as main_off,
    (SELECT COALESCE(SUM(amount),0) FROM sunday_school s  WHERE s.date=d.date) as school,
    (SELECT COALESCE(SUM(amount),0) FROM children_service c WHERE c.date=d.date) as kids,
    (SELECT COALESCE(SUM(amount),0) FROM missions ms WHERE ms.date=d.date)       as missions,
    (SELECT COALESCE(SUM(amount),0) FROM contributions ct WHERE ct.date=d.date)  as contrib,
    (SELECT COALESCE(SUM(amount),0) FROM tithes ti WHERE ti.date=d.date)         as tithes
  FROM (
    SELECT DISTINCT date FROM main_offering
    UNION SELECT DISTINCT date FROM sunday_school
    UNION SELECT DISTINCT date FROM children_service
  ) d ORDER BY date DESC LIMIT 24
")->fetchAll();
?>

<div class="container-md">
  <div class="page-header">
    <h1><?= $editMode ? '✏️ Edit Sunday Entry' : '✝ Sunday Entry' ?></h1>
    <p><?= $editMode ? 'Updating records for '.date('D, d M Y',strtotime($editData['date'])) : 'Record all offerings for one Sunday in a single form' ?></p>
  </div>

  <?php if ($msg): ?>
  <div class="alert-banner <?= $msgType ?> no-print">
    <span class="alert-icon"><?= $msgType==='success'?'✅':'❌' ?></span>
    <span><?= htmlspecialchars($msg) ?></span>
  </div>
  <?php endif; ?>

  <div class="info-note">
    <strong>Core Sunday Income</strong> — Main Offering, Sunday School & Children Service are always required.
    Missions, Contributions and Tithes are optional depending on the service.
  </div>

  <div class="form-card">
    <h2><?= $editMode ? '✏️ Update Entry' : '➕ New Sunday Entry' ?></h2>
    <form method="POST">
      <input type="hidden" name="mode" value="<?= $editMode ? 'edit' : 'new' ?>">
      <div class="form-grid full">
        <div class="form-group">
          <label>Sunday Date</label>
          <input type="date" name="sunday_date" required
            value="<?= $editMode ? $editData['date'] : date('Y-m-d') ?>"
            <?= $editMode ? 'readonly style="opacity:0.7;cursor:not-allowed"' : '' ?>>
        </div>
      </div>

      <p style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin:1.2rem 0 0.7rem;font-weight:600;border-top:1px solid var(--border);padding-top:1rem;">Core Sunday Offerings</p>
      <div class="form-grid col3">
        <div class="form-group">
          <label>Main Offering (GH₵)</label>
          <input type="number" name="main" step="0.01" min="0" placeholder="0.00"
            value="<?= $editMode ? $editData['main'] : '' ?>">
        </div>
        <div class="form-group">
          <label>Sunday School (GH₵)</label>
          <input type="number" name="school" step="0.01" min="0" placeholder="0.00"
            value="<?= $editMode ? $editData['school'] : '' ?>">
        </div>
        <div class="form-group">
          <label>Children Service (GH₵)</label>
          <input type="number" name="kids" step="0.01" min="0" placeholder="0.00"
            value="<?= $editMode ? $editData['kids'] : '' ?>">
        </div>
      </div>

      <p style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin:1.2rem 0 0.7rem;font-weight:600;border-top:1px solid var(--border);padding-top:1rem;">Optional Income</p>
      <div class="form-grid">
        <div class="form-group">
          <label>Missions (GH₵)</label>
          <input type="number" name="missions" step="0.01" min="0" placeholder="0.00"
            value="<?= $editMode ? $editData['missions'] : '' ?>">
        </div>
        <div></div>
      </div>
      <div class="form-grid col3">
        <div class="form-group">
          <label>Contribution — Name</label>
          <input type="text" name="contrib_name" placeholder="Contributor name">
        </div>
        <div class="form-group">
          <label>Contribution Amount (GH₵)</label>
          <input type="number" name="contrib_amt" step="0.01" min="0" placeholder="0.00">
        </div>
        <div class="form-group">
          <label>Note (optional)</label>
          <input type="text" name="contrib_desc" placeholder="Purpose or note">
        </div>
      </div>
      <div class="form-grid">
        <div class="form-group">
          <label>Tithe — Member Name</label>
          <input type="text" name="tithe_name" placeholder="Member name">
        </div>
        <div class="form-group">
          <label>Tithe Amount (GH₵)</label>
          <input type="number" name="tithe_amt" step="0.01" min="0" placeholder="0.00">
        </div>
      </div>

      <div style="display:flex;gap:10px;margin-top:1.2rem;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary">
          <?= $editMode ? '💾 Save Changes' : '✅ Save Sunday Entry' ?>
        </button>
        <?php if ($editMode): ?>
          <a href="sunday_entry.php" class="btn btn-ghost">✕ Cancel</a>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <!-- HISTORY -->
  <div class="section-card">
    <h3>Recent Sunday Entries
      <span style="font-family:'DM Sans',sans-serif;font-size:0.8rem;color:var(--muted);">Last 24 records</span>
    </h3>
    <?php if (empty($history)): ?>
      <div class="empty-state">No Sunday entries yet.</div>
    <?php else: ?>
    <div style="overflow-x:auto;">
    <table>
      <thead>
        <tr>
          <th>Date</th><th>Main</th><th>School</th><th>Children</th>
          <th>Missions</th><th>Contrib.</th><th>Tithes</th><th>Total</th>
          <th class="no-print">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($history as $h):
          $tot=$h['main_off']+$h['school']+$h['kids']+$h['missions']+$h['contrib']+$h['tithes'];
          $dash='<span style="color:var(--muted)">—</span>';
        ?>
        <tr>
          <td><strong><?= date('D, d M Y',strtotime($h['date'])) ?></strong></td>
          <td class="amount-pos">GH₵ <?= number_format($h['main_off'],2) ?></td>
          <td class="amount-pos">GH₵ <?= number_format($h['school'],2) ?></td>
          <td class="amount-pos">GH₵ <?= number_format($h['kids'],2) ?></td>
          <td><?= $h['missions']>0 ? '<span class="amount-pos">GH₵ '.number_format($h['missions'],2).'</span>' : $dash ?></td>
          <td><?= $h['contrib']>0  ? '<span class="amount-pos">GH₵ '.number_format($h['contrib'],2).'</span>'  : $dash ?></td>
          <td><?= $h['tithes']>0   ? '<span class="amount-pos">GH₵ '.number_format($h['tithes'],2).'</span>'   : $dash ?></td>
          <td><strong class="amount-pos">GH₵ <?= number_format($tot,2) ?></strong></td>
          <td class="no-print">
            <div style="display:flex;gap:5px;flex-wrap:wrap;">
              <a href="sunday_entry.php?edit_date=<?= $h['date'] ?>" class="btn btn-ghost btn-sm">✏️ Edit</a>
              <a href="sunday_entry.php?delete_date=<?= $h['date'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Delete all income for <?= date('d M Y',strtotime($h['date'])) ?>?')">🗑 Delete</a>
              <a href="counting_sheet.php?date=<?= $h['date'] ?>" class="btn btn-print btn-sm">📋 Sheet</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>