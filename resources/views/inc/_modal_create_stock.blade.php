<div>

    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
        + {{__('New Stock')}}
    </button>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Stock To {{ $branch->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="{{ route('admin.stock.store') }}" class="p-2">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group {{ $errors->get('name') ? 'error':'' }} ">
                            <label>description</label>
                            <textarea class="form-control" rows="3" placeholder="description" name="name"></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <label> {{ __('select plate type') }} </label>
                                <select name="type" class="form-control">
                                    <option value="private">{{ __('private') }}</option>
                                    <option value="commercial">{{ __('commercial') }}</option>
                                    <option value="diplomatic">{{ __('diplomatic') }}</option>
                                    <option value="temporary">{{ __('temporary') }}</option>
                                    <option value="export">{{ __('export') }}</option>
                                    <option value="specific">{{ __('specific') }}</option>
                                    <option value="learners">{{ __('learners') }}</option>
                                    <option value="government">{{ __('government') }}</option>
                                    <option value="other">{{ __('other') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> {{ __('select plate size') }}</label>
                                <select name="size" class="form-control">
                                    <option value="small">small</option>
                                    <option value="medium">medium</option>
                                    <option value="large">large</option>
                                    <option value="largeWithKhanjer">Large With Khanjer</option>
                                    <option value="bike">bike</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->get('quantity') ? 'error':'' }} ">
                            <label for="exampleInputquantity"> quantity | الكمية </label>
                            <input type="number" class="form-control" id="exampleInputquantity" placeholder="quantity" name="quantity">
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> {{__('Save')}} </button>
                    </div>
                    <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



</div>