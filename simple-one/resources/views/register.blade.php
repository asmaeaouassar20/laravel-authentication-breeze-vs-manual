<x-layout title="register">
      <x-form-errors />
              <h1>Register</h1>
       <form method="post" action="{{ route('register.store') }}">
       <input name="name" type="text" placeholder="Name" value="{{ old('name') }}">
       @error('name') {{ $message }} @enderror

       <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
       @error('email') {{ $message }} @enderror

       <input name="password" type="password" placeholder="Password" value="{{ old('password') }}" />
       @error('password') {{ $message }} @enderror

       <input name="password_confirmation" type="password" placeholder="Password Confirmation"  />
       @error('password_confirmation') {{ $message }} @enderror

       <button type="submit">Submit</button>
</form>
<p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
</x-layout>