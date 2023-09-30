<style>
    /* تخصيص الألوان */
    .custom-legend {
        background-color: #3e4853;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .custom-legend legend {
        color: #fff;
        font-weight: bold;
    }

    .custom-radio-label {
        font-weight: bold;
    }

    /* تخصيص الخطوط */
    .custom-input-label {
        font-family: "Arial", sans-serif;
        font-size: 18px;
    }

    /* تخصيص زر الحفظ */
    .custom-save-button {
        font-size: 20px;
        padding: 10px 30px;
        margin-top: 20px;
    }
</style>

<div class="container mt-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <h3>Error Occurred!</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="role-name" class="form-label custom-input-label">Role Name</label>
                <input type="text" class="form-control form-control-lg" id="role-name" name="name"
                    value="{{ $role->name }}">
            </div>
        </div>
    </div>

    <fieldset class="border p-4">
        <legend class="w-auto custom-legend">{{ __('Abilities') }}</legend>

        @foreach (app('abilities') as $ability_code => $ability_name)
            <div class="row mb-3">
                <div class="col-md-6">
                    {{ is_callable($ability_name) ? $ability_name() : $ability_name }}
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="abilities[{{ $ability_code }}]"
                            id="allow-{{ $ability_code }}" value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                        <label class="form-check-label custom-radio-label" for="allow-{{ $ability_code }}">Allow</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="abilities[{{ $ability_code }}]"
                            id="deny-{{ $ability_code }}" value="deny" @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                        <label class="form-check-label custom-radio-label" for="deny-{{ $ability_code }}">Deny</label>
                    </div>
                </div>
            </div>
        @endforeach
    </fieldset>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-group mt-3 text-center">
                <button type="submit" class="btn btn-primary custom-save-button">{{ $button_label ?? 'Save' }}</button>
            </div>
        </div>
    </div>
</div>
