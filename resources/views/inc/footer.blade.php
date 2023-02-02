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
        let ulBread = $('ul.page-breadcrumb');
        let liActive = $('ul.page-sidebar-menu').find('li.active');
        liActive.each(function(i,e){
            let t = $(this).find('a:first').text();
            let li = $('<li></li>').append('<a href="#">'+t+'</a>');
            if((liActive.length-1) != i){
                li.append('<i class="fa fa-angle-right">');
            }
            ulBread.append(li);
        });
    }).on('click', '#btn-logout', function() {
        let b = $(this);
        let url = `{{ route('logout') }}`;
        bootbox.confirm(`Apakah Anda Yakin akan Keluar ?`,function(ans) {
            if(ans){
                window.location.href = url;
            }
        });
    }).on('click', '#header-form-profil', function(e) {
        e.preventDefault();
        var b = $(this), url = `{{ route('profile.form', ['users' => ':id']) }}`;
        url = url.replace(':id', b.attr('data-id'));
        gAjax(b.find('i'), {
            url: url,
            dataType : 'html',
            done: function(e) {
                showModal(e);
            }
        });
    }).on('submit','#fo-changePass', function(e){
        e.preventDefault();
        let f = $(this), url = '{{ route('profile.simpan') }}', b = f.find('button[type="submit"]');
        let data = f.serializeArray();
        gAjax(b.find('i'), {
            url: url,
            data : data,
            dataType : 'JSON',
            type : 'POST',
            done: function(e) {
                f.parents('div.modal').modal('hide');
                $('span.username').text(e.name);
                msgSuccess(e.message);
            }
        });
    });
</script>
@stack('js')
