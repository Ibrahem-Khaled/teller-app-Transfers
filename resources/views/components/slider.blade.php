<style>
    /* تصميم السلايدر */
    #mainSlider {
        max-height: 350px;
        overflow: hidden;
        max-width: 90%;
        margin: 20px auto;
        position: relative;
        border-radius: 20px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
    }

    #mainSlider .carousel-item img {
        object-fit: contain;
        border-radius: 20px;
        transition: transform 0.5s ease-in-out;
    }

    #mainSlider .carousel-item:hover img {
        transform: scale(1.05);
    }

    #mainSlider .carousel-caption {
        background: rgba(0, 0, 0, 0.6);
        padding: 15px;
        border-radius: 10px;
        color: #ffffff;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.8);
    }

    /* النقاط (Indicators) */
    .carousel-indicators [data-bs-target] {
        background-color: #ffffff;
        border: 1px solid #4a2f85;
    }

    .carousel-indicators .active {
        background-color: #4a2f85;
    }

    /* الأزرار (Controls) */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 10px;
    }

    @media (max-width: 768px) {
        #mainSlider {
            max-height: 300px;
        }

        #mainSlider .carousel-caption h5 {
            font-size: 1.2rem;
        }

        #mainSlider .carousel-caption p {
            font-size: 0.9rem;
        }
    }
</style>

<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
    <!-- النقاط (Indicators) -->
    <div class="carousel-indicators">
        @foreach ($slides as $key => $slide)
            <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="{{ $key }}"
                class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : '' }}"
                aria-label="Slide {{ $key + 1 }}"></button>
        @endforeach
    </div>

    <!-- الشرائح (Slides) -->
    <div class="carousel-inner">
        @foreach ($slides as $key => $slide)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $slide->image) }}" class="d-block w-100" alt="{{ $slide->title }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $slide->title }}</h5>
                    <p>{{ $slide->description }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- الأزرار (Controls) -->
    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
