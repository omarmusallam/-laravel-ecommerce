<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($newCount)
            <span class="badge badge-warning navbar-badge">{{ $newCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div>
            <span style="display: inline; text-align: center; color: #303c64;font-weight: bold; " class="dropdown-header">{{ $newCount }}
                Notifications</span>
            <a href="{{ route('dashboard.notification.markAsRead') }}" style="display: inline; color: #303c64; font-weight:bold"
                class="dropdown-header float-right ">Marks all</a>
        </div>
        <div class="dropdown-divider"></div>
        @php
            \Carbon\Carbon::setLocale('en');
        @endphp
        @foreach ($notifications as $notification)
            <a href="{{ route('dashboard.orders.show', $notification->data['order_id']) }}"
                class="dropdown-item text-wrap">
                <i class="{{ $notification->data['icon'] }} mr-2"></i> {{ $notification->data['body'] }}
                <span class="float-right text-sm">
                    <span style="color: #303c64;font-weight: bold;"
                        class="notification-date">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
                </span>
            </a>
            <div class="dropdown-divider"></div>
        @endforeach

        <a href="{{ route('dashboard.notification') }}" class="dropdown-item dropdown-footer" style="color: #303c64;font-weight: bold;">See All Notifications</a>
    </div>
</li>
