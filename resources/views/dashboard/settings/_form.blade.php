@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    if (!isset($setting)) {
        $setting = null;
    }
@endphp
<div class="modal-body">
    <x-alert type="success" />
    <div class="container text-start">
        <div class="row mb-0 mb-md-3">
            <div class="mt-md-0 mt-3 col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Site Name"
                        value="{{ old('name', $setting ? $setting->name : '') }}" required="">
                </div>

            </div>
            <div class="mt-md-0 mt-3 col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Currency</label>
                    <input type="text" class="form-control" name="currency" placeholder="Currency"
                        value="{{ old('currency', $setting ? $setting->currency : '') }}" required="">
                </div>

            </div>
        </div>
        <div class="row mb-0 mb-md-3">
            <div class="mt-md-0 mt-3 col-md-4">
                <div class="form-group">
                    <label for="name" class="form-label">WhatsApp</label>
                    <input type="text" class="form-control" name="phone" placeholder="WhatsApp"
                        value="{{ old('phone', $setting ? $setting->phone : '') }}" required="">
                </div>

            </div>
            <div class="mt-md-0 mt-3 col-md-4">
                <div class="form-group">
                    <label for="name" class="form-label">Mail</label>
                    <input type="gmail" class="form-control" name="email" placeholder="Mail"
                        value="{{ old('email', $setting ? $setting->email : '') }}">
                </div>

            </div>
            <div class="mt-md-0 mt-3 col-md-4">
                <div class="form-group">
                    <label for="name" class="form-label">Tax number</label>
                    <input type="text" class="form-control" name="tax_number" placeholder="Tax number"
                        value="{{ old('tax_number', $setting ? $setting->tax_number : '') }}">
                </div>

            </div>
        </div>
        <div class="row mb-0 mb-md-3">
            <div class="mt-md-0 mt-3 col-md-4">
                <div class="form-group">
                    <label for="name" class="form-label">Site Logo</label>
                    <input type="file" class="form-control" name="website_logo" accept="image/*">
                    @if ($setting && $setting->website_logo)
                        <img src="{{ asset('storage/' . $setting->website_logo) }}" class="img-fit m-2 border p-2"
                            alt="website_logo" style="max-height: 110px; max-width: 150px;">
                    @endif
                </div>
            </div>
            <div class="mt-md-0 mt-3 col-md-4">
                <div class="form-group">
                    <label for="name" class="form-label">Outro logo</label>
                    <input type="file" class="form-control" name="epilogue_logo" accept="image/*">
                    @if ($setting && $setting->epilogue_logo)
                        <img src="{{ asset('storage/' . $setting->epilogue_logo) }}" class="img-fit m-2 border p-2"
                            alt="epilogue_logo" style="max-height: 110px; max-width: 150px;">
                    @endif
                </div>
            </div>
            <div class="mt-md-0 mt-3 col-md-4">
                <div class="form-group">
                    <input type="hidden" name="id" value="6" id="">
                    <label for="name" class="form-label">tab logo</label>
                    <input type="file" class="form-control" name="tab_logo" accept="image/*">
                    @if ($setting && $setting->tab_logo)
                        <img src="{{ asset('storage/' . $setting->tab_logo) }}" class="img-fit m-2 border p-2"
                            alt="tab_logo" style="max-height: 110px; max-width: 150px;">
                    @endif
                </div>
            </div>
        </div>

        <div class="row mb-0 mb-md-3">
            <div class="mt-md-0 mt-3 col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">QR Code</label>
                    <input type="file" class="form-control" name="qr_code" accept="image/*">
                    @if ($setting && $setting->qr_code)
                        <img src="{{ asset('storage/' . $setting->qr_code) }}" class="img-fit m-2 border p-2"
                            alt="qr_code" style="max-height: 110px; max-width: 150px;">
                    @endif
                </div>
            </div>
            <div class="mt-md-0 mt-3 col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Icon</label>
                    <input type="file" class="form-control" name="invoice_stamp" accept="image/*">
                    @if ($setting && $setting->invoice_stamp)
                        <img src="{{ asset('storage/' . $setting->invoice_stamp) }}" class="img-fit m-2 border p-2"
                            alt="invoice_stamp" style="max-height: 110px; max-width: 150px;">
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
