<div class="navs">
    <ul>
        <a href="{{ route('dashboard') }}"><li class="{{ $data['page'] == 'Dashboard' ? 'active' : '' }}"><span class="fa fa-dashboard" style="font-size:22px;margin-right:8px;"></span>Dashboard</li></a>
        <a href="{{ route('drugs') }}"><li class="{{ $data['page'] == 'Drugs' ? 'active' : '' }}"><span class="fa fa-eyedropper" style="font-size:22px;margin-right:8px;"></span>Drugs</li></a>
        <a href="{{ route('pricechecks') }}"><li class="{{ $data['page'] == 'PriceChecks' ? 'active' : '' }}"><span class="fa fa-money" style="font-size:22px;margin-right:8px;"></span>Price Checks</li></a>
    </ul>
</div><!-- close div .navs -->