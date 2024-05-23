
            <div id="GSCCModalUsuario" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">

                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <ul STYLE="text-align: left">
                                            <li>Nome : <label id="labelNome"></label></li>
                                            <li>Permissão : <label id="labelPermissao"></label></li>
                                            <li>Entrada : <label id="labelEntrada"></label></li>
                                           </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div id="GSCCModalUsuarioValidador" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">

                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <ul STYLE="text-align: left">
                                            <li>Nome : <label id="labelNomeValidador"></label></li>
                                            <li>Permissão : <label id="labelPermissaoValidador"></label></li>
                                            <li>Entrada : <label id="labelEntradaValidador"></label></li>
                                            <input id="inputUsuarioValidador" hidden>
                                            <input id="inputCodModeloAssociadoValidador" hidden>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="button" onclick="desvincularUsuarioValidador()" class="btn btn-dark" value="Mudar Papel">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
