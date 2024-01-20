<x-layout.admin>
    <div>
        <form action="{{ route('admin.branch.permission.update',$branch->id) }}" method="POST">
            @csrf
            <div class="mb-5">
                <div class="mt-3 p-3 text-xl text-red-800">
                Permissions: {{ app()->getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" name="permissionIds[]" value="{{ $permission->id }}" @if($permission->has_permission) checked @endif>
                                        {{ $permission->title }}
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-primary">save</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form> <!-- / form -->
    </div>
</x-layout.admin>