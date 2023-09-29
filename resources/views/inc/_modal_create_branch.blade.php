<div>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
        + {{__('branch')}}
    </button>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Branch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="post" action="{{ route('admin.branch.store') }}" class="p-2">
                    @csrf
                    <div class="modal-body">


                        <div class="form-group {{ $errors->get('name') ? 'error':'' }} ">
                            <label for="exampleInputBranch"> branch | اسم الفرع </label>
                            <input type="text" class="form-control" id="exampleInputBranch" placeholder=" branch  " name="name">
                        </div>


                        <div class="form-group {{ $errors->get('username') ? 'error':'' }} ">
                            <label for="exampleInputUsername"> username | المستخدم   </label>
                            <input type="text" class="form-control" id="exampleInputUsername" placeholder=" username  " name="username">
                        </div>


                        <div class="form-group {{ $errors->get('password') ? 'error':'' }} ">
                            <label for="exampleInputPassword"> password |   كلمة المرور </label>
                            <input type="text" class="form-control" id="exampleInputPassword" placeholder=" password  " name="password">
                        </div>


                        @if($errors->any())
                        @foreach($errors->all() as $error)

                        <div class="text-red-400">
                            {{ $error}}
                        </div>

                        @endforeach
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> {{__('Save')}} </button>
                    </div>

                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



</div>