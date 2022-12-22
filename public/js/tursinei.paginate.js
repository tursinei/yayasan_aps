/**
 * plugin jquery Pagination integrated with laravel paginate function via ajax .
 * Copyright (c) 2022 Velly tursinei;
 */
(function ($) {
    let defaultSetting = {
        numbering: true,
        useButtons: true,
        searching :  true,
        cols: [],
        colId: "",
        url: "",
        state : true,
        reload : false,
        simple : false,
    };
    let TABLE = null;
    let keyPrefix = '_tPaginate';

    let methods =  {
        init : function (options) {
            return this.each(function() {
                var setting = $.extend({}, defaultSetting, options || {});
                if (setting.url == "") {
                    throw 'Key url Undefined';
                }

                TABLE = $(this);
                if (setting.colId == "" && settiing.useButtons) {
                    throw 'Key colId as column name of primary key from table Undefined, as long as Key useButtons is true ';
                }

                let divScrollable = TABLE.parent(".table-scrollable");
                if (divScrollable.length == 0) {
                    divScrollable = TABLE.wrap('<div class="table-scrollable"></div>').parent();
                }
                $(this).data(keyPrefix, setting);
                $.get(setting.url, function (res) {
                    if(setting.searching){
                        genCari(divScrollable);
                    }
                    generateTr(res);
                    genPages(divScrollable, res);
                });
            })
        },
        reload :  function () {
            return this.each(function() {
                var settings = $(this).data(keyPrefix);
                settings.reload = true;
                $('ul.pagination > li.active > a').trigger('click');
            })
        }
    };

    $.fn.tPaginate = function (method) {
        if ( methods[method] ) {
            return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.tPaginate' );
        }
    };

    function generateTr(e) {
        let tr = "",
            no = e.from;
        let setting = $(TABLE).data(keyPrefix);
        e.data.forEach((obj) => {
            let trObj = $("<tr></tr>");
            if (setting.numbering) {
                let td = $("<td></td>").text(no).addClass("text-center");
                trObj.append(td[0].outerHTML);
            }
            setting.cols.forEach((col) => {
                let td = $("<td></td>").appendTo(trObj)
                if (typeof col == "object") {
                    td.html(obj[col.key]).addClass(col.class);
                    if(typeof col.custom == 'function'){
                        td.html(col.custom(obj[col.key],trObj));
                    }
                } else if(typeof col == 'function'){
                    td.html(col(obj,td))
                } else {
                    td.text(obj[col]);
                }
            });
            if (setting.useButtons) {
                let btnEdit = '<button type="button" data-id="'+obj[setting.colId]+'" class="btn btn-xs btn-info btn-update" ><i class="fa fa-pencil"></i></button>';
                let btnDel = '<button type="button" data-id="'+obj[setting.colId]+'" class="btn btn-xs btn-delete btn-danger" ><i class="fa fa-trash"></i></button>';
                let td = $("<td></td>")
                    .html(btnEdit + "&nbsp;" + btnDel)
                    .addClass("text-center");
                trObj.append(td[0].outerHTML);
            }
            tr += trObj[0].outerHTML;
            no++;
        });
        let tbody = TABLE.find("tbody");
        if (tbody.length == 0) {
            $("<tbody></tbody>").html(tr);
        } else {
            tbody.html(tr);
        }
    }

    function genCari(divScrollable) {
        let divCari = divScrollable.prev("div.row").find("div.text-right");
        let setting = $(TABLE).data(keyPrefix);
        if (divCari.length == 0) {
            divCari = $("<div></div>").addClass("col-md-12");
            let sField = $('<input id="tPaginate-search">')
                .appendTo(divCari)
                .addClass("form-control input-medium input-sm pull-right")
                .attr("placeholder", "Search");
            sField.on("input", function () {
                let data = { tsearch: this.value };
                $.get(setting.url, data, function (res) {
                    generateTr(res);
                    genPages(divScrollable, res);
                });
            });
            let divRow = $('<div class="row"></div>').append(divCari);
            divRow.insertBefore(divScrollable);
        }
    }

    function genPages(divScrollable, resPaginate) {
        let setting = $(TABLE).data(keyPrefix);
        let divPagination = divScrollable.next("div.row");
        if (divPagination.length == 0) {
            divPagination = $('<div class="row"></div>').insertAfter(divScrollable);
            divPagination.append('<div class="col-md-12 text-right"></div>');
        }
        let ulPagination = $('<ul class="pagination"></ul>');
        if(setting.simple){
            let res = resPaginate, disablePrv = '', disableNex = '';
            if (res.prev_page_url == null) {
                disablePrv = "disabled";
                href = "#";
            }
            let liPrev = $(
                '<li class="'+disablePrv+'"><a href="'+res.prev_page_url+'">&laquo; Previous</a></li>'
            );
            ulPagination.append(liPrev);
            eventClickPage(liPrev.find('a'), divScrollable);
            if (res.next_page_url == null) {
                disableNex = "disabled";
                href = "#";
            }
            let liNext = $(
                '<li class="'+disableNex+'"><a href="'+res.next_page_url+'">Next &raquo;</a></li>'
            );
            ulPagination.append(liNext);
            eventClickPage(liNext.find('a'), divScrollable);
        } else {
            resPaginate.links.forEach((link) => {
                let disable = "",
                    active = "",
                    href = link.url;
                if (link.active) {
                    active = "active";
                    href = "#";
                }
                if (link.url == null) {
                    disable = "disabled";
                    href = "#";
                }
                let li = $(
                    '<li class="'+disable+' '+active+'"><a href="'+href+'">'+link.label+'</a></li>'
                );
                eventClickPage(li.find('a'), divScrollable);
                ulPagination.append(li);
            });
        }
        divPagination.find(".text-right").html(ulPagination);
    }

    function eventClickPage(a, divScrollable) {
        let setting = $(TABLE).data(keyPrefix);
        $(a).click(function (evt) {
            evt.preventDefault();
            if (!$(this).parent().hasClass("active") && !$(this).parent().hasClass("disabled") || setting.reload) {
                let data = {}, url = this.href;
                if(setting.searching){
                    data.tsearch = $("#tPaginate-search").val();
                }
                if(setting.reload){
                    url = setting.url;
                    if(setting.state){
                        data.page = $(this).text();
                    }
                    setting.reload = false;
                }

                $.get(url, data, function (res) {
                    generateTr(res);
                    genPages(divScrollable, res);
                });
            }
        });
    }
})(jQuery);
