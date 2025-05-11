@extends('layout.app')

@section('title', "Edit product: {$product->title}")

@section('contents')
    <div class="container py-4">

        <h1 class="fw-bold mb-4">Admin mode</h1>
        <h3 class="mb-5">Current item</h3>

        <form  method="POST"
               action="{{ route('admin.products.update', $product) }}"
               enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row g-5">

                <div class="col-12 col-md-4">

                    <img  src="{{ $product->first_image_url ?? asset('storage/defaults/no-image.png') }}"
                          class="img-fluid mb-4 shadow-sm border"
                          alt="{{ $product->title }}">

                    <a  href="{{ route('admin.products.images.edit', $product) }}"
                        class="btn w-100 text-white"
                        style="background:#3d0c2f">
                        Edit Images
                    </a>
                </div>

                <div class="col-12 col-md-8">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $product->title) }}"
                               class="form-control @error('title') is-invalid @enderror">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Price (€)</label>
                        <input type="number" step="0.01"
                               name="price"
                               value="{{ old('price', $product->price) }}"
                               class="form-control @error('price') is-invalid @enderror">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Discount (%)</label>
                        <input type="number"
                               name="discount"
                               value="{{ old('discount', $product->discount) }}"
                               class="form-control @error('discount') is-invalid @enderror">
                        @error('discount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <input type="text"
                               name="category"
                               value="{{ old('category', $product->category) }}"
                               class="form-control @error('category') is-invalid @enderror">
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Color</label>
                            <input type="text"
                                   name="color"
                                   value="{{ old('color', $product->color) }}"
                                   class="form-control @error('color') is-invalid @enderror">
                            @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Gender</label>
                            <select name="gender"
                                    class="form-select @error('gender') is-invalid @enderror">
                                <option value="">—</option>
                                <option value="unisex"  @selected(old('gender', $product->gender)=='unisex')>Unisex</option>
                                <option value="female"  @selected(old('gender', $product->gender)=='female')>Female</option>
                                <option value="male"    @selected(old('gender', $product->gender)=='male')>Male</option>
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea  name="description"
                                   rows="3"
                                   class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Summary</label>
                        <textarea  name="summary"
                                   rows="2"
                                   class="form-control @error('summary') is-invalid @enderror">{{ old('summary', $product->summary) }}</textarea>
                        @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Details (JSON / key-value)</label>
                        <textarea  name="details"
                                   rows="3"
                                   class="form-control @error('details') is-invalid @enderror">{{ old('details', json_encode($product->details, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)) }}</textarea>
                        @error('details') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">SKU</label>
                            <input type="text"
                                   name="sku"
                                   value="{{ old('sku', $product->sku) }}"
                                   class="form-control @error('sku') is-invalid @enderror">
                            @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text"
                                   name="slug"
                                   value="{{ old('slug', $product->slug) }}"
                                   class="form-control @error('slug') is-invalid @enderror">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Popularity</label>
                        <input type="number"
                               name="popularity"
                               value="{{ old('popularity', $product->popularity) }}"
                               class="form-control @error('popularity') is-invalid @enderror">
                        @error('popularity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit"
                            class="btn w-100 text-white py-2 fw-semibold"
                            style="background:#3d0c2f">
                        Save changes
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection

