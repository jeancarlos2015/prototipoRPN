@if(Auth::user()->usuario_esta_no_repositorio())
    <tr>
        <td colspan="3">
            <a class="btn btn-dark" href="{!! route('delete_vinculo_repositorio')!!}"
               style="cursor: pointer;">Sair Do
                Repositório: {!! Auth::getUser()->repositorio->nome !!}</a>
        </td>
    </tr>
@endif
