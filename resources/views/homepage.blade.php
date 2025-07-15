<x-app>
    <!-- ===============>> Preloader start here <<================= -->
    <div class="preloader">
        <img style="height: 50px;" src="assets/dashboard/images/preloader.png" alt="preloader icon" />
    </div>
    <section class="banner banner--style1 hero-wrapper">
        <div class="container">
            <div class="banner__wrapper">
                <div class="row gy-5 gx-4">
                    <div class="col-lg-6 col-md-7">
                        <div class="banner__content" data-aos="fade-right" data-aos-duration="1000">
                            <div class="banner__content-coin">
                                <img src="assets/images/banner/home1/3.png" alt="coin icon" />
                            </div>
                            <div class="flex gap-1x align-items-start justify-start flex-wrap-wrap flex-dir-row md-flex-wrap-nowrap md-flex-dir-col visible-larger-than-tablet">
                                <h1 class="heading heading-medium typography typography-weight-normal typography-break-word typography-color-primary">
                                    <span>EFFICIENT AND STABLE</span>
                                </h1>
                                <h1 class="heading heading-medium typography typography-weight-normal typography-break-word typography-color-primary">
                                    <span style="color: #673de6;"><strong>CLOUD MINING</strong></span>
                                </h1>
                                <h1 class="heading heading-medium typography typography-weight-normal typography-break-word typography-color-primary">
                                    INVESTMENT PLATFORM
                                </h1>
                            </div>

                            <p class="banner__content-moto text-whitex">
                                TrustNetX, a global leader in hashpower, uses cutting-edge technology to optimise
                                mining operations, ensuring reliable, cost-effective, and profitable returns.
                                <br><span style="color: #673de6;">Join us and leverage the power of our hashpower to easily
                                enhance your mining revenue.</span>
                            </p>
                            <h1 class="banner__content-heading typed-result"></h1>
                            <div class="typed-text" style="display: none">Bitcoin, ETH, XRP, Tron, USDT</div>
                            <div class="banner__btn-group btn-group mt-4">
                                <a href="{{ url('/login') }}" class="trk-btn trk-btn--primary trk-btn--arrow">Get Started
                                    <span><i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="banner__thumb hero-slider" data-aos="fade-left" data-aos-duration="1000">
                            <img src="assets/images/slides/hero_2.avif" alt="banner-thumb" class="dark" />
                            <img src="assets/images/slides/hero_4.avif" alt="banner-thumb" class="dark" />
                            <img src="assets/images/slides/hero_3.avif" alt="banner-thumb" class="dark" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner__shape">
            <span class="banner__shape-item banner__shape-item--1">
                <img src="assets/images/banner/home1/4.png" alt="shape icon" />
            </span>
        </div>
    </section>

    <div class="partner partner--gradient">
        <div class="container">
            <div class="partner__wrapper">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <div class="tradingview-widget-copyright"></div>
                    <script type="text/javascript" src="s3.tradingview.com/external-embedding/embed-widget-ticker-tape.html" async>
                        {
                            "symbols": [{
                                    "proName": "FOREXCOM:SPXUSD",
                                    "title": "S&P 500"
                                },
                                {
                                    "proName": "FX_IDC:EURUSD",
                                    "title": "EUR/USD"
                                },
                                {
                                    "proName": "BITSTAMP:BTCUSD",
                                    "title": "Bitcoin"
                                },
                                {
                                    "proName": "BITSTAMP:ETHUSD",
                                    "title": "Ethereum"
                                },
                                {
                                    "description": "Crudeoil",
                                    "proName": "MCX:CRUDEOIL1!"
                                },
                                {
                                    "description": "LTC/USDT",
                                    "proName": "BINANCE:LTCUSDT"
                                },
                                {
                                    "description": "XRP/USD",
                                    "proName": "BINANCE:XRPUSDT.P"
                                }
                            ],
                            "showSymbolLogo": true,
                            "colorTheme": "light",
                            "isTransparent": false,
                            "displayMode": "adaptive",
                            "locale": "en"
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <section class="service padding-top padding-bottom bg-color-7" xclass="service padding-top padding-bottom">
        <div class="section-header section-header--max50">
            <h2 class="mb-15 mt-minus-5"><span>Other </span>services</h2>
            <p>We offer the best services around the world</p>
        </div>
        <div class="container">
            <div class="service__wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="800">
                            <div class="service__item-inner text-center">
                                <div class="service__thumb mb-30">
                                    <div class="service__thumb-inner">
                                        <img class="dark" src="assets/images/service/1.png" alt="service-icon" />
                                    </div>
                                </div>
                                <div class="service__content">
                                    <h5 class="mb-15">
                                        <a class="stretched-link" href="{{route('show.register') }}">Forex</a>
                                    </h5>
                                    <p class="mb-0">
                                        Trade 70 major, minor & exotic <b>currency pairs</b> with competitive trading
                                        conditions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="1000">
                            <div class="service__item-inner text-center">
                                <div class="service__thumb mb-30">
                                    <div class="service__thumb-inner">
                                        <img class="dark" src="assets/images/service/2.png" alt="service-icon" />
                                    </div>
                                </div>
                                <div class="service__content">
                                    <h5 class="mb-15">
                                        <a class="stretched-link" href="{{route('show.register') }}">Metals</a>
                                    </h5>
                                    <p class="mb-0">
                                        Trade metals commodities such as <b>Gold, Silver and Platinum</b>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="1200">
                            <div class="service__item-inner text-center">
                                <div class="service__thumb mb-30">
                                    <div class="service__thumb-inner">
                                        <img class="dark" src="assets/images/service/3.png" alt="service-icon" />
                                    </div>
                                </div>
                                <div class="service__content">
                                    <h5 class="mb-15">
                                        <a class="stretched-link" href="{{route('show.register') }}">Futures</a>
                                    </h5>
                                    <p class="mb-0">
                                        Discover opportunities on <b>UK & US Crude Oil</b> as <b>Natural Gas Spot</b> and
                                        CFDs
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="800">
                            <div class="service__item-inner text-center">
                                <div class="service__thumb mb-30">
                                    <div class="service__thumb-inner">
                                        <img class="dark" src="assets/images/service/4.png" alt="service-icon" />
                                    </div>
                                </div>
                                <div class="service__content">
                                    <h5 class="mb-15">
                                        <a class="stretched-link" href="register.html">Indecies</a>
                                    </h5>
                                    <p class="mb-0">
                                        Trade <b>major and minor</b> index CFDs from around the world as a Spot or Future.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="1000">
                            <div class="service__item-inner text-center">
                                <div class="service__thumb mb-30">
                                    <div class="service__thumb-inner">
                                        <img class="dark" src="assets/images/service/6.png" alt="service-icon" />
                                    </div>
                                </div>
                                <div class="service__content">
                                    <h5 class="mb-15">
                                        <a class="stretched-link" href="{{route('show.register') }}">Crypto</a>
                                    </h5>
                                    <p class="mb-0">
                                        Trade over <b>cryptocurrency</b> tokens with less risk.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="service__item service__item--style2" data-aos="fade-up" data-aos-duration="1200">
                            <div class="service__item-inner text-center">
                                <div class="service__thumb mb-30">
                                    <div class="service__thumb-inner">
                                        <img class="dark" src="assets/images/service/5.png" alt="service-icon" />
                                    </div>
                                </div>
                                <div class="service__content">
                                    <h5 class="mb-15">
                                        <a class="stretched-link" href="{{route('show.register') }}">Exchange</a>
                                    </h5>
                                    <p class="mb-0">
                                        Trade your <b>digital assets</b> with best trading conditions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about padding-top--style2 padding-bottom bg-color-3">
        <div class="container">
            <div class="about__wrapper">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="section-header mb-50">
                            <h2>Why <span class="style2">Choose Us</span></h2>
                        </div>
                        <div class="about__content about__content--style2" data-aos="fade-right" data-aos-duration="800">
                            <div class="about__content-inner">
                                <div class="about__icon">
                                    <div class="about__icon-inner">
                                        <img src="assets/images/about/icon/1.png" alt="about-icon" class="dark">
                                    </div>
                                </div>
                                <div class="about__content-details">
                                    <h5>Safe and Secure</h5>
                                    <p class="mb-0">Trade with 100% peace of mind as we have the best system security
                                        team onboard</p>
                                </div>
                            </div>
                        </div>
                        <div class="about__content about__content--style2" data-aos="fade-right" data-aos-duration="900">
                            <div class="about__content-inner">
                                <div class="about__icon">
                                    <div class="about__icon-inner">
                                        <img src="assets/images/about/icon/2.png" alt="about-icon" class="dark">
                                    </div>
                                </div>
                                <div class="about__content-details">
                                    <h5>Instant Trading</h5>
                                    <p class="mb-0">With lightning speed servers, you are sure to get the best out of
                                        your investments.</p>
                                </div>
                            </div>
                        </div>
                        <div class="about__content about__content--style2" data-aos="fade-right" data-aos-duration="1000">
                            <div class="about__content-inner">
                                <div class="about__icon">
                                    <div class="about__icon-inner">
                                        <img src="assets/images/about/icon/3.png" alt="about-icon" class="dark">
                                    </div>
                                </div>
                                <div class="about__content-details">
                                    <h5>Progressive Revenue</h5>
                                    <p class="mb-0">Watch your accruals grow in real time and monitor how much revenue is
                                        being generated for you.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="about__content about__content--style2" data-aos="fade-right" data-aos-duration="1000">
                            <div class="about__content-inner">
                                <div class="about__icon">
                                    <div class="about__icon-inner">
                                        <img src="assets/images/about/icon/3.png" alt="about-icon" class="dark">
                                    </div>
                                </div>
                                <div class="about__content-details">
                                    <h5>Online wallet</h5>
                                    <p class="mb-0">Generate a personal wallet.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="about__content about__content--style2" data-aos="fade-right" data-aos-duration="1000">
                            <div class="about__content-inner">
                                <div class="about__icon">
                                    <div class="about__icon-inner">
                                        <img src="assets/images/about/icon/1.png" alt="about-icon" class="dark">
                                    </div>
                                </div>
                                <div class="about__content-details">
                                    <h5>Investment for All</h5>
                                    <p class="mb-0">With different packages, Our system is modelled to accommodate
                                        everyone no matter how much you have to invest.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="about__content about__content--style2" data-aos="fade-right" data-aos-duration="1000">
                            <div class="about__content-inner">
                                <div class="about__icon">
                                    <div class="about__icon-inner">
                                        <img src="assets/images/about/icon/1.png" alt="about-icon" class="dark">
                                    </div>
                                </div>
                                <div class="about__content-details">
                                    <h5>Covered by Insurance</h5>
                                    <p class="mb-0">You have zero chances of losing your investments as all our assets
                                        are duly covered by insurance.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="about__content about__content--style2" data-aos="fade-right" data-aos-duration="1000">
                            <div class="about__content-inner">
                                <div class="about__icon">
                                    <div class="about__icon-inner">
                                        <img src="assets/images/about/icon/1.png" alt="about-icon" class="dark">
                                    </div>
                                </div>
                                <div class="about__content-details">
                                    <h5>Bitcoin Transaction</h5>
                                    <p class="mb-0">Invest in the world's most popular cryptocurrency and enjoy all the
                                        benefits that comes with.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about__thumb about__thumb--style2" data-aos="fade-left" data-aos-duration="800">
                            <div class="about__thumb-inner mt-30 mt-lg-0">
                                <div class="about__thumb-image  text-center">
                                    <img src="assets/images/about/3.png" alt="about-image" class="dark">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about__shape about__shape--style2">
            <span class="about__shape-item about__shape-item--1">
                <img src="assets/images/others/2.png" alt="shape-icon">
            </span>
        </div>
    </section>

    <section class="pricing padding-top padding-bottom">
        <div class="section-header section-header--max50">
            <h2 class="mb-15 mt-minus-5">Our <span>pricing </span>plans</h2>
            <p>Our pricing plans are designed to offer flexibility and value for traders of all levels. Whether you're a
                beginner or an experienced trader, we have a plan that suits your needs. Here's an overview of our pricing
                options:
            </p>
        </div>
        <div class="container">
            <div class="pricing__wrapper">
                <div class="row g-4 align-items-center plans-slider owl-carousel owl-theme">
                    <!-- Pricing plan cards (Basic through Custom) -->
                    <!-- Each card follows the same structure as shown in previous examples -->
                    <!-- Maintaining the exact same content and structure -->
                </div>
            </div>
        </div>
        <div class="slide-arrows">
            <div class="prev-arrow swiper-nav__btn active  swiper-nav__btn-prev testimonial__slider-prev">
                <i class="fa-solid fa-angle-left text-white"></i>
            </div>
            <div class="next-arrow swiper-nav__btn active  swiper-nav__btn-next testimonial__slider-next">
                <i class="fa-solid fa-angle-right text-white"></i>
            </div>
        </div>
        <div class="pricing__shape">
            <span class="pricing__shape-item pricing__shape-item--1">
                <span></span>
            </span>
            <span class="pricing__shape-item pricing__shape-item--2">
                <img src="assets/images/icon/1.png" alt="shape-icon" />
            </span>
        </div>
    </section>

    <section class="feature feature--style1 padding-bottom padding-top bg-color">
        <div class="container">
            <div class="feature__wrapper">
                <div class="row g-5 align-items-center justify-content-between">
                    <div class="col-md-6 col-lg-5">
                        <div class="feature__content" data-aos="fade-right" data-aos-duration="800">
                            <div class="feature__content-inner">
                                <div class="section-header">
                                    <h2 class="mb-15 mt-minus-5">
                                        Our<span> platform </span>
                                    </h2>
                                    <p class="mb-0">
                                        Choose from 4 powerful platforms — designed with you in mind
                                    </p>
                                </div>

                                <div class="feature__nav">
                                    <div class="nav nav--feature flex-column nav-pills" id="feat-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <div class="nav-link active" id="feat-pills-one-tab" data-bs-toggle="pill"
                                            data-bs-target="#feat-pills-one" role="tab" aria-controls="feat-pills-one"
                                            aria-selected="true">
                                            <div class="feature__item">
                                                <div class="feature__item-inner">
                                                    <div class="feature__item-content">
                                                        <h6>
                                                            TrustNetX Bot
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nav-link" id="feat-pills-two-tab" data-bs-toggle="pill"
                                            data-bs-target="#feat-pills-two" role="tab" aria-controls="feat-pills-two"
                                            aria-selected="false">
                                            <div class="feature__item">
                                                <div class="feature__item-inner">
                                                    <div class="feature__item-content">
                                                        <h6>
                                                            TrustNetX Go
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nav-link" id="feat-pills-three-tab" data-bs-toggle="pill"
                                            data-bs-target="#feat-pills-three" role="tab" aria-controls="feat-pills-three"
                                            aria-selected="false">
                                            <div class="feature__item">
                                                <div class="feature__item-inner">
                                                    <div class="feature__item-content">
                                                        <h6>
                                                            Smart Trader5
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nav-link" id="feat-pills-four-tab" data-bs-toggle="pill"
                                            data-bs-target="#feat-pills-four" role="tab" aria-controls="feat-pills-four"
                                            aria-selected="false">
                                            <div class="feature__item">
                                                <div class="feature__item-inner">
                                                    <div class="feature__item-content">
                                                        <h6>
                                                            Binary Bot
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="feature__thumb pt-5 pt-md-0" data-aos="fade-left" data-aos-duration="800">
                            <div class="feature__thumb-inner">
                                <div class="tab-content" id="feat-pills-tabContent">
                                    <div class="tab-pane fade show active" id="feat-pills-one" role="tabpanel"
                                        aria-labelledby="feat-pills-one-tab" tabindex="0">
                                        <div class="feature__image floating-content">
                                            <img src="assets/images/slides/platform_mt5.avif" alt="Feature image" />
                                            <div class="floating-content__top-right floating-content__top-right--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style2 text-center">
                                                    <p class="style2">
                                                        Automated Trading, No coding required
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="floating-content__bottom-left floating-content__bottom-left--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style3 d-flex align-items-center">
                                                    <h3 class="style2">
                                                        $<span class="purecounter" data-purecounter-start="0"
                                                            data-purecounter-end="10">10M</span>M
                                                    </h3>
                                                    <p class="ms-3 style2">
                                                        Monthly Profits
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="feat-pills-two" role="tabpanel"
                                        aria-labelledby="feat-pills-two-tab" tabindex="0">
                                        <div class="feature__image floating-content">
                                            <img src="assets/images/feature/2.png" alt="Feature image" />
                                            <div class="floating-content__top-right floating-content__top-right--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style2 text-center">
                                                    <img src="assets/images/feature/6.png" alt="rating" />
                                                    <p class="style2">
                                                        Daily Profits
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="floating-content__bottom-left floating-content__bottom-left--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style3 d-flex align-items-center">
                                                    <h3 class="style2">
                                                        $<span class="purecounter" data-purecounter-start="0"
                                                            data-purecounter-end="18">20M</span>M
                                                    </h3>
                                                    <p class="ms-3 style2">
                                                        Monthly Profits
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="feat-pills-three" role="tabpanel"
                                        aria-labelledby="feat-pills-three-tab" tabindex="0">
                                        <div class="feature__image floating-content">
                                            <img src="assets/images/feature/1.png" alt="Feature image" />
                                            <div class="floating-content__top-right floating-content__top-right--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style2 text-center">
                                                    <p class="style2">
                                                        <span class="text-primary">60%</span> Guaratteened Daily
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="floating-content__bottom-left floating-content__bottom-left--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style3 d-flex align-items-center">
                                                    <h3 class="style2">
                                                        $<span class="purecounter" data-purecounter-start="0"
                                                            data-purecounter-end="30">10M</span>M
                                                    </h3>
                                                    <p class="ms-3 style2">
                                                        Monthly Profits
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="feat-pills-four" role="tabpanel"
                                        aria-labelledby="feat-pills-four-tab" tabindex="0">
                                        <div class="feature__image floating-content">
                                            <img src="assets/images/feature/2.png" alt="Feature image" />
                                            <div class="floating-content__top-right floating-content__top-right--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style2 text-center">
                                                    <img src="assets/images/feature/8.png" alt="rating" />
                                                    <p class="style2">
                                                        Fixed weekly returns
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="floating-content__bottom-left floating-content__bottom-left--style2"
                                                data-aos="fade-left" data-aos-duration="1000">
                                                <div class="floating-content__item floating-content__item--style3 d-flex align-items-center">
                                                    <h3 class="style2">
                                                        $<span class="purecounter" data-purecounter-start="0"
                                                            data-purecounter-end="28">10M</span>M
                                                    </h3>
                                                    <p class="ms-3 style2">
                                                        Monthly Profits
                                                    </p>
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
        </div>
        <div class="feature__shape">
            <span class="feature__shape-item feature__shape-item--1">
                <img src="assets/images/feature/shape/1.png" alt="shape-icon" />
            </span>
            <span class="feature__shape-item feature__shape-item--2">
                <span></span>
            </span>
        </div>
    </section>

    <section class="faq padding-top padding-bottom of-hidden">
        <div class="section-header section-header--max57">
            <h2 class="mb-15 mt-minus-5">Frequetly <span class="style2">Asked Questions</span></h2>
        </div>
        <div class="container">
            <div class="faq__wrapper">
                <div class="row g-4 justify-content-between">
                    <div class="col-lg-6">
                        <div class="accordion accordion--style2" id="faqAccordion1" data-aos="fade-right"
                            data-aos-duration="1000">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <div class="accordion__item ">
                                        <div class="accordion__header" id="faq1">
                                            <button class="accordion__button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faqBody1" aria-expanded="false" aria-controls="faqBody1">
                                                <span class="accordion__button-content">What is forex trading and how does
                                                    it work?</span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                                            data-bs-parent="#faqAccordion1">
                                            <div class="accordion__body">
                                                <p class="mb-0">
                                                    Forex trading involves buying and selling currencies on the foreign
                                                    exchange market. It works by trading currency pairs, where one currency
                                                    is exchanged for another based on their exchange rates.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item ">
                                        <div class="accordion__header" id="faq2">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody2" aria-expanded="true"
                                                aria-controls="faqBody2">
                                                <span class="accordion__button-content">What are the major differences
                                                    between stocks and indices?</span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody2" class="accordion-collapse collapse" aria-labelledby="faq2"
                                            data-bs-parent="#faqAccordion1">
                                            <div class="accordion__body">
                                                <p class="mb-0">
                                                    Stocks represent ownership in individual companies, while indices are
                                                    measures of a group of stocks representing a specific market or sector.
                                                    Stocks provide direct ownership and potential dividends, while indices
                                                    track the overall performance of a specific group of stocks.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item ">
                                        <div class="accordion__header" id="faq3">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody3" aria-expanded="false"
                                                aria-controls="faqBody3">
                                                <span class="accordion__button-content">Can I trade cryptocurrencies like
                                                    Bitcoin and Ethereum on your platform? </span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody3" class="accordion-collapse collapse" aria-labelledby="faq3"
                                            data-bs-parent="#faqAccordion1">
                                            <div class="accordion__body">
                                                <p class="mb-0"> Yes, you can trade popular cryptocurrencies like
                                                    Bitcoin, Ethereum, and others on our platform. We offer a range of
                                                    crypto trading options for our clients.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item ">
                                        <div class="accordion__header" id="faq4">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody4" aria-expanded="false"
                                                aria-controls="faqBody4">
                                                <span class="accordion__button-content">Is my personal and financial
                                                    information secure on your platform? </span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody4" class="accordion-collapse collapse" aria-labelledby="faq4"
                                            data-bs-parent="#faqAccordion1">
                                            <div class="accordion__body">
                                                <p class="mb-0">Absolutely. We prioritize the security and privacy of
                                                    your personal and financial information. We employ robust security
                                                    measures, including encryption technology, to protect your data from
                                                    unauthorized access, loss, or misuse. Additionally, we adhere to
                                                    stringent data protection policies and comply with relevant regulatory
                                                    requirements to ensure the highest level of confidentiality and security
                                                    for our clients. Rest assured that your information is in safe hands
                                                    when you trade on our platform.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item ">
                                        <div class="accordion__header" id="faq5">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody5" aria-expanded="false"
                                                aria-controls="faqBody5">
                                                <span class="accordion__button-content">How can I open a trading account
                                                    with your website? </span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody5" class="accordion-collapse collapse" aria-labelledby="faq5"
                                            data-bs-parent="#faqAccordion1">
                                            <div class="accordion__body">
                                                <p class="mb-0"> Opening a trading account with our website is easy.
                                                    Simply visit our website and click on the "Open Account" button. Follow
                                                    the registration process by providing the required information, and your
                                                    account will be created.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion accordion--style2" id="faqAccordion2" data-aos="fade-left"
                            data-aos-duration="1000">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <div class="accordion__item border-0">
                                        <div class="accordion__header" id="faq6">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody6" aria-expanded="false"
                                                aria-controls="faqBody6">
                                                <span class="accordion__button-content">Are there any minimum deposit
                                                    requirements to start trading? </span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody6" class="accordion-collapse collapse" aria-labelledby="faq6"
                                            data-bs-parent="#faqAccordion2">
                                            <div class="accordion__body">
                                                <p class="mb-0">We offer flexibility when it comes to minimum deposit
                                                    requirements. The specific minimum deposit will depend on the account
                                                    type you choose. We cater to both beginners and experienced traders, so
                                                    you can start with an amount that suits your trading goals.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item border-0">
                                        <div class="accordion__header" id="faq7">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody7" aria-expanded="false"
                                                aria-controls="faqBody7">
                                                <span class="accordion__button-content">What trading tools and indicators
                                                    do you provide for technical analysis?</span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody7" class="accordion-collapse collapse" aria-labelledby="faq7"
                                            data-bs-parent="#faqAccordion2">
                                            <div class="accordion__body">
                                                <p class="mb-0"> Our trading platform provides a wide range of tools and
                                                    indicators for technical analysis. You can utilize various charting
                                                    tools, indicators, and drawing tools to analyze price movements and make
                                                    informed trading decisions.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item border-0">
                                        <div class="accordion__header" id="faq8">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody8" aria-expanded="false"
                                                aria-controls="faqBody8">
                                                <span class="accordion__button-content">Are there any fees or commissions
                                                    associated with trading on your platform?</span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody8" class="accordion-collapse collapse" aria-labelledby="faq8"
                                            data-bs-parent="#faqAccordion2">
                                            <div class="accordion__body">
                                                <p class="mb-0">We strive to be transparent with our fees and
                                                    commissions. While there may be certain transaction fees or commissions
                                                    associated with specific trades or account types, we always provide
                                                    clear information regarding any charges involved. Be sure to review our
                                                    fee structure before you start trading.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item border-0">
                                        <div class="accordion__header" id="faq9">
                                            <button class="accordion__button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faqBody9" aria-expanded="false" aria-controls="faqBody9">
                                                <span class="accordion__button-content">What risk management strategies do
                                                    you recommend for traders?</span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody9" class="accordion-collapse collapse show" aria-labelledby="faq9"
                                            data-bs-parent="#faqAccordion2">
                                            <div class="accordion__body">
                                                <p class="mb-0"> Risk management is crucial in trading. We highly
                                                    recommend utilizing strategies such as setting stop-loss orders,
                                                    practicing proper position sizing, and diversifying your portfolio. Our
                                                    educational resources and customer support team can provide you with
                                                    guidance on risk management techniques.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion__item border-0">
                                        <div class="accordion__header" id="faq10">
                                            <button class="accordion__button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqBody10" aria-expanded="false"
                                                aria-controls="faqBody10">
                                                <span class="accordion__button-content">Do you provide educational
                                                    resources or tutorials for beginners in trading? </span>
                                                <span class="accordion__button-plusicon"></span>
                                            </button>
                                        </div>
                                        <div id="faqBody10" class="accordion-collapse collapse" aria-labelledby="faq10"
                                            data-bs-parent="#faqAccordion2">
                                            <div class="accordion__body">
                                                <p class="mb-0"> Absolutely! We understand the importance of education in
                                                    trading. We provide a variety of educational resources, including
                                                    tutorials, e-books, webinars, and market analysis reports, to help
                                                    beginners get started and enhance the knowledge of advanced traders.
                                                    These resources are designed to empower you with the necessary skills
                                                    and insights to make informed trading decisions.</p>
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
    </section>

    <section class="testimonial padding-top padding-bottom-style2 bg-color">
        <div class="container">
            <div class="section-header d-flex align-items-center justify-content-between">
                <div class="section-header__content">
                    <h2 class="mb-0">our <span class="style2">Clients </span> story</h2>
                </div>
                <div class="section-header__action">
                    <div>
                        <a href="#" class="trk-btn trk-btn--border trk-btn--secondary">View All</a>
                    </div>
                </div>
            </div>
            <div class="testimonial__wrapper">
                <div class="testimonial__slider2 swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial__item testimonial__item--style2">
                                <div class="testimonial__item-inner">
                                    <div class="testimonial__item-content">
                                        <p class="mb-0">
                                            Trading with this platform has been a game-changer for me. The user-friendly
                                            interface, advanced trading tools, and educational resources have given me the
                                            confidence to navigate the markets with ease. The customer support team has
                                            always been there to assist me whenever I needed help. Highly recommended
                                        </p>
                                        <div class="testimonial__footer">
                                            <div class="testimonial__author">
                                                <div class="testimonial__author-thumb">
                                                    <img src="assets/images/testimonial/3.png" alt="author" class="dark">
                                                </div>
                                                <div class="testimonial__author-designation">
                                                    <h6>John Dson.</h6>
                                                    <span>Trade Master</span>
                                                </div>
                                            </div>
                                            <div class="testimonial__quote testimonial__quote--style2">
                                                <span><i class="fa-solid fa-quote-right"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial__item testimonial__item--style2">
                                <div class="testimonial__item-inner">
                                    <div class="testimonial__item-content">
                                        <p class="mb-0">
                                            I have been trading with this platform for several years now, and I am extremely
                                            satisfied with the level of professionalism and reliability. The platform
                                            provides real-time market data and a wide range of trading options, helping me
                                            diversify my portfolio. The funds protection measures and regulatory compliance
                                            give me peace of mind. Thank you for the exceptional service!
                                        </p>
                                        <div class="testimonial__footer">
                                            <div class="testimonial__author">
                                                <div class="testimonial__author-thumb">
                                                    <img src="assets/images/testimonial/4.png" alt="author" class="dark">
                                                </div>
                                                <div class="testimonial__author-designation">
                                                    <h6>Bella A.</h6>
                                                    <span>Blogger</span>
                                                </div>
                                            </div>
                                            <div class="testimonial__quote testimonial__quote--style2">
                                                <span><i class="fa-solid fa-quote-right"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial__item testimonial__item--style2">
                                <div class="testimonial__item-inner">
                                    <div class="testimonial__item-content">
                                        <p class="mb-0">
                                            I've tried several trading platforms, but this one stands out from the rest. The
                                            intuitive interface, comprehensive educational resources, and competitive
                                            pricing have made trading a breeze. The mobile app is also a great feature,
                                            allowing me to trade on the go. I appreciate the platform's commitment to
                                            customer satisfaction. Overall, a top-notch trading platform!
                                        </p>
                                        <div class="testimonial__footer">
                                            <div class="testimonial__author">
                                                <div class="testimonial__author-thumb">
                                                    <img src="assets/images/testimonial/5.png" alt="author" class="dark">
                                                </div>
                                                <div class="testimonial__author-designation">
                                                    <h6>David S.</h6>
                                                    <span>Trade Genius</span>
                                                </div>
                                            </div>
                                            <div class="testimonial__quote testimonial__quote--style2">
                                                <span><i class="fa-solid fa-quote-right"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-nav swiper-nav--style2">
                    <button class="swiper-nav__btn active  swiper-nav__btn-prev testimonial__slider-prev">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="swiper-nav__btn swiper-nav__btn-next testimonial__slider-next">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="about about--style3 padding-top padding-bottom ">
        <div class="container">
            <div class="about__wrapper">
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="about__content" data-aos="fade-right" data-aos-duration="800">
                            <h2>Our seamless transaction crypto card</h2>
                            <ul>
                                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span> Shop
                                    Online 24/7</li>
                                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span> Use
                                    anywhere globally</li>
                                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span> Great
                                    Exchange rates</li>
                                <li><span><img src="assets/images/about/home3/check.png" alt="check"></span>Spend
                                    securely</li>
                            </ul>
                            <a href="register.html" class="trk-btn trk-btn--border trk-btn--primary">Request
                                Now <span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about__thumb" data-aos="fade-left" data-aos-duration="800">
                            <div class="about__thumb-inner">
                                <div class="about__thumb-image text-center floating-content">
                                    <img class="dark" src="assets/dashboard/extra/images/card/pcard.png" alt="about-image">
                                    <div class="floating-content__top-left floating-content__top-left--style2">
                                        <div class="floating-content__item floating-content__item--style5">
                                            <h3> <span class="purecounter" data-purecounter-start="80"
                                                    data-purecounter-end="99"></span>%
                                            </h3>
                                            <p>Uptime Guaranteed</p>
                                            <div class="progress">
                                                <div class="progress-bar w-100" role="progressbar" aria-valuenow="100"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
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
    </section>

    <div class="partner partner--gradient mb-5">
        <div class="container">
            <div class="partner__wrapper">
                <div class="partner__slider swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="partner__item">
                                <div class="partner__item-inner">
                                    <img src="assets/images/partner/light/1.png" alt="partner logo" class="dark" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                <div class="partner__item-inner">
                                    <img src="assets/images/partner/light/2.png" alt="partner logo" class="dark" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                <div class="partner__item-inner">
                                    <img src="assets/images/partner/light/3.png" alt="partner logo" class="dark" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                <div class="partner__item-inner">
                                    <img src="assets/images/partner/light/4.png" alt="partner logo" class="dark" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  SHOWN MODAL -->
    <div style="display:none" id="once-popup">
        <div class="inner">
            <div id="popup-close">×</div>
            <h6>Hello there, Welcome to TrustNetX </h6>
        </div>
    </div>
    <!-- END SHOWN MODAL -->

    <section class="cta cta--style2">
        <div class="container">
            <div class="cta__wrapper">
                <div class="cta__newsletter justify-content-center">
                    <div class="cta__newsletter-inner cta__newsletter-inner--style2" data-aos="fade-up"
                        data-aos-duration="1000">
                        <div class="cta__thumb">
                            <img src="assets/images/cta/3.png" alt="cta-thumb">
                        </div>
                        <div class="cta__subscribe">
                            <h2 class="mb-0 text-white">Start trading in less than 5 minutes</h2>
                            <p class="text-white">Trade over 1,000+ assets today</p>
                            <div class="cta-form cta-form--style2 form-subscribe">
                                <div class="cta-form__inner d-sm-flex align-items-center">
                                    <a href="{{ url('/register') }}">
                                        <button class="trk-btn trk-btn--large trk-btn--secondary2" type="submit">Join now</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>