<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Do You Want to Dance?</title>
        <link type="text/css" rel="stylesheet" href="css/main.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
        <script>
            $(function () {

                $('#dendro_button').on('click', function() {
                    $('html, body').animate({
                        scrollTop: $('#dendrogram').offset().top
                    }, 400);
                });


                $('form').on('submit', function (e) {

                    $('#results').css('display', 'none');
                    $('#dendrogram').css('display', 'none');

                    $('#song_name').html("Song to be Classified: ");
                    $('#predicted_danceability').html("Predicted Danceability: ");
                    $('#actual_danceability').html("Actual Danceability: ");
                    $('#dance_prediction_error').html("Prediction Error: ");

                    $('#predicted_valence').html("Predicted Valence: ");
                    $('#actual_valence').html("Actual Valence: ");
                    $('#valence_prediction_error').html("Prediction Error: ");

                    $('#predicted_energy').html("Predicted Energy: ");
                    $('#actual_energy').html("Actual Energy: ");
                    $('#energy_prediction_error').html("Prediction Error: ");

                    $('#top_kdance_songs').html("");
                    $('#top_kvalence_songs').html("");
                    $('#top_kenergy_songs').html("");
                    e.preventDefault();
                    console.log($('form').serialize());
                    $.ajax({
                        type: 'post',
                        url: 'KNN/bin/handleSubmission.php',
                        data: $('form').serialize(),
                        beforeSend:function(x){
                            $('#main').html("<progress id='bar' value='0' max='100'></progress>").show();
                        },
                        success: function(data) {
                            $('#bar').val(100);
                            data = JSON.parse(data);
                            if (data === 'failure') {
                                $('#form_failure').css('display', 'inline');
                                console.log("it didn't work");
                            } else {
                                $('#form_success').css('display', 'inline');
                                $('#song_name').append(data.song_to_be_classified.title + " by " + data.song_to_be_classified.artist_name);
                                $('#predicted_danceability').append(data.average_danceability);
                                $('#actual_danceability').append(data.song_to_be_classified.danceability);
                                $('#dance_prediction_error').append((data.average_danceability - data.song_to_be_classified.danceability).toFixed(4));

                                $('#predicted_valence').append(data.average_valence);
                                $('#actual_valence').append(data.song_to_be_classified.valence);
                                $('#valence_prediction_error').append((data.average_valence - data.song_to_be_classified.valence).toFixed(4));

                                $('#predicted_energy').append(data.average_energy);
                                $('#actual_energy').append(data.song_to_be_classified.energy);
                                $('#energy_prediction_error').append((data.average_energy - data.song_to_be_classified.energy).toFixed(4));

                                //danceability table: 
                                $('#top_kdance_songs').append("<h3>Top " + data.k + " Songs</h3><br>");
                                $('#top_kdance_songs').append("<table><thead>");
                                $('#top_kdance_songs').append("<tr>");
                                $('#top_kdance_songs').append("<th>Title</th>");
                                $('#top_kdance_songs').append("<th>Artist</th>");
                                $('#top_kdance_songs').append("<th>Danceability</th>");
                                $('#top_kdance_songs').append("</tr></thead><tbody>");

                                $.each(data.kNearest_dance, function(index, value) {
                                    $('#top_kdance_songs').append("<tr>");
                                    $('#top_kdance_songs').append("<td>" + value.title + "</td></br>");
                                    $('#top_kdance_songs').append("<td>" + value.artist_name + "</td></br>");
                                    $('#top_kdance_songs').append("<td>" + value.danceability + "</td></br>");
                                    $('#top_kdance_songs').append("</tr>");
                                });
                                $('#top_kdance_songs').append("</tbody></table>");

                                //valence table: 
                                $('#top_kvalence_songs').append("<h3>Top " + data.k + " Songs</h3><br>");
                                $('#top_kvalence_songs').append("<table><thead>");
                                $('#top_kvalence_songs').append("<tr>");
                                $('#top_kvalence_songs').append("<th>Title</th>");
                                $('#top_kvalence_songs').append("<th>Artist</th>");
                                $('#top_kvalence_songs').append("<th>Valence</th>");
                                $('#top_kvalence_songs').append("</tr></thead></tbody>");

                                $.each(data.kNearest_valence, function(index, value) {
                                    // $('#top_k_songs').append("<p>" + value.title + " by " + value.artist_name + " danceability: " + value.danceability + " valence: " + value.valence + " energy: " + value.energy + "</p>");
                                    $('#top_kvalence_songs').append("<tr>");
                                    $('#top_kvalence_songs').append("<td>" + value.title + "</td></br>");
                                    $('#top_kvalence_songs').append("<td>" + value.artist_name + "</td></br>");
                                    $('#top_kvalence_songs').append("<td>" + value.valence + "</td></br>");
                                    $('#top_kvalence_songs').append("</tr>");
                                });

                                $('#top_kvalence_songs').append("</tbody></table>");

                                //energy table: 
                                $('#top_kenergy_songs').append("<h3>Top " + data.k + " Songs</h3><br>");
                                $('#top_kenergy_songs').append("<table><thead>");
                                $('#top_kenergy_songs').append("<tr>");
                                $('#top_kenergy_songs').append("<th>Title</th>");
                                $('#top_kenergy_songs').append("<th>Artist</th>");
                                $('#top_kenergy_songs').append("<th>Energy</th>");
                                $('#top_kenergy_songs').append("</tr></thead><tbody>");

                                $.each(data.kNearest_energy, function(index, value) {
                                    $('#top_kenergy_songs').append("<tr>");
                                    $('#top_kenergy_songs').append("<td>" + value.title + "</td></br>");
                                    $('#top_kenergy_songs').append("<td>" + value.artist_name + "</td></br>");
                                    $('#top_kenergy_songs').append("<td>" + value.energy + "</td></br>");
                                    $('#top_kenergy_songs').append("</tr>");
                                });

                                $('#top_kenergy_songs').append("</tbody></table>");


                                $('#results').css('display', 'block');
                                $('#dendrogram').css('display', 'block');

                                $('html, body').animate({
                                    scrollTop: $('#results').offset().top
                                }, 800);
                            }
                        }
                    });

                });

            });
        </script>
    </head>
    <body>
    <?php 
        $toUTF = utf8_encode( file_get_contents ("HAC/all-songs-clustering-single.json") );
        $myfile = fopen("HAC/testfile.json", "w");
        fwrite($myfile, $toUTF);
        fclose($myfile);

    ?>
        <div id="classifier" class="panel">
            <div class="panel_content">
                <h1>Do You Want to Dance?</h1>
                <form action="index.php" method="POST">
                    <input type="text" name="song_name" placeholder="Song Name">
                    <input type="text" name="artist_name" placeholder="Artist Name">
                    <button>Submit</button>
                </form>
                <div id="main"></div>
                <p id="#form_failure" style="display:none">It didn't work!</p>
                <p id="#form_success" style="display:none">It worked!</p>
            </div>
        </div>
     
        <div id="results" class="panel" style="display:none">
            <div class="content">
                <h1 id="song_name">Song to be Classified: </h1>
                <div class="three_column">
                    <h3 id="predicted_danceability">Predicted Danceability: </h3>
                    <h3 id="actual_danceability">Actual Danceability: </h3>
                    <h3 id="dance_prediction_error">Prediction Error: </h3>
                    <div id="top_kdance_songs">
                    </div>
                </div>

                <div class="three_column">
                    <h3 id="predicted_valence">Predicted Danceability: </h3>
                    <h3 id="actual_valence">Actual Danceability: </h3>
                    <h3 id="valence_prediction_error">Prediction Error: </h3>
                    <div id="top_kvalence_songs">
                    </div>
                </div>

               <div class="three_column">
                    <h3 id="predicted_energy">Predicted Danceability: </h3>
                    <h3 id="actual_energy">Actual Danceability: </h3>
                    <h3 id="energy_prediction_error">Prediction Error: </h3>
                    <div id="top_kenergy_songs">
                    </div>
                </div>
                <button id="dendro_button">See the Sub-Genre Classification Dendrogram</button>
            </div>
        </div>
        <div id="dendrogram" class="panel" style="display:none">
            <div class="content">
                <h1>K-Means Clustering Dendrogram</h1>
                <div id="dendro_img">
                    <iframe src = "clustering/dendo.html" width='1000' height='100' style="height: 400px;"></iframe>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel lorem et massa fringilla tempus. Aenean convallis, sem eget tristique aliquam, metus diam fringilla metus, vel tincidunt dolor augue in turpis. Vivamus elementum mi eu imperdiet porttitor. Nam laoreet turpis massa, sit amet gravida nisi sagittis at. Nullam aliquet cursus posuere. Vivamus efficitur felis vitae lacus pellentesque, a placerat ipsum faucibus. Aliquam non lacus eu nulla posuere auctor. Aliquam at maximus ante. Nunc ac dapibus massa, vitae condimentum leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisl odio, convallis faucibus ornare nec, pharetra id ante. Nulla suscipit dui magna. Cras libero enim, vehicula vel magna id, molestie tempus orci. Quisque nunc neque, congue at diam vitae, commodo maximus ipsum.</p>
           



            </div>
        </div>
        <div id="credits" class="panel">
            <h1>Explanation and Things</h1>
            <div id="explanation">
                <h2>If we get the <a href="http://christophergandrud.github.io/d3Network/#ClusterDendro" target="_blank">dendrogram</a> working for the clustering, that will go here.</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel lorem et massa fringilla tempus. Aenean convallis, sem eget tristique aliquam, metus diam fringilla metus, vel tincidunt dolor augue in turpis. Vivamus elementum mi eu imperdiet porttitor. Nam laoreet turpis massa, sit amet gravida nisi sagittis at. Nullam aliquet cursus posuere. Vivamus efficitur felis vitae lacus pellentesque, a placerat ipsum faucibus. Aliquam non lacus eu nulla posuere auctor. Aliquam at maximus ante. Nunc ac dapibus massa, vitae condimentum leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisl odio, convallis faucibus ornare nec, pharetra id ante. Nulla suscipit dui magna. Cras libero enim, vehicula vel magna id, molestie tempus orci. Quisque nunc neque, congue at diam vitae, commodo maximus ipsum.</p>
                <p>Aliquam viverra lorem venenatis, vestibulum mi a, sollicitudin justo. Nullam in semper elit. Praesent odio sem, ornare vitae tristique quis, viverra quis lacus. Aliquam eget pulvinar velit. Quisque eu diam finibus, finibus nunc ut, commodo nisl. Duis in aliquet libero. Sed elementum velit condimentum libero bibendum, dictum gravida dui rutrum. Integer ultricies velit at nulla sagittis congue. Etiam non sapien dolor. Suspendisse ullamcorper imperdiet diam. Integer erat nibh, viverra vel molestie non, fermentum eget erat. Etiam lobortis aliquam libero non fermentum. Sed tincidunt ipsum quis erat viverra lacinia. Praesent mollis eros eu mi gravida lacinia.</p>
                <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla at commodo mi. Pellentesque sit amet convallis neque. Nulla vel dui elementum, cursus augue vitae, ultrices magna. Curabitur vestibulum quis augue sit amet fringilla. Morbi egestas, erat ac gravida ornare, purus nisi ullamcorper est, malesuada semper orci nunc sit amet erat. Sed facilisis purus elit, quis aliquet metus cursus quis.</p>
            </div>
        </div>
    </body>
</html>