<x-layout title="dashboard">
    <h1>Dashboard</h1>
    <hr />
    <p>Si l'utilisateur est connecté, il peut accéder à cette page (dashboard), sinon il est redirigé vers la page de login</p>
    <hr />
    <h2>Bonjour {{ Auth::user()->name }}</h2>
    <form method="post" action="{{ route('logout') }}">
        <button type="submit">Se déconnecter</button>
    </form>    
    <p>Découvrir :  <a href="{{ route('dashboard2') }}">Dashboard 2</a></p>
</x-layout>