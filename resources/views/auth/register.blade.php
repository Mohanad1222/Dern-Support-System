<h1>REGISTER FORM</h1>
<form action={{route('auth.register')}} method="POST">
    @csrf
    <input name='user_name' type="text" placeholder="username">
    <input name='user_password' type="password" placeholder="password">
    <input name='user_password_confirmation' type="password" placeholder="password confirm">
    <input type="submit" value="submit">
    @foreach ($errors->all() as $error)
    <h1>{{ $error }}</h1>
@endforeach
</form>