<div>
    <div>
        Hola este solo es usuario
    </div>
    <div>
        <input type="text" wire:model="orderId" placeholder="Ingrese el ID de la orden">
        <button type="text" wire:click='filterOrders'> Buscar </button>

    </div>
    <div>
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Id #{{ $order['id'] }}</h5>
                    <p class="card-text">
                        <strong>Orden:</strong> {{ $order['order_number'] }}<br>
                        <strong>Cliente:</strong> {{ $order['target_customer'] }}<br>
                        <strong>Peso Total:</strong> {{ $order['total_weight'] }} kg<br>
                        <strong>Dirección:</strong> {{ $order['address'] }}<br>
                        <strong>Contenedor:</strong> {{ $order['container'] }}
                    </p>
                    <br>
                </div>
            </div>
        @endforeach
    </div>
</div>
