<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Do You Want to Dance?</title>
        <link type="text/css" rel="stylesheet" href="css/main.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
        <link rel='stylesheet' href='source/jquery.fancybox.css?v=2.1.5' type='text/css' media='screen' />
        <script type='text/javascript' src='source/jquery.fancybox.pack.js?v=2.1.5'></script>
        <script>

            $(function () {

                $("a.grouped_elements").fancybox({
                    'transitionIn'  :   'elastic',
                    'transitionOut' :   'elastic',
                    'speedIn'       :   600, 
                    'speedOut'      :   200, 
                    'overlayShow'   :   false
                });
                

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
        <div id="classifier" class="panel">
            <div class="panel_content">
                <div class="panel_header"><h1>Do You Want to Dance?</h1></div>
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
                <div class="panel_header"><h1 id="song_name">Song to be Classified: </h1></div>
                <div id = "disp_results">
                <div class="three_columns">
                    <h3 id="predicted_danceability">Predicted Danceability: </h3>
                    <h3 id="actual_danceability">Actual Danceability: </h3>
                    <h3 id="dance_prediction_error">Prediction Error: </h3>
                    <div id="top_kdance_songs">
                    </div>
                </div>

                <div class="three_columns">
                    <h3 id="predicted_valence">Predicted Danceability: </h3>
                    <h3 id="actual_valence">Actual Danceability: </h3>
                    <h3 id="valence_prediction_error">Prediction Error: </h3>
                    <div id="top_kvalence_songs">
                    </div>
                </div>

               <div class="three_columns">
                    <h3 id="predicted_energy">Predicted Danceability: </h3>
                    <h3 id="actual_energy">Actual Danceability: </h3>
                    <h3 id="energy_prediction_error">Prediction Error: </h3>
                    <div id="top_kenergy_songs">
                    </div>
                </div>
                <button id="dendro_button">See the Sub-Genre Classification Results</button>
                
            </div>
            </div>
        </div>

        <div id="dendrogram" class="panel"style="display:none">
            <div class="content">
                <div class="panel_header"><h1>Hierarchical Agglomerative Clustering Dendrogram</h1></div>

     
                </script>
               <div class="jcarousel">
                    <ul>
                        <li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c1.png">
                            <img class ="clusters" src = "images/c1.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c2.png">
                            <img class ="clusters" src = "images/c2.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c3.png">
                            <img class ="clusters" src = "images/c3.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c4.png">
                            <img class ="clusters" src = "images/c4.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c5.png">
                            <img class ="clusters" src = "images/c5.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c6.png">
                            <img class ="clusters" src = "images/c6.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c9.png">
                            <img class ="clusters" src = "images/c9.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c10.png">
                            <img class ="clusters" src = "images/c10.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                        <a class="grouped_elements" rel="group1" id="c1" href="images/c11.png">
                            <img class ="clusters" src = "images/c11.png" width = '425' height = '270' alt = "">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="credits" class="panel">
            <br><br><br><br><br><br><br><br>
            <div class="panel_header"><h1>Project Motivation and Definition</h1></div>
            <div id="explanation">
                <p>
                    Music can be quantified numerically in terms of tempo, encoded chord progressions, lyric 
                    term frequencies, but how much can we learn from cold numbers when the appeal of music to 
                    humans is all in things that are much more difficult to numerically quantify? Knowing the 
                    tempo and duration of a song does not allow us to understand how a human might perceive the 
                    song because those are not the most commonly used attributes a human focuses on when 
                    listening to a song.
                </p>
                <p>
                    Attributes that are much more subjective (and therefore difficult to quantify) tend to be 
                    more human understandable. Knowing how much a song might make you want to dance, or the 
                    energy of that song helps us better understand what the song might sound like or the impact 
                    it will have on us.
                </p>
                <p>
                    In this project, we explore the Echo Nest API, which provides machine-learned numerical 
                    values for a song's danceability, valence, and energy. The Echo Nest developers do not 
                    define any of these attributes (we only have their name to use to derive their meaning), 
                    and do not expose how the values were determined. To better understand how these values 
                    might be derived and defined, we search for a transformative function that defines a 
                    correlation between those values that allow us to predict them using the k-Nearest 
                    Neighbors algorithm.
                </p>
                <p>
                    In an effort to measure how well we quantify the attributes danceability, valence, and 
                    energy, we explored Hierarchical Agglomerative Clustering to try to locate genres and subgenres (a natural way 
                    to group similar songs for humans) in our dataset using a song's danceability, valence, 
                    and energy to see if there exists some correlation between the subjective attributes that 
                    we mapped to numerical values (danceability, valence, and energy), and another subjective 
                    attribute (genre).
                </p>
            </div>
        </div>
    </body>
</html>