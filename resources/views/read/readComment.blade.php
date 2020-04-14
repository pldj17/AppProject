@foreach($noti as $k => $n)

   

    <li>
        <a href="#" style="text-decoration:none;">
            <div class="pull-left">

            </div>
            <small style="color:#000000;">
                Nuevo <br>comentario
                <small><i class="fas fa-clock-o"></i>{{ $n->created_at->diffForHumans() }}</small>
                <br>
            </small>
            <hr>
            {{-- <p>Show order from <b>Sa</b>
                <small>
                    <button class="btn btn-info btn-xs pull-right btn-read" value="{{ $n->comment_id }}">Read</button>
                </small>
            </p> --}}
        </a>
    </li>
@endforeach