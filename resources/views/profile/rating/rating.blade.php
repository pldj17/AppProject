<ul class="list-inline">
    <li class="list-inline-item"><i class="fas fa-star fa-2x {{$avgStar >= 1 ? ' blue' : ''}}" data-toggle="tooltip" data-placement="bottom" title={{bcdiv($avgStar, '1', 1)}}></i></li>
    <li class="list-inline-item"><i class="fas fa-star fa-2x {{$avgStar >= 2 ? ' blue' : ''}}" data-toggle="tooltip" data-placement="bottom" title={{bcdiv($avgStar, '1', 1)}}></i></li>
    <li class="list-inline-item"><i class="fas fa-star fa-2x {{$avgStar >= 3 ? ' blue' : ''}}" data-toggle="tooltip" data-placement="bottom" title={{bcdiv($avgStar, '1', 1)}}></i></li>
    <li class="list-inline-item"><i class="fas fa-star fa-2x {{$avgStar >= 4 ? ' blue' : ''}}" data-toggle="tooltip" data-placement="bottom" title={{bcdiv($avgStar, '1', 1)}}></i></li>
    <li class="list-inline-item"><i class="fas fa-star fa-2x {{$avgStar >= 5 ? ' blue' : ''}}" data-toggle="tooltip" data-placement="bottom" title={{bcdiv($avgStar, '1', 1)}}></i></li>
    <li class="list-inline-item" data-toggle="tooltip" data-placement="bottom" title="Puntaciones"><small>({{$ratingCount}})</small></li>
</ul>