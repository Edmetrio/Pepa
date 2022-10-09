<div class="modal fade" id="documentoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel" >Entidade e Referência</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h3>Dados de pagamento</h3>
                <div class="row">
                    <div class="col-12 col-md-6">Entidade: </div>
                    <div class="col-6 col-md-6" >909878</div>
                    <div class="col-12 col-md-6">Referência:</div>
                    <div class="col-6 col-md-6" >1099761700</div>
                    <div class="col-12 col-md-6">Montante:</div>
                    <div class="col-6 col-md-6" >{{$item->ttotal}},00 MZN</div>
                </div>
                {{-- <ol class="col-sm">
                    <li>Entidade: </li>
                    <li>Referência: </li>
                    <li>Montante: {{$item->total}} MZN</li>
                </ol> --}}
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Descordo</button> -->
                <button type="button" class="btn btn-primary" data-dismiss="modal">Entendi</button>
            </div>
        </div>
    </div>
</div>