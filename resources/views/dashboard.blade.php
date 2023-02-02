@extends('layouts.master')

@section('title', 'Dashboard')
{{-- @section('subTitle', 'Welcome, this page after login') --}}

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
            <div class="dashboard-stat blue-madison">
                <div class="visual">
                    <i class="fa fa-briefcase fa-icon-medium"></i>
                </div>
                <div class="details jumlah-anak">
                    <div class="number">
                        &nbsp;
                    </div>
                    <div class="desc">
                        Jumlah Anak
                    </div>
                </div>
                <a class="more" href="javascript:;">&nbsp;
                    <i class="m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat green-haze">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details alumni">
                    <div class="number">
                        &nbsp;
                    </div>
                    <div class="desc">
                        Jumlah Alumni
                    </div>
                </div>
                <a class="more" href="javascript:;"> &nbsp;
                    <i class="m-icon-white"></i>
                </a>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat green-haze">
                <div class="visual">
                    <i class="fa fa-group fa-icon-medium"></i>
                </div>
                <div class="details">
                    <div class="number">
                        $670.54
                    </div>
                    <div class="desc">
                        Average Orders
                    </div>
                </div>
                <a class="more" href="javascript:;">
                    View mor    e <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div> --}}
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(params) {
            setTimeout(() => {
                let divd = $('.jumlah-anak'),i = divd.siblings('a').find('i');
                gAjax(i, {
                    url : '{{ route('dashboard.jumlah') }}',
                    type : 'GET',
                    dataType : 'JSON',
                    done : function(res){
                        divd.find(".number").html(res.count);
                    }
                });
            }, 100);
            setTimeout(() => {
                let div = $('.alumni'), i = div.siblings('a').find('i');
                gAjax(i, {
                    url : '{{ route('dashboard.jumlah') }}',
                    data : {alumni : 1},
                    type : 'GET',
                    dataType : 'JSON',
                    done : function(res){
                        div.find(".number").html(res.count);
                    }
                });
            }, 200);
        });
    </script>
    @endpush
