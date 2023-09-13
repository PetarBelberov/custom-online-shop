<h2>Register</h2>

<form action="/register" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" required>

    <label for="surname">Surname:</label>
    <input type="text" name="surname" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone">

    <label for="city">City:</label>
    <input type="text" name="city">

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>

    <button type="submit">Register</button>
</form>