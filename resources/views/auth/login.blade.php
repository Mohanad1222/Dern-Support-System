<h1>LOGIN FORM</h1>
<form action={{route('auth.login')}} method="POST">
    @csrf
    <input name='user_name' type="text" placeholder="username">
    <input name='password' type="text" placeholder="password">
    <input type="submit" value="submit">
    @foreach ($errors->all() as $error)
    <h1>{{ $error }}</h1>
@endforeach
</form>