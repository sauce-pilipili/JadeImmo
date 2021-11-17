function Ajaxlocalisation() {

    $.ajax(
        {
            url: "",
            type: "GET",
            data: {},
            success: function (data) {
                for (let i = 0; i < data.loc.length; i++) {
                    console.log(data.loc[i], data.loc.length)
                    var opt = document.createElement("option");
                    opt.value = data.loc[i]
                    opt.text = data.loc[i]
                    let select =document.querySelector('#select-localisation')
                    // $("#select-localisation").appendChild(opt);
                    select.appendChild(opt)
                }

            }
        }
    )
}

Ajaxlocalisation();