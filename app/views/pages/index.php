<?php

$title = 'Pages list';
ob_start();
?>

    <h1>Pages list</h1>
    <a href="<?= APP_BASE_PATH ?>/pages/create" class="btn btn-outline-success">Create page</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Role</th>
            <th scope="col">Updated</th>
            <th scope="col">Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pages as $page): ?>
            <tr>
                <th scope="row"><?php echo $page['id']; ?></th>
                <td><?php echo $page['title']; ?></td>
                <td><?php echo $page['slug']; ?></td>
                <td><?php echo $page['role']; ?></td>
                <td><?php echo $page['updated_at']; ?></td>
                <td><?php echo $page['created_at']; ?></td>
                <td>
                    <a href="<?= APP_BASE_PATH ?>/pages/edit/<?php echo $page['id']; ?>"
                       class="btn btn-outline-primary">Edit</a>
                </td>
                <td>
                    <form method="post"
                          action="<?= APP_BASE_PATH ?>/pages/delete/<?php echo $page['id']; ?>"
                          class="d-inline-block">
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure?')">Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>