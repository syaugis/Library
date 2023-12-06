<form action="{{ route('admin.book_copy.store', $id) }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-12">
                <label class="form-label" for="quantity">Book Quantity<span class="text-danger">*</span></label>
                <input name="quantity" id="quantity" class="form-control" type="number" min="1" value="1"
                    required>

                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add Book</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</form>
