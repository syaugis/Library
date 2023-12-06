<form action="{{ route('admin.book_copy.update', $id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-12">
                <label class="form-label" for="is_available">Book Availability<span class="text-danger">*</span></label>
                <select name="is_available" id="is_available" class="form-control"autofocus required>
                    <option hidden>Select Book Availability</option>
                    <option value="0" {{ old('is_available', $data->is_available) == 0 ? 'selected' : '' }}>Not
                        Available</option>
                    <option value="1" {{ old('is_available', $data->is_available) == 1 ? 'selected' : '' }}>Is
                        Available</option>
                </select>

                @error('is_available')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update Book</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</form>
