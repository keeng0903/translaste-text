<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="{{asset('frontend/js/modernizr.js')}}"></script> <!-- Modernizr -->


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<script src="{{asset('frontend/js/jquery-2.1.4.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script> <!-- Resource jQuery -->
{{--swal--}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(window).on('load', function(event) {
        $('body').removeClass('preloading');
        // $('.load').delay(1000).fadeOut('fast');
        $('.loader').delay(1000).fadeOut('fast');
    });
    function swalMessageNotButton(message) {
        swal(message, {
            buttons: false,
            timer: 2000
        });
    }
</script>

{{--camera--}}
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>

<script type="text/javascript">

    const URL = "{{asset('asset/js')}}";

    let model, webcam, labelContainer, maxPredictions;

    // Load the image model and setup the webcam
    async function init() {
        const modelURL = URL +"/"+ "model.json";
        const metadataURL = URL+"/" + "metadata.json";

        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);

        maxPredictions = model.getTotalClasses();
        console.log(maxPredictions);

        // Convenience function to setup a webcam
        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(1000, 1000, flip); // width, height, flip

        webcam.position = 10;

        // webcam.position.x = 10
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);


        document.getElementById("button-start").style.display = "none";

        // document.getElementById("icon-on-off").style.display = "block";

        // append elements to the DOM
        document.getElementById("webcam-container").appendChild(webcam.canvas);
        labelContainer = document.getElementById("label-container");
        // for (let i = 0; i < maxPredictions; i++) { // and class labels
        //     labelContainer.appendChild(document.createElement("div"));
        // }
    }


    async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
    }

    // run the webcam image through the image model
    async function predict() {
        // predict can take in an image, video or canvas html element

        const predictions = await model.predictTopK(webcam.canvas, 1);
        const label = predictions[0].className
        const percent = predictions[0].probability.toFixed(2) * 100
        if(percent >= 80){
            labelContainer.value = label ;
            labelContainer.style.color = "#000"
        }
        else{
            labelContainer.value = '! invalid';
            labelContainer.style.color = "#ff0000"
        }

        // labelContainer.value = predictions[0].className + " " + predictions[0].probability.toFixed(2) * 100 ;
        // const prediction = await model.predictTopK(webcam.canvas);
        // for (let i = 0; i < maxPredictions; i++) {
        //     const classPrediction =
        //         prediction[i].className + ": " + prediction[i].probability.toFixed(2);
        //     labelContainer.childNodes[i].innerHTML = classPrediction;
        // }

    }


</script>
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script>
    {{--script camera--}}
    $(document).ready(function () {
        $('#button-search').on('click', function () {
            var query = document.forms["form-camera"]["word"].value;

            if (query != '') {

                var _token = $('input[name="_token"]').val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('home.result_camera') }}",
                    data: {query: query, _token:_token},
                    success: function (data_camera) {
                        if (data_camera) {
                            $('#detail-camera').fadeIn();
                            $('#detail-camera').html(data_camera);
                        } else {
                            swalMessageNotButton("Không tìm thấy từ")
                        }
                    }
                });
            }
            return false;
        });

    });

</script>

@if (session('status'))
    <script>
        swal("{{ session('status') }}", {
            button: false,
            timer: 2000
        });
    </script>
@endif
