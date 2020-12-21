@extends('adminlte::page')

@section('title')
    Analytics
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en livraison : Le midi par jour ce mois.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/Delivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en livraison : le soir par jour ce mois.</h2>
            <analytics label="Nombre de repas Soir" type="Dinner/date/Delivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en livraison : Le midi par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/Delivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en livraison : le soir par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/Delivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour ce mois.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/Pick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour ce mois.</h2>
            <analytics label="Nombre de repas Soir" type="Dinner/date/Pick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/Pick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/Pick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Livraison : Le midi par jour cette annee.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/allDelivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Livraison : le soir par jour, cette annee.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/date/allDelivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Livraison : Le midi par jour l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/allDelivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Livraison : le soir par jour, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/allDelivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour cette annee.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/allPick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour, cette annee.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/date/allPick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/allPick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/allPick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8 col-md-offset-2 ">
                <h2 class="text-center text-info">Nombre de repas total cette annee.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/all" color="rgba(80, 255, 132, 0.5)"></analytics>
            </div>
        </div>
    </div>
@endsection
