<!DOCTYPE html>
<html>
<body>

<h3>Admin Login</h3>

<form method="POST" action="/login">
    @csrf
    <label>Email</label>
    <input type="email" name="email">

    <label>Password</label>
    <input type="password" name="password">

    <button type="submit">Login</button>
</form>

</body>
</html>
