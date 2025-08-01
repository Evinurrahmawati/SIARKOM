@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="button-container">
        
        @if(Auth::user()->role === 'admin')
            <a href="{{ url('/admin/menu') }}" class="button">MENU</a>
        @elseif(Auth::user()->role === 'operator')
            <a href="{{ url('/operator/menu') }}" class="button">MENU</a>
        @else
            <p style="color: white; font-weight: bold;">Role tidak dikenali.</p>
        @endif
    </div>
@endsection
