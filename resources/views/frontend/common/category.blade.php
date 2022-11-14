<div class="col-lg-3">
    <h1 class="h2 pb-4"><b>Categories</b></h1>
    <ul class="list-unstyled templatemo-accordion">
        @foreach (categoryAll() as $item)

        <li class="pb-3">
            <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                <b>{{$item->name}}</b>
                <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
            </a>
            <ul class="collapse show list-unstyled pl-3">
                @foreach (subcategoryAll($item->slug) as $subcat)

                <li><a class="text-decoration-none" href="{{route('category_view', $subcat->slug)}}">{{$subcat->name}}</a></li>
                {{-- <li><a class="text-decoration-none" href="#">Watch</a></li> --}}
                @endforeach
            </ul>
        </li>
        @endforeach ()


        {{-- <li class="pb-3">
            <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                Women
                <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
            </a>
            <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                <li><a class="text-decoration-none" href="#">Sport</a></li>
                <li><a class="text-decoration-none" href="#">Luxury</a></li>
            </ul>
        </li>
        <li class="pb-3">
            <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                Kid
                <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
            </a>
            <ul id="collapseThree" class="collapse list-unstyled pl-3">
                <li><a class="text-decoration-none" href="#">Bag</a></li>
                <li><a class="text-decoration-none" href="#">Sweather</a></li>
                <li><a class="text-decoration-none" href="#">Sunglass</a></li>
            </ul>
        </li> --}}
    </ul>
</div>
