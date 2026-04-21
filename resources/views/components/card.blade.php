@props(['card'])
<div class="card product-card h-100">
  {{-- Badge de descuento --}}
    @if($card['on_sale'])
        <div class="badge-producto">
            -{{ $card['discount'] }}%
        </div>
    @endif
    <a href="{{ route('product-details') }}" class="card-link">

    <img src="{{ $card['image'] }}" class="card-img-top" alt="{{ $card['title'] }}"> 

    <div class="card-body">
      <h5 class="card-title">{{ $card['title']}}</h5>
      <p class="card-subtitle">{{ $card['subtitle']}}</p>

      @if($card['on_sale'])
        @php
          $finalPrice = $card['price'] - ($card['price'] * $card['discount'] / 100);
        @endphp

        <p class="precio-descuento">
          ${{ number_format($finalPrice, 2, ',', '.') }} <span class="descuento-label">{{ $card['discount'] }}% OFF</span>
        </p>

        <p class="precio-original">
          ${{ number_format($card['price'], 2, ',', '.') }} 
        </p>
      @else
        <p class="precio">
          ${{ number_format($card['price'], 2, ',', '.') }}
        </p>
      @endif
      <p class="cuotas">
          {{ $card['installments'] }} x 
          ${{ number_format($card['installment_price'], 2, ',', '.') }} 
          <span>sin interés</span>
      </p>
      <p class="envio">Envío gratis</p>
      <a href="#" class="btn btn-agregar">Añadir al carrito</a>
    </div>
  </a>
</div>

