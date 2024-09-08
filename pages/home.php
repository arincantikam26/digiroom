<script>
    $(document).ready(function() {

        function updateData() {
            $.ajax({
                url: "../digiroom/api/get_data.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $('.suhu_val').html(response.suhu + '&deg;C');
                    $('.kelembapan_val').html(response.kelembapan + ' %');

                    let status = '';
                    let msg_kelembapan = '';
                    let warna_status = '';
                    
                    if (response.kelembapan > 0 && response.kelembapan < 25) {
                        msg_kelembapan = 'Tingkat kelembapan terlalu rendah, memicu kekeringan udara.';
                        warna_status = 'red';
                        status="Rendah";
                    } else if (response.kelembapan >= 25 && response.kelembapan < 30) {
                        msg_kelembapan = 'Tingkat kelembapan udara yang rendah, namun cukup wajar.';
                        warna_status = 'orange';
                        status="Rendah";
                    } else if (response.kelembapan >= 30 && response.kelembapan <= 60) {
                        msg_kelembapan = 'Tingkat kelembapan udara yang ideal.';
                        warna_status = 'green';
                        status="Baik";
                    } else if (response.kelembapan > 60 && response.kelembapan <= 70) {
                        msg_kelembapan = 'Tingkat kelembapan udara yang tinggi, namun cukup wajar.';
                        warna_status = 'orange';
                        status="Tinggi";
                    } else if (response.kelembapan > 70) {
                        msg_kelembapan = 'Tingkat kelembapan terlalu tinggi, memicu perkembangan bakteri.';
                        warna_status = 'red';
                        status="Tinggi";
                    } 

                    $('.statkelembapan_val').html(status);
                    $('.status').css('background-color', warna_status);
                    $('#msg_kelembapan').css('color', warna_status);
                    $('#msg_kelembapan').html(msg_kelembapan);

                  
                },
                error: function(error) {
                    console.error("Error fetching data: ", error);

                }
            })
        }
        setInterval(updateData, 1000);
    });
</script>

<div class="message">
    <p id="msg_kelembapan"></p>
</div>

<div class="row">
    
        
    
    <div class="col-md-4">
        <div class="card-home">
            <h4>SUHU</h4>
            <div class="circle-display suhu">
                <div class="suhu_val">
                    0&deg;C
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">

        <div class="card-home">
            <h4>KELEMBAPAN</h4>
            <div class="circle-display kelembapan">
                <div class="kelembapan_val">
                    0 %
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">

        <div class="card-home">
            <h4>STATUS KELEMBAPAN</h4>
            <div class="circle-display status">
                <div class="statkelembapan_val">
                    -
                </div>
            </div>
        </div>

    </div>
</div>