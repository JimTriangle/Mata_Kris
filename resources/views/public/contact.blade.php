@extends('components.layouts.public')

@section('content')
<div class="container">
    <h1 style="text-align: center">Contactez-nous</h1>
    <p style="text-align: center; max-width: 600px; margin: 0 auto 40px auto;">
        Pour toute demande de renseignement ou booking, n'hésitez pas à utiliser le formulaire ci-dessous.
    </p>

    <div class="contact-form">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Votre nom</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Votre email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Votre message</label>
                <textarea id="message" name="message" rows="6" required></textarea>
            </div>
            <div style="text-align: center;">
                <button type="submit" class="button">Envoyer</button>
            </div>
        </form>
    </div>
</div>
@endsection