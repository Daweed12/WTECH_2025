
@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('contents')
    <div class="container py-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="mb-4 fw-bold">Admin mode</h1>
        <h4 class="mb-3">All items</h4>

        <button type="button"
                class="btn btn-primary mb-4"
                data-bs-toggle="modal"
                data-bs-target="#addProductModal">
            ➕ Add Product
        </button>

        <form method="GET"
              action="{{ route('admin.dashboard') }}"
              class="mb-4">
            <div class="input-group">
                <input type="text"
                       name="q"
                       class="form-control"
                       placeholder="Search products…"
                       value="{{ $search ?? '' }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>

        <div class="modal fade" id="addProductModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('admin.products.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">New product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Title*</label>
                                    <input name="title" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">SKU</label>
                                    <input name="sku" class="form-control" placeholder="auto">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Slug</label>
                                    <input name="slug" class="form-control" placeholder="auto-from-title">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Price (€)*</label>
                                    <input type="number" step="0.01" min="0"
                                           name="price" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Discount %</label>
                                    <input type="number" step="1" min="0"
                                           name="discount" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Popularity</label>
                                    <input type="number" step="1" min="0"
                                           name="popularity" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Category*</label>
                                    <select name="category" class="form-select" required>
                                        <option value="" disabled selected>– choose –</option>
                                        <option value="rings">Rings</option>
                                        <option value="necklaces">Necklaces</option>
                                        <option value="bracelets">Bracelets</option>
                                        <option value="earrings">Earrings</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Color / Material*</label>
                                    <select name="color" class="form-select" required>
                                        <option value="" disabled selected>– choose –</option>
                                        <option value="silver">Silver</option>
                                        <option value="gold">Gold</option>
                                        <option value="diamond">Diamond</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="" selected>– choose –</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                        <option value="unisex">Unisex</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Detail (short label)</label>
                                <input name="details" class="form-control">
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Description*</label>
                                <textarea name="description" rows="4"
                                          class="form-control" required></textarea>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Summary (HTML allowed)</label>
                                <textarea name="summary" rows="3"
                                          class="form-control"></textarea>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Images (2 – 4)</label>
                                <input type="file" name="images[]" accept="image/*"
                                       multiple class="form-control" required>
                                <div class="form-text">
                                    Upload 2 – 4 images (max 5 MB each).
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary">Save product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-md-4 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <div class="product-card">
                        <img src="{{ $product->first_image_url }}"
                             alt="{{ $product->title }}">

                        <div class="product-card-overlay">
                            <div class="action-icons">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   title="Edit"><i class="fa-solid fa-pen"></i></a>

                                <a href="#"
                                   title="Delete"
                                   onclick="event.preventDefault(); if(confirm('Delete?')) document.getElementById('del-{{ $product->id }}').submit();">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                            <h6 class="title-overlay">{{ strtoupper($product->title) }}</h6>
                        </div>
                    </div>

                    <p class="mt-2 mb-0 fw-semibold">
                        {{ number_format($product->price, 2) }} €
                        <span class="text-muted small">s DPH</span>
                    </p>

                    <form id="del-{{ $product->id }}"
                          method="POST"
                          action="{{ route('admin.products.destroy', $product) }}"
                          style="display:none;">
                        @csrf @method('DELETE')
                    </form>
                </div>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>

    </div>
@endsection

