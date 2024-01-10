<?php

$title = 'Users list';
ob_start();
?>

    <h1>Users list</h1>
    <a href="<?= APP_BASE_PATH ?>/users/create" class="btn btn-outline-success">Create user</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">EmailV</th>
            <th scope="col">Login</th>
            <th scope="col">IsAdmin</th>
            <th scope="col">IsActive</th>
            <th scope="col">Role</th>
            <th scope="col">LastLogin</th>
            <th scope="col">CreatedAt</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <th scope="row"><?php echo $user['id']; ?></th>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <?php
                /*
                            <td><?php echo $user['email_verification'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $user['login']; ?></td>
                            <td><?php echo $user['is_admin'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $user['is_active'] ? 'Yes' : 'No'; ?></td>
                */
                ?>
                <td><?php echo $user['email_verification']; ?></td>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['is_admin']; ?></td>
                <td><?php echo $user['is_active']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['last_login']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <a href="<?= APP_BASE_PATH ?>/users/edit/<?php echo $user['id']; ?>" class="btn btn-outline-primary">Edit</a>
                </td>
                <td>
                    <form method="post"
                          action="<?= APP_BASE_PATH ?>/users/delete/<?php echo $user['id']; ?>"
                          class="d-inline-block">
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>