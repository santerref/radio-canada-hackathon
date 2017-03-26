@extends('layouts.app')

@section('content')
<div>
    <section class="search">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <search></search>
            </div>
        </div>
    </section>
    <section class="tags">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Toutes les dates <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Toutes les régions <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Toute les émissions <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="results">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="heading">
                    <span class="lead">5 résultats</span>
                    <div class="pull-right">
                        Trier par pertinence | Trier par date
                    </div>
                </div>
                <div class="result-list">
                    <div class="result-item">
                        <div class="infos">
                            <h3>Un language révolutionnaire pour communiquer avec les autistes</h3>
                            <p>Diffusion: 21 mars 2017, 13h06</p>
                            <p>Gravel le matin</p>
                            <button class="btn btn-primary btn-rounded"><i class="fa fa-play"></i> | 10:00</button>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <img src="http://placehold.it/250/E98300">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
