<div class="modal fade in" id="myModal" role="dialog">
    <div class="modal-dialog @if($isLarge??false)
        modal-lg
    @endif">

        <div class="modal-content">
            <form id="{{ $idForm }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $modalTitle }}</h4>
                </div>
                <div class="modal-body">
                    @yield('ModalBody')
                </div>
                <div class="modal-footer">
                    @yield('leftButtons','')
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                    @php
                        $hideSubmit = ($isSubmit??true)?'':'d-none';
                    @endphp
                    <button type="submit" class="btn btn-sm btn-success {{ $hideSubmit }}"><i class="fa fa-save"></i>&nbsp;@yield('textButtonSave','Simpan')</button>
                </div>
            </form>
        </form>
        </div>
    </div>
</div>
