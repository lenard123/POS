<nav>
    <div class="nav-item" id="inventory">
        <a href="{{ route('admin') }}">
            <img height="56" width="56" src="{{asset('icon/chest.png')}}" />
            <br>
            <span>INVENTORY</span>
        </a>
    </div>

    <div class="nav-item" id="addproduct">
        <a href="{{ route('addproduct') }}">
            <img height="56" width="56" src="{{asset('icon/add.png')}}" />
            <br>
            <span>NEW ITEM</span>
        </a>
    </div>

    <div class="nav-item">
        <img height="56" width="56" src="{{asset('icon/bar-chart.png')}}" />
        <br>
        <span>SALES</span>
    </div>

    <div class="nav-item" id="category">
        <a href="{{ route('category') }}">
            <img height="56" width="56" src="{{asset('icon/listing-option.png')}}" />
            <br>
            <span>CATEGORY</span>
        </a>
    </div>    

    @if (request()->user()->type == $conf::ROLE_ADMIN)
    <div class="nav-item">
        <img height="56" width="56" src="{{asset('icon/user.png')}}" />
        <br>
        <span>ACCOUNT</span>
    </div>
    @endif

    <div class="nav-item">
        <a href="{{ route('logout') }}">
            <img height="56" width="56" src="{{asset('icon/logout.png')}}" />
            <br>
            <span>LOGOUT</span>
        </a>
    </div>    

</nav>


<script>$('#{{$active}}').addClass('active')</script>
