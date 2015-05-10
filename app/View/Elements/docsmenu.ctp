<div id="toc"></div>

<script>

    var toc =
        "<div class='well'><nav role='navigation' class='table-of-contents'>" +
            "<h4>Op deze pagina:</h4><hr />" +
            "<ul class='nulled'>";

    var el, title, link;

    $(".col-md-9 h3").each(function() {
        el = $(this);
        title = el.text();
        link = "#" + el.attr("id");

        var tocEntry = "<li><a href='" + link + "'>" + title + "</a></li>";

        toc += tocEntry;
    });

    toc += "</ul></nav></div>";

    $('#toc').append(toc);
</script>