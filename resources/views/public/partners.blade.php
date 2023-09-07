<section class="page-section" id="partners">
    <h1 style="display:flex; justify-content: center; margin-bottom: 30px">Наши партнеры</h1>
    <div class="container">
        <div class="d-flex justify-content-center bd-highlight mb-3" style="flex-wrap: wrap">
            @foreach($partners as $item)
                <div class="p-2 bd-highlight">
                    <div class="row">
                        <div class="partner-card shadow-sm" style="max-width: 150rem">
                            <div class="row">
                                <img style="margin-left: auto; margin-right: auto"
                                     src="{{ asset('storage/partnerPhoto/' . $item['photo'] . '.jpg') }}"
                                     alt="Card image cap">
                            </div>
                            <div class="row" style="align-content: center">
                                <p>{{ $item['name'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{--style="display:flex; justify-content: center; float: none; margin: 0 auto;"--}}
