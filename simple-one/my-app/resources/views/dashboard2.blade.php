<x-layout title="dashboard">
    <h1>Dashboard 2</h1>
    @auth
        <h2>Bonjour {{ Auth::user()->name }} vous êtes connecté</h2>
        <p>Décourvir <a href="{{ route('dashboard') }}">Dashboard</a></p>
        <form method="post" action="{{ route('logout') }}">
            <button type="submit">Se déconnecter</button>
        </form>
    @endauth

    @guest 
          <a href="{{ route('login') }}">Se connecter</a>
          <a href="{{ route('register') }}" >S'inscrire</a>
    @endguest
</x-layout>