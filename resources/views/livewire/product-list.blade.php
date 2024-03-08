<div>
    <h1 class="mb-4">Fresh fruits shop</h1>
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4 justify-content-center">
                        @foreach ($products as $item)
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item">
                                    <a href="javascript:void(0);" wire:click.prevent="selectProduct({{ $item }})">
                                        <div class="fruite-img">
                                            <img src="{{ asset($item->image) }}" class="img-fluid w-100 rounded-top"
                                                alt="">
                                        </div>
                                    </a>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; left: 10px;">Fruits</div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>{{ $item->name }}</h4>
                                        <p>{{ $item->description }}</p>
                                        <p>{{ $item->is_addon ? 'With Addons' : 'Without Addons' }}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">PKR {{ $item->price }}</p>
                                            <a href="javascript:void(0);"
                                                class="btn border border-secondary rounded-pill px-3 text-primary"wire:click.prevent="abs({{ $item }})"><i
                                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" wire:ignore.self>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ $productItem ? $productItem['name'] : 'asd' }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-7 overflow-auto">
                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseOne" aria-expanded="true"
                                                                aria-controls="flush-collapseOne">
                                                                Add-ons
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="flush-headingOne"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                @foreach ($addons as $addon)
                                                                    <div class="card mb-3" style="max-width: 540px;">
                                                                        <div class="row g-0 align-items-center">
                                                                            <div class="col-md-3">
                                                                                <img src="{{ asset($addon->image) }}"
                                                                                    class="img-fluid rounded-start"
                                                                                    alt="...">
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">
                                                                                        {{ $addon->name }}
                                                                                    </h5>
                                                                                    <p class="card-text">(+PKR
                                                                                        {{ $addon->price }})</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 text-center">
                                                                                <button
                                                                                    class="btn btn-sm btn-primary text-light"
                                                                                    wire:click="addAddonInProduct({{ $addon }})">ADD</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-5">
                                                <div class="card" style="width: 18rem;">
                                                    @if ($productItem)
                                                        <img src="{{ asset($productItem['image']) }}"
                                                            class="card-img-top" alt="...">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $productItem['name'] }}</h5>
                                                        <p class="card-text">PKR {{ $productItem['total_price'] }}</p>

                                                        <div class="btn-group btn-group-sm" role="group"
                                                            aria-label="Basic mixed styles example">
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="productItemDecrement()">-</button>
                                                            <button type="button" class="btn btn-light"
                                                                disabled>{{ $productItem['quantity'] }}</button>
                                                            <button type="button" class="btn btn-primary text-light"
                                                                wire:click="productItemIncrement()">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        @if (isset($productItem['addons']))
                                                            <ol class="list-group list-group-numbered">
                                                                @foreach ($productItem['addons'] as $ind => $addon)
                                                                    <li
                                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                                        <div class="ms-2 me-auto">
                                                                            <div class="fw-bold">{{ $addon['name'] }}
                                                                            </div>
                                                                            +(PKR {{ $addon['total_price'] }})

                                                                            <button class="btn btn-sm btn-danger"
                                                                                wire:click="removeAddonItem({{ $ind }})">-</button>
                                                                        </div>
                                                                        <span
                                                                            class="badge bg-primary rounded-pill">{{ $addon['quantity'] }}</span>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary text-light"
                                            data-bs-dismiss="modal" wire:click.prevent="addToCart()">PKR
                                            {{ isset($productItem['addons']) ? $productItem['total_price'] + collect($productItem['addons'])->sum('total_price') : $productItem['total_price'] }}
                                            Add to
                                            cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
