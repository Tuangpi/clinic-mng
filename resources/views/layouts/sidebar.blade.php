@php
    $currentBranch = session('branch');
    $branchId = $currentBranch ? $currentBranch->id : null;
    $criticalCount = App\Models\Product::critical($branchId)->count();
    $user = \Auth::user();
@endphp

<div id="sidebar" class="app-sidebar no-print">

    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

        <div class="menu">
            <div class="menu-header">&nbsp;</div>
            @if ($user->hasAccess('Patient'))
                <div class="menu-item">
                    <a href="{{ route('patients.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-user-group"></i>
                        </div>
                        <div class="menu-text">All Patients</div>
                    </a>
                </div>
            @endif
            @if ($user->hasAccess('Appointment'))
                <div class="menu-item">
                    <a href="{{ route('appointment.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-calendar-days"></i>
                        </div>
                        <div class="menu-text">Appointment</div>
                    </a>
                </div>
            @endif
            @if ($user->hasAccess('Queue'))
                <div class="menu-item">
                    <a href="{{ route('queue.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-clock"></i>
                        </div>
                        <div class="menu-text">Queue</div>
                    </a>
                </div>
            @endif
            {{-- @if (\Auth::user()->is_administrator) --}}
            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-clipboard-list"></i>
                    </div>
                    <div class="menu-text">Inventory Setup</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @if ($user->hasAccess('Inventory'))
                        <div class="menu-item">
                            <a href="{{ route('inventory.index') }}" class="menu-link">
                                <div class="menu-text">Inventory</div>
                                @if ($criticalCount > 0)
                                <div class="menu-badge bg-red-100 text-white">{{number_format($criticalCount, 0)}}</div>
                                @endif
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Package'))
                        <div class="menu-item">
                            <a href="{{ route('packages.index') }}" class="menu-link">
                                <div class="menu-text">Packages</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Supplier'))
                        <div class="menu-item">
                            <a href="{{ route('suppliers.index') }}" class="menu-link">
                                <div class="menu-text">Suppliers</div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-boxes-stacked"></i>
                    </div>
                    <div class="menu-text">Stock Management</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @if ($user->hasAccess('Purchase Order'))
                        <div class="menu-item">
                            <a href="{{ route('purchase-orders.index') }}" class="menu-link">
                                <div class="menu-text">Purchase Orders</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Stock Adjustment'))
                        <div class="menu-item">
                            <a href="{{ route('stock-adjustments.index') }}" class="menu-link">
                                <div class="menu-text">Stock Adjustments</div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @endif --}}
            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-file-lines"></i>
                    </div>
                    <div class="menu-text">Reports</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @if ($user->hasAccess('Accounting Report'))
                        <div class="menu-item">
                            <a href="{{ route('accounting-reports.index') }}" class="menu-link">
                                <div class="menu-text">Accounting Reports</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Inventory Report'))
                        <div class="menu-item">
                            <a href="{{ route('inventory-reports.index') }}" class="menu-link">
                                <div class="menu-text">Inventory Reports</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Patient Report'))
                        <div class="menu-item">
                            <a href="{{ route('patient-reports.index') }}" class="menu-link">
                                <div class="menu-text">Patient Reports</div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @if (\Auth::user()->is_administrator) --}}
            <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-screwdriver-wrench"></i>
                    </div>
                    <div class="menu-text">General Setup</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    @if ($user->hasAccess('Access Control Setup'))
                        <div class="menu-item">
                            <a href="{{ route('access-control.index') }}" class="menu-link">
                                <div class="menu-text">Access Control</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Branch Setup'))
                        <div class="menu-item">
                            <a href="{{ route('branches.index') }}" class="menu-link">
                                <div class="menu-text">Branches</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Patient Setup'))
                        <div class="menu-item">
                            <a href="{{ route('patient-general-setup.index') }}" class="menu-link">
                                <div class="menu-text">Patient</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Appointment Setup'))
                        <div class="menu-item">
                            <a href="{{ route('appointment-general-setup.index') }}" class="menu-link">
                                <div class="menu-text">Appointment</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Inventory Setup'))
                        <div class="menu-item">
                            <a href="{{ route('inventory-general-setup.index') }}" class="menu-link">
                                <div class="menu-text">Inventory</div>
                            </a>
                        </div>
                    @endif
                    @if ($user->hasAccess('Finance Setup'))
                        <div class="menu-item">
                            <a href="{{ route('finance.index') }}" class="menu-link">
                                <div class="menu-text">Finance</div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @endif --}}
        </div>

    </div>

</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>