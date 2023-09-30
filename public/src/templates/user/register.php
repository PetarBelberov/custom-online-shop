<div class="form">
    <h2>Register</h2>
    <form action="/register" method="POST">

        <div class="form-outline mb-4">
            <label class="form-label" for="name_register_form">Name</label>
            <input type="text" placeholder="Name" name="name" id="name_register_form" class="form-control" required/>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="surname_register_form">Surname</label>
            <input type="text" placeholder="Surname" name="surname" id="surname_register_form" class="form-control" />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="email_register_form">Email address</label>
            <input type="email" placeholder="Email address" name="email" id="email_register_form" class="form-control" />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="phone_register_form">Phone</label>
            <input type="text" placeholder="Phone" name="phone" id="phone_register_form" class="form-control" />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="city_register_form">City</label>
            <input type="text" placeholder="City" name="city" id="city_register_form" class="form-control" />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="password_register_form">Password</label>
            <input type="password" placeholder="Password" name="password" id="password_register_form" class="form-control" />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="confirm_password_register_form">Confirm password</label>
            <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" class="form-control" />
        </div>

        <!-- Submit button -->
        <button type="submit" id="button" class="btn btn-primary btn-block mb-4">Register</button>

        <div class="text-center">
            <p>Already have an account? <a href="/login">Login</a></p>
        </div>
    </form>
</div>