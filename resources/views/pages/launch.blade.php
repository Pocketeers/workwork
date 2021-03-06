@extends('layout')

@section('content')
    <header>
        <div class="brand-ww">
            <div class="title text-xs-center"><img src="/images/logo.png" alt="" width="187"/></div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="content">
            <div class="row catchers">
                <div id="catch-part-timers"class="col-md-6">
                    <div class="catch-box">
                        <div class="catch-icon text-xs-center m-b-3 m-t-2">
                            <img src="/images/icon-salary-man.png" alt="Part-timer icon" height="48"/>
                        </div>
                        <h2 class="question m-b-2">Anda mencari kerja <u>part-time</u>?</h2>
                        <p class="text-xs-center m-b-2">
                            Ingin dimaklumkan tentang kekosongan kerja sampingan? Kalau ya, sila letakkan email dan nama anda.
                        </p>
                        
                        <div class="embed-responsive">
                            <iframe class="embed-responsive-item" src="pages/form-mailchimp-job-seekers.html">
                              <p>Your browser does not support iframes.</p>
                            </iframe>
                        </div>
                    </div>
                    <div class="atau hidden-md-up">
                        <img src="/images/atau.png" alt="" width="39"/>
                    </div>
                </div>

                <div class="atau hidden-sm-down">
                    <img src="/images/atau.png" alt="" width="39"/>
                </div>

                <div id="catch-employers" class="col-md-6">
                    <div class="catch-box">
                        <div class="catch-icon text-xs-center m-b-3 m-t-2">
                            <img src="/images/icon-sir.png" alt="Employer icon" height="48"/>
                        </div>
                        <h2 class="question m-b-2">Anda mencari <u>pekerja</u> part-time?</h2>
                        <p class="text-xs-center m-b-2">
                            Jika anda sedang mencari pekerja part-time untuk syarikat, kedai atau organisasi anda, sila masukkan email dan nama anda.
                        </p>
                        
                        <div class="embed-responsive">
                            <iframe class="embed-responsive-item" src="pages/form-mailchimp-employer.html" width="432" height="320" frameborder="0">
                              <p>Your browser does not support iframes.</p>
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-xs-center m-t-3 m-b-3">
                    <h3 class="question m-b-2 m-t-2">Workwork... apa tu?</h3>
                    <h4 class="features">IKLAN PART-TIME</h4>
                    <p class="m-b-2">
                    Platform khas untuk membantu pencarian atau pengiklanan kerja secara part-time.
                    </p>
                    <h4 class="features">CARI KERJA PART-TIME</h4>
                    <p class="m-b-2">
                    Kami invite semua pelajar, para pesara atau sesiapa sahaja untuk mencuba workwork.
                    </p>
                    <h4 class="features">REZEKI BUAT PART-TIME</h4>
                    <p class="m-b-2">
                    Kami di workwork mendoakan semua boleh mencari kerja part-time yang bagus dan bermakna melalui workwork.
                    </p>
                    <p>
                        <small>#KerjaKerasSetiapHari</small>
                    </p>

                    <p class="m-b-3">
                        <img src="/images/icon-city.png" alt="work hard icon" width="69" />
                    </p>
                    <p>
                        <img src="/images/logo-symbol.png" alt="workwork logo" width="88" />
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop
