<?php
$title = 'User edit';
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="text-center mb-4">User edit</h1>
        <form method="post" action="index.php?page=users&action=update&id=<?php echo $user['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login"
                       value="<?php echo $user['login']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="0">
                        None
                    </option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id']; ?>" <?php if ($user['role'] == $role['id']) echo ' selected'; ?>>
                            <?php echo $role['id']; ?> -> <?php echo $role['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update user</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>
