<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageTitle }}</title>

    <link rel="stylesheet" href="{{ asset('assets/common/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <style>
        body::-webkit-scrollbar {
            display: none;
        }
    </style>


</head>

<body class="mt-4">
    @php
        echo $replaced;
    @endphp

    <div class="row justify-content-center d-flex mt-5">
        <button class="btn btn--base btn--sm w-25 download" type="button" id="demo">@lang('Download')</button>
    </div>


    <script src="{{ asset('assets/common/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/html2pdf.bundle.min.js') }}"></script>

    <script>
        "use strict";
        const options = {
            margin: 0.3,
            filename: 'english-language-test-17-may-2022',
            image: {
                type: 'jpeg',
                quality: 1.00
            },
            html2canvas: {
                scale: 4
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'landscape'
            }
        }
        var objstr = document.getElementById('block1').innerHTML;
        var strr = objstr;
        $(document).on('click', '.download', function(e) {
            e.preventDefault();
            var element = document.getElementById('demo');
            html2pdf().from(strr).set(options).save();
        });
    </script>


    <script>
        function findAndReplaceSitename() {
            let sitenameElement = document.querySelector('.pm-certificate-title h2');
            if (sitenameElement) {
                let content = sitenameElement.textContent; // Or .innerText, depending on what you need
                if (content.includes(`completion`)) {
                    let replacedContent = content.replace("completion", 'Your Site Name');
                    // Update the content of the element with the replaced text
                    sitenameElement.textContent = replacedContent;
                }
            }
        }

        // Call the function
        findAndReplaceSitename();
    </script>
</body>

</html>
