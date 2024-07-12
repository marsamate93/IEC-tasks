<?php

$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
$dateFilter = isset($_GET['date']) ? $_GET['date'] : '';
$personFilter = isset($_GET['person']) ? $_GET['person'] : '';



$statusOptions = $pdo->query("SELECT DISTINCT status FROM tasks ORDER BY status")->fetchAll(PDO::FETCH_ASSOC);
$dateOptions = $pdo->query("SELECT DISTINCT date FROM tasks ORDER BY date")->fetchAll(PDO::FETCH_ASSOC);
$personOptions = $pdo->query("SELECT DISTINCT person FROM tasks ORDER BY person")->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM tasks WHERE 1";
$params = [];


if (!empty($statusFilter)) {
    $query .= " AND status = :status";
    $params[':status'] = $statusFilter;
}

if (!empty($dateFilter)) {
    $query .= " AND date = :date";
    $params[':date'] = $dateFilter;
}

if (!empty($personFilter)) {
    $query .= " AND person = :person";
    $params[':person'] = $personFilter;
}

$query .= " ORDER BY id DESC";
?>

<script>
    function resetFilters() {
        document.getElementById('status').value = '';
        document.getElementById('date').value = '';
        document.getElementById('person').value = '';
        document.querySelector('form').submit();
    }
</script>