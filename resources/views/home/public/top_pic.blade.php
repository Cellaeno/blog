@foreach($top_arts as $top)
    <div class="toppic">
        <li>
            <a href="/home/detail/index?aid={{$top->aid}}&cid={{$top->cid}}&tid={{$top->tid}}" target="_blank">
                <i><img src="/uploads/{{$top->thumb}}"></i>
                <h2>{{$top->title}}</h2>
                <span>{{$cate_names[$top->cid]}}</span> 
            </a> 
        </li>
    </div>
@endforeach
</div>
<div class="blank"></div>