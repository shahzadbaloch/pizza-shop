<div>
    @foreach ($carts as $ind => $cart)
        @if (!empty($cart))
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0 align-items-center">
                    <div class="col-md-3">
                        <img src="{{ asset($cart['image']) }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $cart['name'] }}
                            </h5>
                            <p class="card-text">
                                PKR {{ $cart['total_price'] }}</p>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <button class="btn btn-sm btn-danger text-light" wire:click="removeCartItem({{ $ind }}) ">Remove</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group">
                            @if (isset($cart['addons']))
                                @foreach ($cart['addons'] as $addon)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $addon['name'] }}
                                        <span class="badge bg-primary rounded-pill">{{ $addon['quantity'] }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
