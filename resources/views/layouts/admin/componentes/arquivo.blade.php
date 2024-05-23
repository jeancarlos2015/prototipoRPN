<tr>

{{--        <td>--}}

{{--                <img class="d-flex mr-3 rounded-circle"--}}
{{--                     src="#"--}}
{{--                     alt="" width="100">--}}

{{--        </td>--}}

{{--        <td>--}}
{{--            <a href="{!! URL::asset($aquivo->link) !!}">--}}
{{--                <i class="fa fa-download fa-2x"></i>--}}
{{--            </a>--}}
{{--        </td>--}}

    <td colspan="2">
        <a
            href="{!! route('donwload_arquivo',[$arquivo->link]) !!}"
        download>
            <i class="fa fa-download faa-pulse  fa-2x" style="color: black;"></i>
        </a>
    </td>
</tr>
