<div>
    <div class="header-grid">
        {{-- <div class="popup-wrap message type-header">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="header-item">
                        <span class="text-tiny">1</span>
                        <i class="icon-bell"></i>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2">
                    <li>
                        <h6>Notifications</h6>
                    </li>
                    <li>
                        <div class="message-item item-1">
                            <div class="image">
                                <i class="icon-noti-1"></i>
                            </div>
                            <div>
                                <div class="body-title-2">Discount available</div>
                                <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus
                                    at, ullamcorper nec diam</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="message-item item-2">
                            <div class="image">
                                <i class="icon-noti-2"></i>
                            </div>
                            <div>
                                <div class="body-title-2">Account has been verified</div>
                                <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus
                                    et</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="message-item item-3">
                            <div class="image">
                                <i class="icon-noti-3"></i>
                            </div>
                            <div>
                                <div class="body-title-2">Order shipped successfully</div>
                                <div class="text-tiny">Integer aliquam eros nec sollicitudin
                                    sollicitudin</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="message-item item-4">
                            <div class="image">
                                <i class="icon-noti-4"></i>
                            </div>
                            <div>
                                <div class="body-title-2">Order pending: <span>ID 305830</span>
                                </div>
                                <div class="text-tiny">Ultricies at rhoncus at ullamcorper</div>
                            </div>
                        </div>
                    </li>
                    <li><a href="#" class="tf-button w-full">View all</a></li>
                </ul>
            </div>
        </div> --}}
        <div class="popup-wrap user type-header">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="header-user wg-user">
                        <span class="image">
                            <img src="admin/images/avatar/user-1.png" alt="">
                        </span>
                        <span class="flex flex-column">
                            <span class="body-title mb-2">{{$user->name}}</span>
                            <span class="text-tiny">{{session('role')}}</span>
                        </span>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                    <li>
                        <a href="/settings" class="user-item">
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                            <div class="body-title-2">Account</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="user-item">
                            <div class="icon">
                                <i class="icon-mail"></i>
                            </div>
                            <div class="body-title-2">Inbox</div>
                            <div class="number">0</div>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="#" class="user-item">
                            <div class="icon">
                                <i class="icon-file-text"></i>
                            </div>
                            <div class="body-title-2">Taskboard</div>
                        </a>
                    </li> --}}
                    <li>
                        <form method="POST" action="{{ route('dashboard.logout') }}" id="logout-form"
                            style="display: inline;">
                            @csrf
                            <a href="javascript:void(0)" class="user-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <div class="icon">
                                    <i class="icon-log-out"></i>
                                </div>
                                <div class="body-title-2">Logout</div>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>