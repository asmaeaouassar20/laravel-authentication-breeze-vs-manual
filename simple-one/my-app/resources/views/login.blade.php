<x-layout title="login">
            <x-form-errors />

<h1>Login</h1>
       <form method="post" action="{{ route('login.attempt') }}">
       <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
       @error('email') {{ $message }} @enderror
       <input name="password" type="password" placeholder="Password" value="{{ old('password') }}" />
       @error('password') {{ $message }} @enderror
       <button type="submit">Submit</button>
</form>
<p>Pas de compte ? <a href="{{ route('register') }}">S'inscrire</a></p>
</x-layout>