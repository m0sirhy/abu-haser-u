$(document).ready(function () {
    
//print order
    $(document).on('click', '.print-btn', function() {

        $('#print-area').printThis({
            debug: false,               // show the iframe for debugging

            importCSS: true,            // import parent page css
            base: true,                // preserve the BASE tag or accept a string for the URL
            printContainer: true,       // print outer container/$.selector

            pageTitle: "**",              // add title to print page
            header: "<h1 style=' text-align:center;'>مولد ابوحصيرة </h1> <br> <h3 style=' border: 2px solid black;border-radius: 5px; text-align:center;'>كشف قراءات </h3>",
            // footer: " <div style='  position: fixed; bottom: 0;'> <h5> العنوان : غزة الزيتون / لفة السوافيري </h5> <h5> ابو عثمان السرحي ٠٥٩٧٤٤١٠٥٤ <br> سلطان السرحي ٠٥٩٧٧٦٤٢٨٤</h5> </div>",
                });

    });//end of click function

});//end of document ready