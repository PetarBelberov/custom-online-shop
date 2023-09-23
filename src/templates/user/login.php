<div class="form">
    <h2>Login</h2>
    <form action="/login" method="POST">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" name="email" id="form2Example1" class="form-control" />
            <label class="form-label">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example2" class="form-control" />
            <label class="form-label">Password</label>
        </div>

        <!-- Submit button -->
        <button type="submit" id="button" class="btn btn-primary btn-block mb-4">Sign in</button>

        <!-- Register buttons -->
        <div class="text-center">
            <p>Not a member? <a href="/register">Register</a></p>
        </div>
    </form>
</div>