<?php

$title = 'Roles list';
ob_start();
?>

    <h1>Roles list</h1>
    <a href="index.php?page=roles&action=create" class="btn btn-outline-success">Create role</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <th scope="row"><?php echo $role['id']; ?></th>
                <td><?php echo $role['name']; ?></td>
                <td><?php echo $role['description']; ?></td>
                <td>
                    <a href="index.php?page=roles&action=edit&id=<?php echo $role['id']; ?>" class="btn btn-outline-primary">Edit</a>
                </td>
                <td>
                    <form method="post"
                          action="index.php?page=roles&action=delete&id=<?php echo $role['id']; ?>"
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