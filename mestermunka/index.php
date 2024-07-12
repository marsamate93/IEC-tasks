<?php
include('auth.php');
include('header.php');
include('database.php');
include('search.php');

$username = $_SESSION['user'];
$role = $_SESSION['role'];
?>


<div class="d-flex justify-content-between align-items-center my-3">
<div><h4>Üdvözöljük,<br>
 <?php echo htmlspecialchars($username); ?>!</h4>
</div>
       

 <?php
 if ($role === 'admin') {
     echo '<div class="button1">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Feladat hozzáadása</button>
    </div>';
 } ?>



         <div>
                <a href="logout.php" class="btn btn-danger">Kijelentkezés</a>
            </div>
        </div>



        <?php
        if (isset($_GET['message'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_GET['message']) . '</div>';
        }

        if (isset($_GET['insert_msg'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['insert_msg']) . '</div>';
        }

        if (isset($_GET['update_msg'])) {
            echo '<div class="alert alert-warning">' . htmlspecialchars($_GET['update_msg']) . '</div>';
        }

        if (isset($_GET['delete_msg'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['delete_msg']) . '</div>';
        }
        ?>

       

        <form method="get" class="row g-3 mb-3">

            <div class="col-md-4">
                <label for="status" class="form-label">Állapot</label>
                <select name="status" id="status" class="form-control">
                    <option value=""></option>
                    <?php foreach ($statusOptions as $option): ?>
                        <option value="<?php echo htmlspecialchars($option['status']); ?>" <?php if ($statusFilter == $option['status']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($option['status']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="col-md-4">
                <label for="date" class="form-label">Határidő</label>
                <select name="date" id="date" class="form-control">
                    <option value=""></option>
                    <?php foreach ($statusOptions as $option): ?>
                        <option value="<?php echo htmlspecialchars($option['status']); ?>" <?php if ($statusFilter == $option['status']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($option['status']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            
            <div class="col-md-4">
                <label for="person" class="form-label">Dolgozó</label>
                <select name="person" id="person" class="form-control">
                    <option value=""></option>
                    <?php foreach ($personOptions as $option): ?>
                        <option value="<?php echo htmlspecialchars($option['person']); ?>" <?php if ($personFilter == $option['person']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($option['person']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Szűrés</button>
                <button type="button" class="btn btn-danger" onclick="resetFilters()">Vissza</button>
            </div>
        </form>

        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Feladat</th>
                    <th>Feladat leírása</th>
                    <th>Állapot</th>
                    <th>Dolgozó</th>
                    <th>Határidő</th>
                    <?php if ($role === 'admin'): ?>
                        <th>Módosítás</th>
                        <th>Törlés</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $pdo->prepare($query);
                    $stmt->execute($params);
                    while ($row = $stmt->fetch()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['person']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <?php if ($role === 'admin'): ?>
                                <td><a href="update_task.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Módosítás</a></td>
                                <td><a href="delete_task.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Biztosan törölni szeretné ezt a feladatot?');">Törlés</a></td>
                            <?php endif; ?>
                        </tr>
                        <?php
                    }
                } catch (PDOException $e) {
                    die("Query Failed: " . $e->getMessage());
                }
                ?>
            </tbody>
        </table>

        <?php if ($role === 'admin'): ?>
            <form action="add_task.php" method="post">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Feladat hozzáadása</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="task">Feladat</label>
                                    <input type="text" name="task" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="task_description">Feladat leírása</label>
                                    <input type="text" name="task_description" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="status">Állapot</label>
                                    <input type="text" name="status" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="person">Dolgozó</label>
                                    <input type="text" name="person" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="date">Dátum</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                                <input type="submit" class="btn btn-success" name="add_task" value="Feladat hozzáadása">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>

<?php include('end.php'); ?>
