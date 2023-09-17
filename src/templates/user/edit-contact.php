<h2>Edit Contact Information</h2>

<form action="/edit-contact" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

    <label for="surname">Surname:</label>
    <input type="text" name="surname" value="<?php echo $user['surname']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="<?php echo $user['phone']; ?>">

    <label for="city">City:</label>
    <input type="text" name="city" value="<?php echo $user['city']; ?>">

    <button type="submit">Save Changes</button>
</form>