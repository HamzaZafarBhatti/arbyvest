@extends('user.layout.app')

@section('title', 'Dashboard')

@section('css')
    <style>
        .badge {
            font-size: 1.25rem;
            padding: 0.25rem 1rem;
        }
    </style>
@endsection

@section('content')
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
    </svg>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24">
            <use xlink:href="#info-fill" />
        </svg>
        <div>
            Please note that rates may increase or decrease according to the market prices of Dollar and Pounds.
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title">Market Rates</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">CURRENCY</th>
                        <th scope="col">ARBYVEST RATE</th>
                        <th scope="col">BLACK MARKET RATE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>🇺🇸 United States Dollar</td>
                        <td>₦ 553</td>
                        <td>₦ 719</td>
                    </tr>
                    <tr>
                        <td>🇬🇧 Great Britain Pounds</td>
                        <td>₦ 675</td>
                        <td>₦ 878</td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <h5>LIMIT OF THE WEEK PER INDIVIDUAL</h5>
                <h5 class="badge rounded-pill bg-primary">$ 26,210.00</h5>
            </div>
        </div>
    </div>
@endsection
