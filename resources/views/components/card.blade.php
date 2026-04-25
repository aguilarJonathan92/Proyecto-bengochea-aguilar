{{--  @props(['card']) --}}

<div class="card product-card h-100 m-1">
    {{-- Badge de descuento con z-index alto para estar sobre el link invisible --}}
    @if ($card['on_sale'])
        <div class="badge-producto" style="z-index: 3;">
            -{{ $card['discount'] }}%
        </div>
    @endif

    {{-- Imagen: El CSS se encarga de que todas midan lo mismo --}}
    <img src="{{ asset($card['image']) }}" class="card-img-top" alt="Imagen de {{ $card['title'] }}" loading="lazy">

    <div class="card-body">
        {{-- El CSS limitará esto a 2 líneas y mantendrá la altura --}}
        <h5 class="card-title">{{ $card['title'] }}</h5>
        <p class="card-subtitle">{{ $card['subtitle'] }}</p>

        {{-- Este div mt-auto es el que empuja todo hacia abajo --}}
        <div class="mt-auto">
            @if ($card['on_sale'])
                <p class="precio-descuento">
                    ${{ number_format($card['final_price'], 2, ',', '.') }}
                    <span class="descuento-label badge bg-success">{{ $card['discount'] }}% OFF</span>
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
                {{ $card['installments'] }} x ${{ number_format($card['installment_price'], 2, ',', '.') }}
                <span>sin interés</span>
            </p>

            <p class="envio"><i class="bi bi-truck"></i> Envío gratis</p>

            {{-- Stretched link: Hace que TODA la card sea clickeable sin romper el layout --}}
            <a href="{{ route('product-details', ['id' => $card['id']]) }}" class="stretched-link"></a>

            {{-- Botón con z-index para que sea clickeable INDEPENDIENTE del stretched link --}}
            <button type="button" class="btn btn-agregar position-relative" style="z-index: 2;">
                Añadir al carrito
            </button>
        </div>
    </div>
</div>
