@extends('layout.app')

@section('contents')
    <!-- Main banner carousel with overlay -->
    <div id="carouselExampleControls" class="carousel slide position-relative" data-bs-ride="carousel">
        <div class="carousel-overlay-left">
            <h2 class="text-white fw-bold">SPRING COLLECTION</h2>
            <a href="{{ route('products.index') }}"
               class="btn btn-outline-light fw-bold mt-3">
                SHOP ALL
            </a>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 sliding-image"
                     src="{{ asset('storage/banners/banner_product1.jpg') }}"
                     alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 sliding-image"
                     src="{{ asset('storage/banners/banner_product2.jpg') }}"
                     alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 sliding-image"
                     src="{{ asset('storage/banners/banner_product3.jpg') }}"
                     alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 sliding-image"
                     src="{{ asset('storage/banners/banner_product4.jpg') }}"
                     alt="Fourth slide">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <hr>

    <!-- Product categories section -->
    <section class="container my-5">
        <h2 class="text-center text-dark mb-4">CATEGORIES</h2>
        <div class="row text-center">
            <div class="col-6 col-md-3 mb-4">
                <a href="#" class="category-button">
                    <div class="image-frame">
                        <img src="{{ asset('storage/banners/necklace_category.jpg') }}"
                             alt="Necklaces"
                             class="category-image">
                        <div class="category-overlay">
                            <h4>Necklaces</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <a href="#" class="category-button">
                    <div class="image-frame">
                        <img src="{{ asset('storage/banners/earrings_category.jpg') }}"
                             alt="Earrings"
                             class="category-image">
                        <div class="category-overlay">
                            <h4>Earrings</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <a href="#" class="category-button">
                    <div class="image-frame">
                        <img src="{{ asset('storage/banners/bracelet_category.jpg') }}"
                             alt="Bracelets"
                             class="category-image">
                        <div class="category-overlay">
                            <h4>Bracelets</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <a href="#" class="category-button">
                    <div class="image-frame">
                        <img src="{{ asset('storage/banners/ring_category.jpg') }}"
                             alt="Rings"
                             class="category-image">
                        <div class="category-overlay">
                            <h4>Rings</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <hr>

    <!-- Secondary banner with registration promotion -->
    <div id="secondBanner" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active position-relative">
                <img class="d-block w-100 sliding-image"
                     src="{{ asset('storage/banners/banner_product5.jpg') }}"
                     alt="Product Image">
                <div class="banner-register text-center">
                    <h2 class="text-white fw-bold">REGISTER AND GET DISCOUNT 10% FOR YOUR FIRST PURCHASE!</h2>
                    <a href="../login_register/login_register_user.html" class="btn btn-outline-light fw-bold mt-3">REGISTER</a>
                </div>
            </div>
        </div>
    </div>
@endsection
