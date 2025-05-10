@extends('layout.app')

@section('title', "Images: {$product->title}")

@section('contents')
    <div class="container py-4">



        <h1 class="fw-bold mb-4">Edit images – {{ $product->title }}</h1>

        {{-- flash --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        {{-- aktuálne obrázky --}}
        <div class="row g-4 mb-5">
            @forelse($product->images as $img)
                <div class="col-6 col-md-3">
                    <div class="position-relative border rounded overflow-hidden">
                        <img src="{{ asset('storage/'.$img->url) }}"
                             class="img-fluid">
                        <form  method="POST"
                               action="{{ route('admin.products.images.destroy', [$product, $img]) }}"
                               class="position-absolute top-0 end-0 m-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this image?')">&times;</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No images yet.</p>
            @endforelse
        </div>

        {{-- upload nových --}}
        <h4 class="mb-3">Upload new images</h4>
        <form  method="POST"
               action="{{ route('admin.products.images.store', $product) }}"
               enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" multiple accept="image/*" class="form-control mb-3">

            <a  href="{{ route('admin.products.edit', $product) }}"
                class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i> back
            </a>

            <button class="btn btn-primary">Add images</button>



        </form>
    </div>
@endsection
