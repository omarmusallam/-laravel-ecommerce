<x-front-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    @endpush

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Edit Profile</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <div class="container">
        <x-alert type="success" />

        <form action="{{ route('user-profile.update') }}" method="post" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('patch')

            <div class="form-row">
                <div class="col-md-6">
                    <x-form.input name="first_name" label="First Name" :value="$user->userprofile->first_name ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-form.input name="last_name" label="Last Name" :value="$user->userprofile->last_name ?? ''" />
                </div>
            </div>
            <div class="form-row mt-4">
                <div class="col-md-6">
                    <x-form.input name="birthday" type="date" label="Birthday" :value="$user->userprofile->birthday ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-form.radio name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->userprofile->gender ?? ''" />
                </div>
            </div>
            <div class="form-row mt-4">
                <div class="col-md-4">
                    <x-form.input name="street_address" label="Street Address" :value="$user->userprofile->street_address ?? ''" />
                </div>
                <div class="col-md-4">
                    <x-form.input name="city" label="City" :value="$user->userprofile->city ?? ''" />
                </div>
                <div class="col-md-4">
                    <x-form.input name="state" label="State" :value="$user->userprofile->state ?? ''" />
                </div>
            </div>
            <div class="form-row mt-4">
                <div class="col-md-4">
                    <x-form.input name="postal_code" label="Postal Code" :value="$user->userprofile->postal_code ?? ''" />
                </div>
                <div class="col-md-4">
                    <x-form.select name="country" :options="$countries" label="Country" :selected="$user->userprofile->country ?? ''" />
                </div>
                <div class="col-md-4">
                    <x-form.select name="locale" :options="$locales" label="Locale" :selected="$user->userprofile->locale ?? ''" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary col-md-1 mt-4 mb-4">Save</button>
        </form>
    </div>
</x-front-layout>
