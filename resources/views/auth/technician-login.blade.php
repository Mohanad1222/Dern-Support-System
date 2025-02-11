<h1>TECHNICIAN LOGIN FORM</h1>
<form action={{route('technician.login')}} method="POST">
    @csrf
    <input name='technician_name' type="text" placeholder="tech name">
    <input name='password' type="text" placeholder="password">
    <input type="submit" value="submit">
    @foreach ($errors->all() as $error)
    <h1>{{ $error }}</h1>
@endforeach
</form>