<?php

$query = "SELECT * FROM users";
$result = mysqli_query($connect, $query);
?>

<div class="container">
    <h2 class="head">Registered Users</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registration Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo ucwords(strtolower($row['role'])); ?></td>
                    <td><?php echo date("Y-m-d h:iA", $row['time']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
