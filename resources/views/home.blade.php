@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Planes Disponibles</h4>

                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $plan->name }}</h5>
                                        <p class="card-text">Precio: ${{ $plan->price }}</p>
                                        <p class="card-text">Límite: {{ number_format($plan->message_limit) }} mensajes</p>
                                        <form action="{{ route('purchase.plan', $plan->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Adquirir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
