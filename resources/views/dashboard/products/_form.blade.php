@push('styles')
    <link href="{{ asset('css/tagify.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-container .img-fit {
            /* أي تنسيقات أخرى ترغب في تطبيقها على الصورة */
        }

        .delete-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 18px;
            background-color: white;
            padding: 5px;
            border-radius: 50%;
        }
    </style>
@endpush
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

<div class="form-group">
    <x-form.input label="Product Name" class="form-control-lg" role="input" name="name" :value="$product->name" />
</div>

<div class="form-group">
    <label for="">Store</label>
    <select name="store_id" class="form-control form-select" disabled>
        <option value="">{{ $admin->store->name ? $admin->store->name : '' }}</option>
    </select>
    <input type="hidden" name="store_id" value="{{ $admin->store_id }}">
</div>


<div class="form-group">
    <label for="">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$product->description" />
</div>
<div class="form-group">
    <x-form.label>Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="img" class="img-fit m-1 border p-1"
            height="60">
    @endif
</div>
<div class="form-group">
    <x-form.label>Gallery</x-form.label>
    <x-form.input type="file" name="gallery[]" accept="image/*" multiple />
    @if ($product->images)
        @foreach ($product->images as $image)
            <div class="image-container">
                <img src="{{ $image->image_url }}" alt="img" class="img-fit m-1 border p-1" height="60">
                <span data-image-type="gallery" data-image-id="{{ $image->id }}" title="delete image"
                    data-product-id="{{ $product->id }}" class="fa fa-trash delete-icon text-danger"
                    style="cursor: pointer"></span>
            </div>
        @endforeach
    @endif
</div>
<div class="form-group">
    <x-form.input label="Price" name="price" :value="$product->price" />
</div>
<div class="form-group">
    <x-form.input label="Compare Price" name="compare_price" :value="$product->compare_price" />
</div>
<div class="form-group">
    <x-form.input label="Tags" name="tags" :value="$tags" />
</div>
<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'draft' => 'Draft', 'archvied' => 'Archvied']" />
    </div>
</div>
<div class="form-group">
    <button type="submit" id="create_product" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>

@push('scripts')
    <script src="{{ asset('js/tagify.min.js') }}"></script>
    <script src="{{ asset('js/tagify.polyfills.min.js') }}"></script>
    <script>
        var inputElm = document.querySelector('[name=tags]'),
            tagify = new Tagify(inputElm);
    </script>
@endpush
