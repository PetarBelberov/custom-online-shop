<?php if (isset($user)): ?>
<div class="form">
    <h2>Edit Contact Information</h2>

    <form action="/edit-contact" method="POST">
        <div class="form-outline mb-4">
            <label class="form-label" for="name">Name:</label>
            <input class="form-control type="text" name="name" value="<?php echo $user['name']; ?>" required>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="surname">Surname:</label>
            <input class="form-control type="text" name="surname" value="<?php echo $user['surname']; ?>" required>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="email">Email:</label>
            <input class="form-control type="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>


        <div class="form-outline mb-4">
            <label class="form-label" for="phone">Phone:</label>
            <input class="form-control type="text" name="phone" value="<?php echo $user['phone']; ?>">
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="city">City:</label>
            <input class="form-control type="text" name="city" value="<?php echo $user['city']; ?>">
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">Save Changes</button>
    </form>
</div>
<?php else: ?>
    <p>No user found.</p>
<?php endif; ?>
