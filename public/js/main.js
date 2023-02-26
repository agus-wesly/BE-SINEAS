$(document).ready(function () {
    window._token = $('meta[name="csrf-token"]').attr("content");

    moment.updateLocale("en", {
        week: { dow: 1 }, // Monday is the first day of the week
    });

    $(".date").datetimepicker({
        format: "YYYY-MM-DD",
        locale: "en",
        icons: {
            up: "fas fa-chevron-up",
            down: "fas fa-chevron-down",
            previous: "fas fa-chevron-left",
            next: "fas fa-chevron-right",
        },
    });

    $(".datetime").datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
        locale: "en",
        sideBySide: true,
        icons: {
            up: "fas fa-chevron-up",
            down: "fas fa-chevron-down",
            previous: "fas fa-chevron-left",
            next: "fas fa-chevron-right",
        },
    });

    $(".timepicker").datetimepicker({
        format: "HH:mm:ss",
        icons: {
            up: "fas fa-chevron-up",
            down: "fas fa-chevron-down",
            previous: "fas fa-chevron-left",
            next: "fas fa-chevron-right",
        },
    });

    $(".select-all").click(function () {
        let $select2 = $(this).parent().siblings(".select2");
        $select2.find("option").prop("selected", "selected");
        $select2.trigger("change");
    });
    $(".deselect-all").click(function () {
        let $select2 = $(this).parent().siblings(".select2");
        $select2.find("option").prop("selected", "");
        $select2.trigger("change");
    });

    $(".select2").select2();

    $(".treeview").each(function () {
        var shouldExpand = false;
        $(this)
            .find("li")
            .each(function () {
                if ($(this).hasClass("active")) {
                    shouldExpand = true;
                }
            });
        if (shouldExpand) {
            $(this).addClass("active");
        }
    });

    $(".c-header-toggler.mfs-3.d-md-down-none").click(function (e) {
        $("#sidebar").toggleClass("c-sidebar-lg-show");

        setTimeout(function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        }, 400);
    });
});

function backPage(to, params) {
    if (!params) {
        let url = window.location;
        let pathOrigin = url.pathname
            .split("/")
            .slice(1, to + 1)
            .join("/");
        let origin = `${url.origin}/${pathOrigin}`;
        window.location = origin;
    } else {
        let url = window.location;
        let pathOrigin = url.pathname
            .split("/")
            .slice(1, to + 1)
            .join("/");
        let origin = `${url.origin}/${pathOrigin}?${params}`;
        window.location = origin;

    }
}

$(function () {
    let parent1 = $(document).find(".c-active").parent().parent().parent();
    let parent2 = $(document)
        .find(".c-active")
        .parent()
        .parent()
        .parent()
        .parent()
        .parent();
    if (parent1.hasClass("c-sidebar-nav-dropdown")) {
        parent1.addClass("c-show");
    }
    if (parent2.hasClass("c-sidebar-nav-dropdown")) {
        parent2.addClass("c-show");
    }
});

$(function () {
    let ele = $(document).find("*[data-current-date]");
    var dt = new Date();
    var time =
        dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
    if (ele.attr("data-current-date") == "true") {
        ele.text(time);
    }
});

const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
});

function formatCurrency(value){
    const formatters = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    });

    var curr = formatters.format(value)
    var charLength = curr.length
    var totalCurrency = curr.slice(0, charLength - 3)
    return totalCurrency
    
}

$(function () {
    let ele = $(document).find("*[data-sum-col]");
    let eleTarget = $(document).find("*[data-sum-col-target]");
    let classEle = "data-item-" + ele.attr("data-sum-col");
    let label = eleTarget.attr("data-sum-col-label");
    let col = ele.parent().children().index(ele);
    let colLength = ele.parent().parent().parent().find("tbody > tr");
    let total = 0;

    colLength.each(function () {
        $(this).children().eq(col).addClass(classEle);
    });
    let data = $(document)
        .find("." + classEle)
        .map(function () {
            return parseInt($(this).text().replace(".", ""));
        })
        .get();

    for (let i = 0; i < data.length; i++) {
        total += data[i] << 0;
    }

    var curr = formatter.format(total)
    var charLength = curr.length
    var totalCurrency = curr.slice(0, charLength - 3)
    
    eleTarget.text(label + " " + totalCurrency);
});

$(function () {
    // Button for Print
    $(".buttons-link-to-pdf").on("click", function () {
        $("a.buttons-pdf").click();
    });
});

$(function () {
    let table = $(document).find("th.col-warning");
    table
        .parent()
        .parent()
        .parent()
        .find("tr:not(:first):not(:last)")
        .each(function () {
            $(this)
                .find("td:eq(" + table.index() + ")")
                .addClass("col-warning-tbody");
        });
});

$(function () {
    let table = $(document).find("th.col-danger");
    table
        .parent()
        .parent()
        .parent()
        .find("tr:not(:first):not(:last)")
        .each(function () {
            $(this)
                .find("td:eq(" + table.index() + ")")
                .addClass("col-danger-tbody");
        });
});
$(function () {
    let table = $(document).find("th.col-success");
    table
        .parent()
        .parent()
        .parent()
        .find("tr:not(:first):not(:last)")
        .each(function () {
            $(this)
                .find("td:eq(" + table.index() + ")")
                .addClass("col-success-tbody");
        });
});
