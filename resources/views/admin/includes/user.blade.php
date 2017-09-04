<div class="dropdown no-radius">
    <div class="dropdown-toggle" data-toggle="dropdown">
        <span>
            <h4>Hello, {{ $user->name }}<span class="fa fa-caret-down" style="font-size:22px;margin-left:15px;"></span></h4>
        </span>
    </div><!-- close div .dropdown-toggle -->
    <ul class="dropdown-menu pull-right no-radius" style="">
        <li><a href="#" data-toggle="modal" data-target="#apiTokenModal">API Token</a></li>
        <li><a href="#">My Account</a></li>
        <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
</div><!-- close div .dropdown -->

<!-- Modal -->
<div id="apiTokenModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content no-radius">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your API Token</h4>
            </div>
            <div class="modal-body">
                <p>{{ $user->api_token }}</p>
            </div>
        </div><!-- close div .modal-content -->
    </div>
</div><!-- close div .modal -->