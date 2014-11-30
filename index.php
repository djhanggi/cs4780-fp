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

                    e.preventDefault();
                    console.log($('form').serialize());
                    $.ajax({
                        type: 'post',
                        url: 'KNN/bin/handleSubmission.php',
                        data: $('form').serialize(),
                        success: function(data) {
                            if (data === 'failure') {
                                // $('#form_failure').css('display', 'inline');
                                console.log("it didn't work");
                            } else {
                                // $('#form_success').css('display', 'inline');
                                console.log("data is: ");
                                console.log(data);
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
                    <!-- <input type="submit"></input> -->
                    <button>Submit</button>
                </form>
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