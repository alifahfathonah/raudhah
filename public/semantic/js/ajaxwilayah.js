// get provinsi
function getProvinsi(token) {
    $.ajax({
        type: "GET",
        url: "https://x.rajaapi.com/MeP7c5ne" + token + "/m/wilayah/provinsi",
        dataType: "json",
        success: function (provs) {
            // console.log(provs.data);
            $.each(provs.data, function (i, v) {
                $("#selprov,#fselprov,#mselprov,#dselprov").append(
                    '<option selected disabled></option><option value="' +
                        v.id +
                        '">' +
                        v.name +
                        "</option>"
                );
            });
        },
    });

    //
    $("#selprov").change(function () {
        $("#selkab").empty();
        $("#selkec").empty();
        $("#selkel").empty();
        var id = $(this).val();
        getKabupaten(token, id, "#selkab");
        // set input text prov
        $("input[name='schprov']").val($("#selprov option:selected").text());
        $("input[name='fprov']").val($("#selprov option:selected").text());
    });
    $("#selkab").change(function () {
        $("#selkec").empty();
        $("#selkel").empty();
        var id = $(this).val();
        getKecamatan(token, id, "#selkec");
        // set input text kabupaten
        $("input[name='schkab']").val($("#selkab option:selected").text());
        $("input[name='fkab']").val($("#selkab option:selected").text());
    });
    $("#selkec").change(function () {
        $("#selkel").empty();
        var id = $(this).val();
        getKelurahan(token, id, "#selkel");
        // set input text kecamatan
        $("input[name='schkec']").val($("#selkec option:selected").text());
        $("input[name='fkec']").val($("#selkec option:selected").text());
    });
    $("#selkel").change(function () {
        // set input text kelurahan
        $("input[name='schkel']").val($("#selkel option:selected").text());
        $("input[name='fkel']").val($("#selkel option:selected").text());
    });
    //
    $("#fselprov").change(function () {
        $("#fselkab").empty();
        $("#fselkec").empty();
        $("#fselkel").empty();
        var id = $(this).val();
        getKabupaten(token, id, "#fselkab");
        $("input[name='mprov']").val($("#fselprov option:selected").text());
    });
    $("#fselkab").change(function () {
        $("#fselkec").empty();
        $("#fselkel").empty();
        var id = $(this).val();
        getKecamatan(token, id, "#fselkec");
        $("input[name='mkab']").val($("#fselkab option:selected").text());
    });
    $("#fselkec").change(function () {
        $("#fselkel").empty();
        var id = $(this).val();
        getKelurahan(token, id, "#fselkel");
        $("input[name='mkec']").val($("#fselkec option:selected").text());
    });
    $("#fselkel").change(function () {
        // set input text kelurahan
        $("input[name='mkel']").val($("#fselkel option:selected").text());
    });
    //
    $("#mselprov").change(function () {
        $("#mselkab").empty();
        $("#mselkec").empty();
        $("#mselkel").empty();
        var id = $(this).val();
        getKabupaten(token, id, "#mselkab");
        $("input[name='mprov']").val($("#mselprov option:selected").text());
    });
    $("#mselkab").change(function () {
        $("#mselkec").empty();
        $("#mselkel").empty();
        var id = $(this).val();
        getKecamatan(token, id, "#mselkec");
        $("input[name='mkab']").val($("#mselkab option:selected").text());
    });
    $("#mselkec").change(function () {
        $("#mselkel").empty();
        var id = $(this).val();
        getKelurahan(token, id, "#mselkel");
        $("input[name='mkec']").val($("#mselkec option:selected").text());
    });
    $("#mselkel").change(function () {
        // set input text kelurahan
        $("input[name='mkel']").val($("#mselkel option:selected").text());
    });
    //
    $("#dselprov").change(function () {
        $("#dselkab").empty();
        $("#dselkec").empty();
        $("#dselkel").empty();
        var id = $(this).val();
        getKabupaten(token, id, "#dselkab");
        $("input[name='dprov']").val($("#dselprov option:selected").text());
    });
    $("#dselkab").change(function () {
        $("#dselkec").empty();
        $("#dselkel").empty();
        var id = $(this).val();
        getKecamatan(token, id, "#dselkec");
        $("input[name='dkab']").val($("#dselkab option:selected").text());
    });
    $("#dselkec").change(function () {
        $("#dselkel").empty();
        var id = $(this).val();
        getKelurahan(token, id, "#dselkel");
        $("input[name='dkec']").val($("#dselkec option:selected").text());
    });
    $("#dselkel").change(function () {
        // set input text kelurahan
        $("input[name='dkel']").val($("#dselkel option:selected").text());
    });
}
// get kabupaten
function getKabupaten(token, id, el) {
    $.ajax({
        type: "GET",
        url:
            "https://x.rajaapi.com/MeP7c5ne" +
            token +
            "/m/wilayah/kabupaten?idpropinsi=" +
            id,
        dataType: "json",
        success: function (kabs) {
            // el.empty();
            $.each(kabs.data, function (i, v) {
                $(el).append(
                    '<option selected disabled></option><option value="' +
                        v.id +
                        '">' +
                        v.name +
                        "</option>"
                );
            });
        },
    });
}
// get kecamatan
function getKecamatan(token, id, el) {
    $.ajax({
        type: "GET",
        url:
            "https://x.rajaapi.com/MeP7c5ne" +
            token +
            "/m/wilayah/kecamatan?idkabupaten=" +
            id,
        dataType: "json",
        success: function (kecs) {
            $.each(kecs.data, function (i, v) {
                $(el).append(
                    '<option selected disabled></option><option value="' +
                        v.id +
                        '">' +
                        v.name +
                        "</option>"
                );
            });
        },
    });
}
// get desa
function getKelurahan(token, id, el) {
    $.ajax({
        type: "GET",
        url:
            "https://x.rajaapi.com/MeP7c5ne" +
            token +
            "/m/wilayah/kelurahan?idkecamatan=" +
            id,
        dataType: "json",
        success: function (kels) {
            $.each(kels.data, function (i, v) {
                $(el).append(
                    '<option selected disabled></option><option value="' +
                        v.id +
                        '">' +
                        v.name +
                        "</option>"
                );
            });
        },
    });
}
