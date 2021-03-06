@extends('adminlte::page')

@section('title')
    Analytics
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-info">Export Data</h2>
            <export-data></export-data>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en livraison : Le matin par jour ce mois.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/date/Delivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en livraison : Le midi par jour ce mois.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/Delivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en livraison : le soir par jour ce mois.</h2>
            <analytics label="Nombre de repas Soir" type="Dinner/date/Delivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en livraison : Le matin par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/lastYear/Delivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en livraison : Le midi par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/Delivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en livraison : le soir par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/Delivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le matin par jour ce mois.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/date/Pick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour ce mois.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/Pick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour ce mois.</h2>
            <analytics label="Nombre de repas Soir" type="Dinner/date/Pick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le matin par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/lastYear/Pick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/Pick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour ce mois, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/Pick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Livraison : Le matin par jour cette annee.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/date/allDelivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Livraison : Le midi par jour cette annee.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/allDelivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Livraison : le soir par jour, cette annee.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/date/allDelivery" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Livraison : Le matin par jour l'annee derniere.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/lastYear/allDelivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Livraison : Le midi par jour l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/allDelivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Livraison : le soir par jour, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/allDelivery" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le matin par jour cette annee.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/date/allPick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour cette annee.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/date/allPick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour, cette annee.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/date/allPick-up" color="rgba(80, 255, 13, 0.32)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le matin par jour l'annee derniere.</h2>
                <analytics label="Nombre de repas Matin" type="Breakfast/lastYear/allPick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : Le midi par jour l'annee derniere.</h2>
                <analytics label="Nombre de repas Midi" type="Lunch/lastYear/allPick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
            <div class="col-md-4">
                <h2 class="text-center text-info">Nombre de repas en Pick-up : le soir par jour, l'annee derniere.</h2>
                <analytics label="Nombre de repas Soir" type="Dinner/lastYear/allPick-up" color="rgba(250, 120, 0, 0.3)"></analytics>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8 col-md-offset-2 ">
                <h2 class="text-center text-info">Total repas par an.</h2>
                <analytics label="Nombre de repas" type="Lunch/date/all" color="rgba(80, 255, 132, 0.5)"></analytics>
            </div>
        </div>
    </div>
@endsection
