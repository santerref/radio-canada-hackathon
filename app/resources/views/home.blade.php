@extends('layouts.app')

@section('content')
<div>
    <section class="search">
        <div class="container">
            <div class="col-md-12">
                <!--  col-md-12 col-md-offset-2 -->
                <search></search>
            </div>
        </div>
    </section>
    <section class="tags">
        <div class="container">
            <div class="col-md-12">
                <!-- Single button -->
                <div class="btn-group">
                <p>Raffiner la recherche</p>
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
                        <li><a href="#">Abitibi-Témiscamingue</a></li>
                        <li><a href="#">Alberta</a></li>
                        <li><a href="#">Bas-St-Laurent</a></li>
                        <li><a href="#">Colombie-Britannique-Yukon</a></li>
                        <li><a href="#">Côte-Nord</a></li>
                        <li><a href="#">Estrie</a></li>
                        <li><a href="#">Gaspésie-Îles-de-la-Madeleine</a></li>
                        <li><a href="#">Gatineau</a></li>
                        <li><a href="#">Grand-Montréal</a></li>
                        <li><a href="#">Île-du-Prince-Édouard</a></li>
                        <li><a href="#">Manitoba</a></li>
                        <li><a href="#">Mauricie-Centre-du-Québec</a></li>
                        <li><a href="#">Nord de l'Ontario</a></li>
                        <li><a href="#">Nouveau-Brunswick</a></li>
                        <li><a href="#">Nouvelle-Écosse</a></li>
                        <li><a href="#">Ottawa</a></li>
                        <li><a href="#">Québec</a></li>
                        <li><a href="#">Saguenay-Lac-Saint-Jean</a></li>
                        <li><a href="#">Saskatchewan</a></li>
                        <li><a href="#">Terre-Neuve-Labrador</a></li>
                        <li><a href="#">Toronto</a></li>
                        <li><a href="#">Windsor</a></li>
                    </ul>
                </div>

                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Toutes les émissions <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider">A</li>
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li role="separator" class="divider">B</li>
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
            <div class="col-md-12">
                <div class="heading">
                    <span class="lead">5 résultats</span>
                    <div class="pull-right sort">
                        <a href="#bestMatch">Trier par pertinence</a> | <a href="#sortDate">Trier par date</a>
                    </div>
                </div>
                <div class="result-list">
                    <div class="result-item" itemscope itemtype="http://schema.org/RadioClip">
                        <div class="infos col-md-8">
                            <h3>Un language révolutionnaire pour communiquer avec les autistes</h3>
                            <p class="meta datetime">Diffusion: 21 mars 2017, 13h06</p>
                            <p class="meta ">Gravel le matin</p>
                            <button class="btn btn-primary btn-rounded"><i class="fa fa-play"></i> | 10:00</button>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                    </div>
                        <div class="col-md-4">
                            <img class="" src="http://placehold.it/250/E98300">
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
