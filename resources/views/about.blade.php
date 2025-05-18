@extends('layouts.app')

@section('content')
<style>
    .profile-pic {
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 border-end border-2 text-center">
            <img class="p-3 mb-4" src="{{ asset('img/logo-tp.svg') }}" alt="" width="330" height="160">
            <h1>About Us</h1>
            <p>Contact us for questions, technical assistance, or collaboration opportunities via the contact information provided.</p>
            <p class="mt-5 text-start"><i class='bx bx-phone border rounded-circle bg-primary-custom fs-4 text-light p-2' ></i> +62 859-5957-5989<i class='ms-2 bx bx-phone border rounded-circle bg-primary-custom fs-4 text-light p-2' ></i> +62 882-1068-5227</p>
            <p class="text-start"><i class='bx bx-envelope border rounded-circle bg-primary-custom fs-4 text-light p-2' ></i> fikri.pramudya@binus.ac.id <i class='ms-2 bx bx-envelope border rounded-circle bg-primary-custom fs-4 text-light p-2' ></i> ailsa.sukmono@binus.ac.id</p>
            <p class="text-start"><i class='bx bx-location-plus border rounded-circle bg-primary-custom fs-4 text-light p-2'></i>Kemanggisan, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta</p>
        </div>
        <div class="col-md-6">
            <div class="row mb-5">
                <div class="col">
                    <img src="{{ asset('img/profile-akbar.jpg') }}" alt="Fikri Akbar Pramudya" class="profile-pic">
                    <div class="ms-4 d-inline-block">
                        <h3>Fikri Akbar Pramudya</h3>
                        <p>Developer</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <img src="{{ asset('img/profile-ail.jpg') }}" alt="Alisa Norah Sukmono" class="profile-pic">
                    <div class="ms-4 d-inline-block">
                        <h3>Ailsa Naurah Sukmono</h3>
                        <p>Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
