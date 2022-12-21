<!-- BEGIN FOOTER -->
@if (!$isLogin ?? true)
<div class="page-footer">
    <div class="container-fluid"><center>
        E - LKPJ v.1 | SISTEM INFORMASI LAPORAN KETERANGAN PERTANGGUNGJAWABAN | Copyright &copy; PT. Geomedia Sinergi
        @php
            echo date('Y');
        @endphp
    </center></div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
@endif

<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/jquery-migrate.min.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootbox.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tursinei.paginate.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="{{ asset('js/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/geojs.js') }}" type="text/javascript"></script>

<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout

    }).on('click', '#btn-logout', function() {
        let b = $(this);
        let url = `{{ route('logout') }}`;
        bootbox.confirm(`Apakah Anda Yakin akan Keluar ?`,function(ans) {
            if(ans){
                // gAjax(b.find('i'),{
                //     url: url,
                //     // dataType : 'JSON',
                //     type : 'POST',
                //     done :function(e){
                //         // $('#tahun').trigger('change');
                //     }
                // });
                window.location.href = url;
            }
        });
    }).on('click', '#btn-change-password', function() {
        var b = $(this), url = ``;
        gAjax(b.find('i'), {
            url: url,
            dataType : 'JSON',
            done: function(e) {
                showModal(e.modal);
            }
        });
    }).on('submit','#fo-change-password', function(e){
        e.preventDefault();
        let f = $(this), url = ``, b = f.find('button[type="submit"]');
        let data = f.serializeArray();
        gAjax(b.find('i'), {
            url: url,
            data : data,
            dataType : 'JSON',
            type : 'POST',
            done: function(e) {
                if(e.status){
                    f.parents('div.modal').modal('hide');
                    msgSuccess(e.message);
                } else {
                    msgAlert(e.message);
                }
            }
        });
    });
</script>
@stack('js')
