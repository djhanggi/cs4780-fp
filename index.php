<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Do You Want to Dance?</title>
        <link type="text/css" rel="stylesheet" href="css/main.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
        <script>
            $(function () {

                $('form').on('submit', function (e) {
                    $('#song_name').html("Song to be Classified: ");
                    $('#predicted_danceability').html("Predicted Danceability: ");
                    $('#actual_danceability').html("Actual Danceability: ");
                    $('#prediction_error').html("Prediction Error: ");
                    $('#top_k_songs').html("");
                    e.preventDefault();
                    console.log($('form').serialize());
                    $.ajax({
                        type: 'post',
                        url: 'KNN/bin/handleSubmission.php',
                        data: $('form').serialize(),
                        success: function(data) {
                            data = JSON.parse(data);
                            if (data === 'failure') {
                                $('#form_failure').css('display', 'inline');
                                console.log("it didn't work");
                            } else {
                                $('#form_success').css('display', 'inline');
                                $('#song_name').append(data.song_to_be_classified.title + " by " + data.song_to_be_classified.artist_name);
                                $('#predicted_danceability').append(data.average_danceability);
                                $('#actual_danceability').append(data.song_to_be_classified.danceability);
                                $('#prediction_error').append((data.average_danceability - data.song_to_be_classified.danceability).toFixed(4));

                                $('#top_k_songs').append("<h1>Top " + data.k + " Songs</h1>");
                                $.each(data.kNearest, function(index, value) {
                                    $('#top_k_songs').append("<p>" + value.title + " by " + value.artist_name + " danceability: " + value.danceability + " valence: " + value.valence + " energy: " + value.energy + "</p>");
                                });
                                $('#results').css('display', 'block');

                                $('html, body').animate({
                                    scrollTop: $('#results').offset().top
                                }, 1000);
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
                <h1>Do You Want to Dance?</h1>
                <form action="index.php" method="POST">
                    <input type="text" name="song_name" placeholder="Song Name"></input></br>
                    <input type="text" name="artist_name" placeholder="Artist Name"></input></br>
                    <button>Submit</button>
                </form>
                <p id="#form_failure" style="display:none">It didn't work!</p>
                <p id="#form_success" style="display:none">It worked!</p>
            </div>
        </div>
        <div id="results" class="panel" style="display:none">
            <div class="content">
                <h1>Results</h1>
                <h2 id="song_name">Song to be Classified: </h2>
                <h2 id="predicted_danceability">Predicted Danceability: </h2>
                <h2 id="actual_danceability">Actual Danceability: </h2>
                <h2 id="prediction_error">Prediction Error: </h2>
                <div id="top_k_songs">

                </div>
                <!--   <p>Predicted danceability is: </p>
                <p>Top 5 matches: </p> -->
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