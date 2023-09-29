<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.user.index',['role'=>'director']) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p class="text-xs"> المدير العام | General Director</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index',['role'=>'executive']) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p class="text-xs">الرئيس التنفيذي | Executive</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index',['role'=>'chariman']) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p class="text-xs"> رئيس مجلس الإدارة | Chairman </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index',['role'=>'accountant']) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p class="text-xs"> المحاسب | Accountant </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index',['role'=>'branch_manager']) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p class="text-xs"> مدير الفرع | Branch Manager </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index',['role'=>'store_keeper']) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p class="text-xs"> مسؤل المخزن | Store Keeper </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index',['role'=>'project_manager']) }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p class="text-xs"> مدير المشروع | Project Manager </p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.branch.create') }}" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                    branches
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.stock.plate.index') }}" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                <p>
                    stock monitor
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.statistic.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    statistic
                </p>
            </a>
        </li>


        
    </ul>
</nav>