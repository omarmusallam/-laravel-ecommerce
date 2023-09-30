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
    <x-form.input label="Category Name" name="name" :value="$category->name" />
</div>
<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$category->description" />
</div>
<div class="form-group">
    <x-form.label id="image">Image</x-form.label>

    <x-form.input type="file" name="image" accept="image/*" />
    @if ($category->image)
        <div class="image-container">
            <img src="{{ asset('storage/' . $category->image) }}" alt="img" class="img-fit m-1 border p-1"
                height="60">
            <span id="delete-image-btn" class="fa fa-trash delete-icon text-danger" style="cursor: pointer"></span>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>
<div class="form-group">
    <button id="create_category" class="btn btn-primary update_category">{{ $button_lable ?? 'Sava' }}</button>
</div>
